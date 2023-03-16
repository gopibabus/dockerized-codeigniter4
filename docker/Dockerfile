FROM node:lts as nodebuild
FROM php:8.0.3-apache

LABEL Maintainer="Gopibabu Srungavarapu <gs333s@att.com>" \
      Description="Docker Image for raptor development environment"

###############################################################################
# environment variables and arguments
###############################################################################
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_PROCESS_TIMEOUT 2000

###############################################################################
# configuring proxy
###############################################################################
RUN pear config-set php_ini "$PHP_INI_DIR"/php.ini

###############################################################################
# copy SSH keys
###############################################################################
RUN mkdir -p /root/.ssh
COPY ./docker/id_rsa /root/.ssh/id_rsa
RUN chmod 600 /root/.ssh/id_rsa
###############################################################################
# installing essential programs
###############################################################################
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
        libssl-dev \
        libcurl4-openssl-dev \
        curl \
        wget \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install mysqli pdo pdo_mysql pgsql pdo_pgsql pcntl intl zip sockets \
    && a2enmod rewrite

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -k -fsSL https://pecl.php.net/get/redis | tar xvz -C "/usr/src/php/ext/redis" --strip 1 \
    && docker-php-ext-install redis

###############################################################################
# installing development environment programs
###############################################################################
RUN apt-get -yqq install vim git openssh-client
RUN mkdir -p /usr/src/php/ext/xdebug  \
        && curl -k -fsSL https://pecl.php.net/get/xdebug | tar xvz -C "/usr/src/php/ext/xdebug" --strip 1  \
        && docker-php-ext-install xdebug

###############################################################################
# copy configuration files
###############################################################################
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/config/php/php.ini /usr/local/etc/php/php.ini
COPY docker/config/php/conf.d/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini
COPY docker/config/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

###############################################################################
# copy helper files
###############################################################################
COPY docker/helpers/.bashrc /root/.bashrc
COPY docker/gitconfig /etc/gitconfig
COPY docker/gitconfig ~/.gitconfig
COPY docker/start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

###############################################################################
# installing composer
###############################################################################
RUN php -r 'var_dump(openssl_get_cert_locations());'
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

###############################################################################
# installing node and npm
###############################################################################
COPY --from=nodebuild /usr/local /usr/local

###############################################################################
# clean apt-get cache
###############################################################################
RUN apt-get clean -yqq && rm -rf /var/lib/apt/lists/*

###############################################################################
# project files
###############################################################################
WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 writable/
RUN chmod ug+x .husky/*

EXPOSE 80

CMD ["/usr/local/bin/start"]
