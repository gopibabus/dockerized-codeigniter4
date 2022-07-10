FROM php:8.0.3-apache-buster

# environment variables and arguments
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_PROCESS_TIMEOUT 2000

RUN apt-get -yqq update \
    && apt-get -yqq install --no-install-recommends zip unzip \
        build-essential \
        libzip-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
        locales \
        libpq-dev \
        curl \
        wget \
        vim \
        git\
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pgsql pdo_pgsql pcntl intl \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis \
    && a2enmod rewrite

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# apache config
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# php config
COPY docker/config/php/php.ini /usr/local/etc/php/php.ini
COPY docker/config/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY docker/config/php/conf.d/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

# helper files
COPY docker/start.sh /usr/local/bin/start
COPY docker/helpers/.bashrc /root/.bashrc
RUN chmod +x /usr/local/bin/start

# installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && composer --version

# install node.js and npm
# https://github.com/nodesource/distributions/blob/master/README.md#debinstall
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && node --version \
    && npm --version

# caching composer dependencies
WORKDIR /tmp
COPY composer.json composer.lock /tmp/
RUN composer install \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --prefer-dist \
    && rm -rf composer.json composer.lock vendor

WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 writable/
RUN composer install \
    --no-interaction \
    --no-scripts \
    --prefer-dist

EXPOSE 80

CMD ["/usr/local/bin/start"]