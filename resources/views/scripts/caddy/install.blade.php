echo "{{ $site->name }} {
    root * {{ $site->webroot() }}
    php_fastcgi unix//path/to/php-fpm.sock
    encode gzip
    file_server
}" | sudo tee /etc/caddy/sites-enabled/{{ $site->name }}.Caddyfile > /dev/null

mkdir -p {{ $site->webroot() }}

echo "Hello World!" | tee {{ $site->webroot() }}/index.html
