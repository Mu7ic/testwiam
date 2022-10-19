FROM phpdockerio/php74-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update && apt-get -y --no-install-recommends install \
  git \
  wget \
  make \
  unzip \
  curl \
  openssh-client \
  php7.4-memcached \
  php7.4-mysql \
  php7.4-imagick \
  php7.4-imap \
  php7.4-intl \
  php7.4-zip \
  php7.4-mbstring \
  php7.4-soap \
  php7.4-xml \
  php7.4-bcmath \
  php7.4-mongodb \
  php7.4-pgsql \
  php7.4-xdebug \
  php7.4-ldap \
  php7.4-gd \
  php7.4-redis \
  php7.4-dev \
  php7.4-mailparse \
  libxrender1 \
  xz-utils \
  apt-transport-https \
  vim \
  telnet

RUN addgroup --gid 1000 local
RUN adduser --uid 1000 --ingroup local --disabled-login local
RUN sed -i s/www-data/local/g /etc/php/7.4/fpm/pool.d/www.conf

# Установка composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php ./composer-setup.php

RUN apt update \
    && apt upgrade -y \
    && apt-get autoremove -y \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/