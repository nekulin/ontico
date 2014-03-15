ontico
======

Nginx

    server {
          listen       98;
          server_name  ontiko;
  
          charset utf-8;
          root   /var/www/ontico/app;
          index  index.html index.htm index.php;
  	access_log /var/log/nginx/ontico.access.log;
  
          location / {
                  try_files $uri $uri /index.php?$args;
          }
  
          location ~ \w+\.php$ {
                  #вот тут лучше заменить на юникс сокет
                  fastcgi_pass  unix:///var/run/php5-fpm.sock;
                  fastcgi_index index.php;
                  include fastcgi_params;
                  fastcgi_param  SCRIPT_FILENAME   $document_root$fastcgi_script_name;
                  fastcgi_param PATH_INFO $fastcgi_script_name;
      fastcgi_temp_file_write_size 10m;
      fastcgi_busy_buffers_size 512k;
      fastcgi_buffer_size 512k;
      fastcgi_buffers 16 512k;
      fastcgi_connect_timeout 300;
      fastcgi_send_timeout 300;
      fastcgi_read_timeout 300;
      fastcgi_intercept_errors on;
      fastcgi_next_upstream error invalid_header timeout http_500;
          }
  
          # deny access to .htaccess files, if Apache's document root
          # concurs with nginx's one
          #
          location ~ /\.ht {
              deny  all;
          }
                  
          location ~ ^/protected/ {
                  deny  all;
          }
      }

=====

Конфигурация

Создать файл app/protected/config/config.php

    <?php
    $attrConfig = array(
        'mysql' => array(
            'host' => 'localhost',
            'dbname' => 'ontico',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ),
    );

====

RP1. Социальная сеть

Для начало сгенерируем данные
    php protected/yiic.php social generate
    
Задание a

    php protected/yiic.php social a

Задание b

    php protected/yiic.php social b
    
Задание c

    php protected/yiic.php social c
    
======

RP2. Новости

Я вижу 2 варианта:

а) Кэшировать последние новости, если они не так часто выходят

б) Добалять в кеш(память, таблицы и т.д) самые последние новости

Реализация на главной странице
http://ontico:98/

=====

RP3. JSON API

    php protected/yiic.php  googlemaps search --address=Мира
