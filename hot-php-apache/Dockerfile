FROM php:apache

RUN apt-get update && apt-get install -y \
  zip unzip \
  && docker-php-ext-install pdo_mysql \
# download and install php composer
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install xdebug
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug
