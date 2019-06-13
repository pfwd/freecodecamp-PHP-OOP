FROM php:7.2-apache

LABEL maintainer="Peter Fisher"

RUN apt-get update          \
    && apt-get install -y   \
        git                 \
        zlib1g-dev          \
        libmcrypt-dev       \
        zip                 \
        unzip               \
        libxml2-dev         \
        libgd-dev           \
        libpng-dev          \
        libfreetype6-dev    \
        libjpeg62-turbo-dev \
        libmcrypt-dev       \
        libzip-dev          \
    && pecl install mcrypt-1.0.1                                                                    \
    && docker-php-ext-install mysqli pdo_mysql iconv simplexml                                      \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/  \
    && docker-php-ext-configure zip --with-libzip                                                   \
    && docker-php-ext-install gd zip                                                                \
    && docker-php-ext-enable mcrypt                                                                 \
    && apt-get clean all                                                                            \
    && rm -rvf /var/lib/apt/lists/*                                                                 \
    && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/bin
ENV PATH /root/.composer/vendor/bin:$PATH

WORKDIR /var/www/html