echo "{{ $site->name }} {
    header {
        X-Xss-Protection "1; mode=block"
        X-Content-Type-Options "nosniff"
        X-Frame-Options "SAMEORIGIN"
        -Server Caddy
    }

    root * {{ $site->webroot() }}
    php_fastcgi unix//run/php/php8.3-fpm.sock
    encode zstd gzip
    file_server
}" | sudo tee /etc/caddy/sites-enabled/{{ $site->name }}.Caddyfile > /dev/null

mkdir -p {{ $site->webroot() }}

echo "Hello World!" | tee {{ $site->webroot() }}/index.html
