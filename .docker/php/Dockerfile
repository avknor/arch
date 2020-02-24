FROM php:7.4-fpm

RUN apt-get update \
 && apt-get install -y vim git zlib1g-dev libzip-dev zlib1g-dev libicu-dev g++ \
 && docker-php-ext-install zip \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \


 && echo 'xdebug.remote_enable=on' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_host=host.docker.internal' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_port=9000' >>  /usr/local/etc/php/conf.d/xdebug.ini \
# && pecl install rar \
# && docker-php-ext-install rar \
# && a2enmod rewrite \
# && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer
# && echo "AllowEncodedSlashes On" >> /etc/apache2/apache2.conf

CMD ["php-fpm"]


