FROM oberd/php-8.0-apache
MAINTAINER TuanNP <ngophuongtuan@gmail.com>

# Install basics
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

#install composer
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/app

COPY composer.json /var/www/app/composer.json
COPY composer.lock /var/www/app/composer.lock

# Install dependencies and cache
RUN composer install --prefer-dist --no-scripts --no-autoloader --no-dev -vvv


RUN a2ensite laravel
COPY --chown=www-data:www-data . /var/www/app

#Dump
RUN composer dump-autoload --no-scripts --optimize --no-dev

ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE ${PORT}

# Update the default apache site with the config we created.
ADD docker/apache-config.conf /etc/apache2/sites-enabled/000-default.conf
ADD docker/apache2-port.conf /etc/apache2/ports.conf
ADD docker/apache2.conf /etc/apache2/apache2.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
ENTRYPOINT [ "bash","/var/www/app/docker-entrypoint.sh" ]

CMD /usr/sbin/apache2ctl -D FOREGROUND




