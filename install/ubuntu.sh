#!/bin/bash

#====================================================================
# Arrange
#====================================================================
#

# Disable interactions when `apt update` requires user input.
export DEBIAN_FRONTEND=noninteractive

echo "Domain: "
read DOMAIN_NAME

PIGEONS_PASSWORD=$(tr -dc A-Za-z0-9 </dev/urandom | head -c 24; echo)
PUBLIC_IP_ADDRESS=$(hostname -I | awk '{print $1}')

if [ -z "$DOMAIN_NAME" ]; then
    echo "Roost requires a domain to be installed. Exiting..."
    exit 1
fi


#====================================================================
# Upgrade the new machine
#====================================================================
#
apt update --yes
# apt upgrade --yes

#====================================================================
# User account
#====================================================================
#
useradd "roost" --create-home --shell /bin/bash
echo -e "$PIGEONS_PASSWORD\n$PIGEONS_PASSWORD" | passwd "roost"

usermod -aG sudo roost

mkdir /root/.roost
mkdir /home/roost/.roost
chown roost:roost /home/roost/.roost

#====================================================================
# SSH
#====================================================================
#

# Allow public key authentication
sed -i 's/#PubkeyAuthentication/PubkeyAuthentication/' /etc/ssh/sshd_config

# Create an SSH private and public key for roost.
su -c "ssh-keygen -t rsa -f /home/roost/.ssh/id_rsa -N ''" "roost"

# Copy over all the authorized keys so the user installing roost won't have to manually
# add their SSH keys again.
cp /root/.ssh/authorized_keys /home/roost/.ssh/authorized_keys
chmod 600 /home/roost/.ssh/authorized_keys
chown roost:roost /home/roost/.ssh/authorized_keys

# Restart the SSH service so the roost user can now be used.
service ssh restart


#====================================================================
# PHP8.3
#====================================================================
#

PHP_VERSION="php8.3"
add-apt-repository --yes ppa:ondrej/php

# This is a fix for 23.10. We'll have to review this once 24.04 is out. This might not even be
# required when using the LTS release.
sed -i 's/mantic/jammy/g' /etc/apt/sources.list.d/ondrej-ubuntu-php-mantic.sources
apt update --yes

# Install all the PHP stuff we need.
apt install --yes --quiet --quiet $PHP_VERSION $PHP_VERSION-fpm $PHP_VERSION-mysql $PHP_VERSION-redis $PHP_VERSION-sqlite3 $PHP_VERSION-swoole $PHP_VERSION-memcached $PHP_VERSION-curl $PHP_VERSION-cli $PHP_VERSION-ssh2 $PHP_VERSION-zip php-pear

# Install composer globally.
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer


#====================================================================
# Caddy
#====================================================================
#

apt install -y debian-keyring debian-archive-keyring apt-transport-https curl
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | tee /etc/apt/sources.list.d/caddy-stable.list
apt update
apt install caddy

# Provide caddy access to the proper directories.
# usermod -aG roost caddy

# Run caddy as root
# TODO: I'm sure I can run this as either caddy/roost so this needs a bit more playing around with.
#       When I'm using caddy/roost, for some reason the SSL ends up being broken. Maybe I just didn't
#       wait long enough.
sed -i 's/User=caddy/User=root/g; s/Group=caddy/Group=root/g' /usr/lib/systemd/system/caddy.service
mkdir -p /etc/caddy/sites-enabled/

# Set up the directory so caddy can support multiple files.
echo "import sites-enabled/*" >> /etc/caddy/Caddyfile
caddy fmt /etc/caddy/Caddyfile --overwrite


# Restart caddy so it runs as root. Reloading alone will keep using the `caddy` user that started the first
# process after installation.
systemctl daemon-reload
systemctl stop caddy
sudo systemctl enable --now caddy


#====================================================================
# Permissions
#====================================================================
#

echo "roost ALL=(ALL) NOPASSWD: /usr/bin/tee" >> /etc/sudoers


#====================================================================
# Roost
#====================================================================
#

# Install Roost project
cd /home/roost
git clone https://github.com/humans/roost.git "$DOMAIN_NAME"

# Install dependencies
cd "/home/roost/$DOMAIN_NAME"
chown -R roost:roost "/home/roost/$DOMAIN_NAME"
su - roost -c "cd $PWD && composer install"

# Configure the .env
cp .env.production .env
php artisan key:generate
sed -i "s/^APP_URL=.*/APP_URL=https:\/\/$DOMAIN_NAME/" .env

# Set up the SQLite database
php artisan migrate --force

# Fix the permissions
chmod -R g+w "/home/roost/$DOMAIN_NAME"
chown -R roost:roost "/home/roost/$DOMAIN_NAME"

# Install the initial server and site credentials
php artisan install --ip=$PUBLIC_IP_ADDRESS --domain=$DOMAIN_NAME --password=$PIGEONS_PASSWORD

echo "$DOMAIN_NAME {
    root * /home/roost/$DOMAIN_NAME
    php_fastcgi unix//path/to/php-fpm.sock
    encode gzip
    file_server
}" | sudo tee "/etc/caddy/sites-enabled/$DOMAIN_NAME.Caddyfile" > /dev/null
