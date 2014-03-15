<<<<<<< HEAD
Yii Web Programming Framework
=============================

Thank you for choosing Yii - a high-performance component-based PHP framework.

[![Build Status](https://secure.travis-ci.org/yiisoft/yii.png)](http://travis-ci.org/yiisoft/yii)

INSTALLATION
------------

Please make sure the release file is unpacked under a Web-accessible
directory. You shall see the following files and directories:

      demos/               demos
      framework/           framework source files
      requirements/        requirement checker
      CHANGELOG            describing changes in every Yii release
      LICENSE              license of Yii
      README               this file
      UPGRADE              upgrading instructions


REQUIREMENTS
------------

The minimum requirement by Yii is that your Web server supports
PHP 5.1.0 or above. Yii has been tested with Apache HTTP server
on Windows and Linux operating systems.

Please access the following URL to check if your Web server reaches
the requirements by Yii, assuming "YiiPath" is where Yii is installed:

      http://hostname/YiiPath/requirements/index.php


QUICK START
-----------

Yii comes with a command line tool called "yiic" that can create
a skeleton Yii application for you to start with.

On command line, type in the following commands:

        $ cd YiiPath/framework                (Linux)
        cd YiiPath\framework                  (Windows)

        $ ./yiic webapp ../testdrive          (Linux)
        yiic webapp ..\testdrive              (Windows)

The new Yii application will be created at "YiiPath/testdrive".
You can access it with the following URL:

        http://hostname/YiiPath/testdrive/index.php


WHAT's NEXT
-----------

Please visit the project website for tutorials, class reference
and join discussions with other Yii users.



The Yii Developer Team
http://www.yiiframework.com
=======
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

=====

RP4. Приведите фрагмент кода, который сравнивает два массива и выводит
разницу в виде

    php protected/yiic.php array  --a='sd sfs sfsf' --b='/tmp/s'

>>>>>>> 962299a8063f3a78fdd54a4a50807243774d02a0
