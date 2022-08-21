## Setup Laradock to run Enviroment
Read more about laradock: https://laradock.io/introduction/
1. Create new folder "docker"
mkdir docker
2. Clone Laradock
cd docker
mkdir docker/sources

git clone https://github.com/Laradock/laradock.git

3. Config .env for laradock
cp .env.example .env

Note:
Edit value in here to custom image when build
APP_CODE_PATH_HOST=../sources (Project source is here)
PHP_VERSION=7.4 (PHP version to run your project)
4. Run your containers:
docker-compose up -d nginx mysql phpmyadmin redis elasticsearch  kibana workspace

Note:
Kibana: To run kibana, the system need a new config:
sysctl -w vm.max_map_count=262144 (run in linux bash)

5. Default port
nginx 80/443
php-fpm:9003
mysql:3306
phpmyadmin:8081
redis:6379
kibana:5601
elasticsearch:9200/9300

## Config Enviroment for project
Default value for:
- mysql:
port:3306
database: default
database: default
password: secret
- phpmyadmin: localhost:8081
Fill the form with mysql data, put "mysql" in for Server Input to connect.

### Config nginx for new domain
- Create projecttest.conf in "docker/laradock/nginx/sites"
When rebuild the image the system auto copy config file here to "/etc/nginx/sites-available"

```
server {

    # For https
    listen 443 ssl http2;
    listen [::]:443 ssl http2 ipv6only=on;
    ssl_certificate /etc/nginx/ssl/default.crt;
    ssl_certificate_key /etc/nginx/ssl/default.key;

    server_name projecttest.doc;
    root /var/www/projectest/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }

    error_log /var/log/nginx/project_test_error.log;
    access_log /var/log/nginx/project_test_access.log;
}

server {
    listen 80;
    server_name projecttest.doc;

    return 301 https://$host$uri;
}
```
- For none https
```
server {

    listen 80;
    listen [::]:80 ipv6only=on;

    server_name projecttest.doc;
    root /var/www/projectest/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }

    error_log /var/log/nginx/laravel1_error.log;
    access_log /var/log/nginx/laravel1_access.log;
}
```

 - If you add nginx.config after build image, please run:
docker-compose restart nginx

- Add record to host config
window: C:\Windows\System32\drivers\etc
```
127.0.0.1 projecttest.doc
```
linux: /etc/hosts
```
projecttest.doc 127.0.0.1
```
## Install laravel and config
Step 1: Using bash in workspace (Your sources was here)

docker-compose exec --user=laradock workspace bash
Current dir: "/var/www"
```
git clone {link} projecttest
cd projecttest
cp .env.example .env
```
Step 2:  Edit .env file:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:eS9Ftffv1mla6HMC3F5Ez2Nb9hpA8ioZ8qm2oH5Zfuw=
APP_DEBUG=true
APP_URL=http://projecttest.doc

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=projecttest.doc
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
SCOUT_DRIVER=Matchish\ScoutElasticSearch\Engines\ElasticSearchEngine
ELASTICSEARCH_HOST=elasticsearch
```
Step 3: Build project
```
composer install
#php artisan key:generate
npm install
npm run dev
php artisan migrate
php artisan db:seed
```

```
chmod -R 755 bootstrap/cache
chmod -R 755 storage
```

```
php artisan scout:import "Backend\Car\Models\Car"
```
## Note
To check elasticsearch please use kibana or post man to connect.
Example: Postman call: http://localhost:9200/{Index name}/_mapping?pretty

## To login:
-Backend:
Access: http://projecttest.doc/auth/login
Admin User: admin@gmail.com / password
Mmember User: member@gmail.com / password
