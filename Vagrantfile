# -*- mode: ruby -*-
# vi: set ft=ruby :

# vagrant plugin install vagrant-hostsupdater vagrant-auto_network

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT

# Install dependencies

export APP_ENV=development
export DEBIAN_FRONTEND=noninteractive

apt-get update -y

apt-get install -y software-properties-common apache2 zip unzip curl

apt-get install -y composer beanstalkd supervisor memcached libmemcached-tools

apt-get install -y php7.4-sqlite php-xml php-bcmath php-bz2 php-cli php-curl php-intl php-json php-memcached 

apt-get install -y libapache2-mod-php

apt-get install -y phpunit

apt-get install -y php-xdebug

echo "\n[xdebug]" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.default_enable=1" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_autostart=0" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_connect_back=1" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_enable=1" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_port=9000" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_host='127.0.0.1'" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.idekey='PHPSTORM'" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.remote_mode=req" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.var_display_max_depth='-1'" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.var_display_max_children='-1'" >> /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.var_display_max_data='-1'" >> /etc/php/7.4/mods-available/xdebug.ini

service memcached start

# Configure Apache
echo "<VirtualHost *:80>
	DocumentRoot \"/var/www/sites/default/public\"
	AllowEncodedSlashes On

	ServerName "uniphpant.local.vm";
	ServerAlias "www.uniphpant.local.vm";

	<Directory \"/var/www/sites/default/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php index.html
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/var/logs/apache2-error.log
   	CustomLog /var/www/var/logs/apache2-access.log combined

</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

a2ensite 000-default

a2enmod rewrite

# START APACHE2
service apache2 restart

rm -Rf /var/www/html

# Install Composer
if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi
if [ -e /var/www/composer.json ]; then
    cd /var/www/ && composer install
    composer dump-autoload -o
fi

# install SQL schema
sh ./dist/install/install_content_sqlite3.sh default

# Copy .env files
cp /var/www/.env.dist /var/www/.env
cp /var/www/sites/default/.env.dist /var/www/sites/default/.env

cd ~

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/vagrant/.profile; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi
echo 'ls -la' >> /home/vagrant/.profile

cd /var/www/

php -v


######
echo "\n"
echo "** Visit http://localhost:8089 ot http://uniphpant.local.vm in your browser for to view the application **"
SCRIPT


Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    config.vm.define "spa", primary: true do |spa|
        spa.vm.box = "ubuntu/focal64"
        spa.vm.network "forwarded_port", guest: 80, host: 8089
        spa.vm.network "forwarded_port", guest: 22, host: 8029
        spa.vm.network :private_network, :auto_network => true
        spa.vm.synced_folder './', '/var/www/', id:"app-root",owner:"vagrant",group:"www-data",mount_options:["dmode=777,fmode=666"]
        spa.vm.synced_folder './sites', '/var/www/sites', id:"sites",owner:"vagrant",group:"www-data",mount_options:["dmode=777,fmode=666"]
        spa.vm.provision 'shell', inline: @script
        spa.vm.hostname = 'uniphpant.local.vm'

        spa.vm.provider "virtualbox" do |vb|
            vb.customize ["modifyvm", :id, "--memory", "1024"]
            vb.customize ["modifyvm", :id, "--name", "uniphpant-spa-default"]
        end
    end
end

