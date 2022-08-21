ARG PHP_VERSION
FROM php:${PHP_VERSION}

# Installs the latest composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Installs growfridge required packages
RUN apt-get update && apt-get install -y bash coreutils libxml2-dev libzip-dev libcurl4-openssl-dev unzip vim zip wget git nodejs openssh-client python3 yarn

# Installs the latest node version manager
RUN wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/$(curl -sL https://api.github.com/repos/nvm-sh/nvm/releases/latest | grep "tag_name" | cut -c16-22)/install.sh | bash

# Installs laravel php extension requirements
RUN docker-php-ext-install -j$(nproc) pdo_mysql pcntl xml zip curl

CMD ["php-fpm"]
