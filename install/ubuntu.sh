#!/bin/bash

# Upgrade the Ubuntu
apt update --yes
apt install ca-certificates apt-transport-https software-properties-common --yes
apt upgrade --yes

# Add a Lydian user
adduser --disabled-password --gecos ""
usermod -aG sudo hum
usermod -aG www-data hum
usermod -aG hum www-data

# Set up SSH
mkdir /home/hum/.ssh
cp /root/.ssh/* /home/hum/.ssh/
chmod 700 /home/hum/.ssh/
chmod 600 /home/hum/.ssh/*
chown hum:hum /home/hum/.ssh
chown hum:hum /home/hum/.ssh/*
sed -i 's/#PubkeyAuthentication/PubkeyAuthentication/' /etc/ssh/sshd_config
service ssh restart

# Install Caddy
sudo apt install -y debian-keyring debian-archive-keyring apt-transport-https curl
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | sudo gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | sudo tee /etc/apt/sources.list.d/caddy-stable.list
sudo apt update
sudo apt install caddy

# Install PHP
