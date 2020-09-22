# ./docker/php/Dockerfile
FROM php:7.4-fpm
ARG TIMEZONE

MAINTAINER "acuedd" <acuedd@gmail.com>


RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip
	
#xml
RUN apt-get update \
  && apt-get install -y \
  libxml2-dev \
  libxslt-dev \
  && docker-php-ext-install -j$(nproc) \
    dom \
    xmlrpc \
    xsl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install apcu

RUN docker-php-ext-install opcache
RUN docker-php-ext-enable apcu

RUN apt-get update && \
apt-get install -y \
    libzip-dev \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

RUN echo 'alias sf="php app/console"' >> ~/.bashrc \
&& echo 'alias sf5="php bin/console"' >> ~/.bashrc


WORKDIR /usr/src/app

COPY --chown=1000:1000 app/SembrandoConAmor /usr/src/app