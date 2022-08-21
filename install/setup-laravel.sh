#!/bin/bash

# Execute commands within the docker container  to install laravel
docker exec php-fpm sh -c 'composer install'
docker exec php-fpm sh -c 'php artisan key:generate'
docker exec php-fpm sh -c 'php artisan migrate'
docker exec php-fpm bash -c '[[ -s $HOME/.nvm/nvm.sh ]] && . $HOME/.nvm/nvm.sh && nvm install 14'
docker exec php-fpm bash -c '[[ -s $HOME/.nvm/nvm.sh ]] && . $HOME/.nvm/nvm.sh && npm install'
docker exec php-fpm bash -c '[[ -s $HOME/.nvm/nvm.sh ]] && . $HOME/.nvm/nvm.sh && npm run build'

# Set correct ownership and permissions for laravel files and directories
sudo chown -R www-data:www-data ./src
sudo find ./src -type f -exec chmod 644 {} \;
sudo find ./src -type d -exec chmod 755 {} \;
sudo chmod 666 ./src/public/pic.jpg