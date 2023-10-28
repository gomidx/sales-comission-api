# Image PHP
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Essentials
RUN echo "UTC" > /etc/timezone
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --update zip unzip curl php-cli sqlite python3-dev python3 && curl -O https://bootstrap.pypa.io/get-pip.py \
&& python3 get-pip.py

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apk add php-json

# Modules Install
RUN docker-php-ext-install pdo_mysql \
    pcntl

EXPOSE 80