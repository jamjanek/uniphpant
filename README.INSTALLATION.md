# Vagrantfile for Uniphpant Standalone SPA 1.0 #

Multi-website Single Page Application build with Slim Framework 4.

* **version**: 	`1.0`
* **PHP**: `7.4`
* **app-identifier**: `uniphpant-standalone-single-page-application-1.0`
* **site-identifier**: `default`
* **dependencies**: `beanstalkd zip unzip curl supervisor memcached libapache2-mod-php`
* **php-extensions**: `php7.4-sqlite php-xml php-bcmath php-bz2 php-cli php-curl php-intl php-json php-mbstring php-gd php-memcached`
* **Vagrant plugins**: `vagrant plugin install vagrant-hostsupdater vagrant-auto_network`

### Install SQLite3 schema with Phinx
* Remove Content database `rm ./var/data/database/content-${SITE_ID}--development.sqlite3`
* Create Content database `touch ./var/data/database/content-${SITE_ID}--development.sqlite3`
* For the site Content migration use schema provided by the application `php /var/www/vendor/bin/phinx migrate -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_app.yml -e development`
* For the site Content seeding use data provided by the application `php /var/www/vendor/bin/phinx seed:run -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_app.yml -e development`
* For the site Content migration use schema provided by the site package `php /var/www/vendor/bin/phinx migrate -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_site.yml -e development`
* For the site Content seeding use data provided by the site package `php /var/www/vendor/bin/phinx seed:run -c /var/www/sites/${SITE_ID}/dist/source/phinx_content_site.yml -e development`