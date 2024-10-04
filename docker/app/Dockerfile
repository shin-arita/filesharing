FROM php:8.3-fpm

WORKDIR /var/www/html/filesharing

ENV TZ=Asia/Tokyo \
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US:en \
    LC_ALL=en_US.UTF-8 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    curl \
    procps \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && locale-gen en_US.UTF-8 \
    && localedef -f UTF-8 -i en_US en_US.UTF-8 \
    && docker-php-ext-install \
        intl \
        pdo_mysql \
        zip \
        bcmath \
    && composer config -g process-timeout 3600 \
    && composer config -g repos.packagist composer https://packagist.jp

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./etc/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 9000
