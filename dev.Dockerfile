FROM php:8.3.15

WORKDIR /workspace

ENV TZ Asia/Tokyo
ENV COMPOSER_ALLOW_SUPERUSER 1

# create php.ini
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# install dependencies
RUN --mount=type=cache,target=/var/cache/apt,sharing=locked \
    --mount=type=cache,target=/var/lib/apt,sharing=locked \
    apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install zip pcntl

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# install composer dependencies
COPY composer.json composer.lock /workspace/
# install後にpost-autoload-dumpが自動実行されて、必要なファイルが増えてしまうため--no-scriptsを指定
RUN --mount=type=cache,target=/root/.composer,sharing=locked \
    composer install --no-scripts

# install node dependencies
COPY package.json package-lock.json /workspace/
RUN --mount=type=cache,target=/root/.npm,sharing=locked \
    npm install

# install pcov
RUN pecl install pcov && docker-php-ext-enable pcov

# install lefthook
RUN curl -1sLf 'https://dl.cloudsmith.io/public/evilmartians/lefthook/setup.deb.sh' | bash && apt-get install lefthook

# copy source
COPY . /workspace

# init
# install時に実行していないpost-autoload-dumpを実行する
RUN composer run post-autoload-dump
RUN composer run post-root-package-install
RUN composer run post-create-project-cmd

CMD [ "/bin/bash" ]
