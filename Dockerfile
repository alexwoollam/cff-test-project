FROM wordpress:php7.4-apache
LABEL WordPress PHPRedis

RUN rm /etc/apt/preferences.d/no-debian-php

RUN apt-get update

RUN apt-get install redis-tools -y

RUN apt-get install php-redis -y

RUN cp /etc/php/7.3/mods-available/redis.ini /usr/local/etc/php/conf.d/

RUN /etc/init.d/apache2 restart