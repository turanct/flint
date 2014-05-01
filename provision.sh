#!/bin/bash

#
# Basics
#

echo "--> Installing basics"
apt-get update
apt-get install -y vim git tree curl


#
# MySQL
#

echo "--> Installing MySQL"
# Set username and password to 'root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get install -y mysql-server


#
# PHP
#

echo "--> Installing php"
add-apt-repository -y ppa:ondrej/php5 # php 5.5
# add-apt-repository -y ppa:ondrej/php5-oldstable # php 5.4
apt-get update
apt-get install -y php5 php5-mysql php5-sqlite php5-gd php5-curl php5-xdebug php5-memcached php5-imagick php5-intl


#
# Apache
#

echo "--> Installing apache"
apt-get install -y apache2

# Enable the mod_rewrite
a2enmod rewrite

echo '<VirtualHost *:80>
        ServerAdmin webmaster@localhost

        DocumentRoot /var/www
        <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined

    Alias /doc/ "/usr/share/doc/"
    <Directory "/usr/share/doc/">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride None
        Order deny,allow
        Deny from all
        Allow from 127.0.0.0/255.0.0.0 ::1/128
    </Directory>

</VirtualHost>' > /etc/apache2/sites-available/default


# Output
echo "--> Setting up /var/www"

# Remove /var/www
rm -rf /var/www

# Link our html file to the apache web directory
ln -s /vagrant /var/www

# Restart apache
echo "--> Restarting apache"
service apache2 restart

