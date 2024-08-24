FROM php:8.3-apache
WORKDIR /var/www/sfvn_app

RUN apt-get -y update && apt-get -y upgrade
RUN apt-get -y update && apt-get install -y systemd zip unzip vim apt-utils curl 
RUN pecl install redis-6.0.0 \
    && docker-php-ext-enable redis

RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php

COPY ./sfvn_app.conf /etc/apache2/sites-available/sfvn.conf
RUN a2enmod rewrite
RUN a2ensite sfvn

ENV NODE_VERSION=20
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
