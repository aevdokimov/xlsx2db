FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    apt-utils \
    libpq-dev \
    libpng-dev \
    libzip-dev \    
    zip unzip \
    procps \
    cron \
    libxml2-dev \
    libcurl4-openssl-dev \
    supervisor \
    git && \
    docker-php-ext-install pdo_mysql && \
    #docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    docker-php-ext-install dom && \
    docker-php-ext-install curl && \
    docker-php-ext-install sockets && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

COPY ./_docker/app/wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod 755 /usr/local/bin/wait-for-it.sh

# cron
COPY ./_docker/app/laravel-crontab /etc/cron.d/laravel-crontab
RUN chmod 755 /etc/cron.d/laravel-crontab && \
        crontab /etc/cron.d/laravel-crontab
# Запускается командой docker exec -d import_excel cron -f

# composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

ADD ./_docker/app/supervisor.conf /etc/supervisor/conf.d/worker.conf
# Запускается командой docker exec -d import_excel supervisord

WORKDIR /var/www
