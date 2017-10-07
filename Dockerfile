FROM php:7.0-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends ca-certificates wget \
        curl \
        git \
        ntp \
        nano \
        openssh-client \
        # for intl extension
        libicu-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng12-dev \
        libfreetype6-dev \
        libssl-dev \
        libxslt-dev \
        # for mcrypt extension
        libmcrypt-dev \
        libmagickwand-dev \
        && rm -r /var/lib/apt/lists/*

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer
