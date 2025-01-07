FROM php:8.3.15

WORKDIR /workspace

ENV TZ Asia/Tokyo
ENV COMPOSER_ALLOW_SUPERUSER 1

# create php.ini
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pcntl

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# copy source
COPY . /workspace

# install composer dependencies
RUN composer install --no-dev

# init
RUN composer run post-root-package-install && composer run post-create-project-cmd

CMD composer run start
