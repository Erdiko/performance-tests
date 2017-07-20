#!/usr/bin/env bash

# Add some color bling
GREEN='\033[0;32m'
RESET='\033[0m'

# Install composer dependencies and added phpbench alias
echo "${GREEN}Installing composer dependencies\n ${RESET}"

cd ../../
composer update
cd /usr/local/bin/
ln -s /benchmarks/vendor/phpbench/phpbench/bin/phpbench
phpbench -V

echo "${GREEN}Finished to install composer dependencies\n ${RESET}"


echo "${GREEN}Installing PECL Yaml library\n ${RESET}"

apt-get install -y libyaml-dev
printf "\n" | pecl install yaml-2.0.0
echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini
php -i | grep yaml

echo "${GREEN}Finished to install PECL Yaml library\n ${RESET}"