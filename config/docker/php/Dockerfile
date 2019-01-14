FROM composer

FROM php:7.3-fpm-alpine

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

ENV APCU_VERSION 5.1.16
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apk add --no-cache \
        ca-certificates \
        icu-libs \
        git \
        unzip \
        libzip-dev \
        zlib-dev && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev && \
    docker-php-ext-install \
        intl \
        zip && \
    pecl install apcu-${APCU_VERSION} && \
    docker-php-ext-enable apcu && \
    docker-php-ext-enable opcache && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install bcmath && docker-php-ext-enable bcmath && \
    apk del .build-deps

WORKDIR "/application"
