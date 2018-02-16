#!/bin/sh

echo "--> APPLICATION_ENV=$APPLICATION_ENV"

if [ -z $APPLICATION_ENV ]
then
  echo "!! You must set the APPLICATION_ENV env var"
  exit 1
fi

if [ "$APPLICATION_ENV" = "Production" ]
then
  echo !! composer install --no-dev
  composer install --no-dev
else
  # Install test env dependencies
  pecl install xdebug
  echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini
  apt-get install -y mysql-client
fi

chown -R www-data:www-data /www
