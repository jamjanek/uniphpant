#!/bin/bash

# sh install_content_sqlite3.sh default

SITE_ID="$1"

echo "$APP_ENV";

## Remove and create Sqlite3 db for Content
rm /var/www/var/data/database/content-${SITE_ID}--development.sqlite3
touch /var/www/var/data/database/content-${SITE_ID}--development.sqlite3

## For the site Content migration use schema provided by the application
php /var/www/vendor/bin/phinx migrate -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_app.yml -e development
## For the site Content seeding use data provided by the application
php /var/www/vendor/bin/phinx seed:run -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_app.yml -e development


## For the site Content migration use schema provided by the site package
php /var/www/vendor/bin/phinx migrate -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_site.yml -e development
## For the site Content seeding use data provided by the site package
php /var/www/vendor/bin/phinx seed:run -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_site.yml -e development