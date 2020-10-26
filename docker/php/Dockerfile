# Set php 7.3 fpm image version
FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www

# Install libs
RUN apt-get update \
  && apt-get install -y \
    git \
    vim \
    zip \
    unzip \
  && apt-get clean

# Install lumen dependencies
RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
