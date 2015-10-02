#!/bin/bash

read -e -p "Enter the fully qualified domain name of the site 
(for example: www.example.com): " siteName
if [[ -z "$siteName" ]]; then
	echo "error: site name cannot be empty."
	exit 1
fi

vhostDirectory="/var/www/"$siteName
sslDirectory="/etc/apache2/ssl/"$siteName
vhostConf="/etc/apache2/sites-available/"$siteName".conf"

if [ -d $vhostDirectory ]; then
	echo "Directory '"$vhostDirectory"' already exists."
	echo "Operation would overwrite. Please rename existing folder."
	echo "Aborting."
	exit 1
fi

if [ -f $vhostConf ]; then
	echo "Configuration file '"$vhostConf"' already exists."
	echo "Operation would overwrite. Please rename existing configuration file."
	echo "Aborting."
	exit 1
fi

if [ -d $sslDirectory ]; then
	echo "Directory '"$sslDirectory"' already exists."
	echo "Operation would overwrite. Please rename existing folder."
	echo "Aborting."
	exit 1
fi

echo "Creating virtual host directory '"$vhostDirectory"'"
mkdir $vhostDirectory

echo "Creating web site PHP variables 'siteCreds.php'"
echo "<?php
	\$siteTitle = '$siteName';
?>" > $vhostDirectory/siteCreds.php

echo "Creating ssl directory '"$sslDirectory"'"
mkdir $sslDirectory

echo "Creating self-signed SSL certificate..."
openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -keyout $sslDirectory/$siteName.key -out $sslDirectory/$siteName.crt

echo "Creating virtual host configuration file..."
echo "<VirtualHost *:80>
        ServerAdmin webmaster@$siteName
        ServerName $siteName
        DocumentRoot $vhostDirectory/html
</VirtualHost>
<IfModule mod_ssl.c>
<VirtualHost *:443>
        ServerAdmin webmaster@$siteName
        ServerName $siteName
        DocumentRoot $vhostDirectory/html
        SSLEngine on
        SSLCertificateFile $sslDirectory/$siteName.crt
        SSLCertificateKeyFile $sslDirectory/$siteName.key
</VirtualHost>
</IfModule>" > $vhostConf

a2ensite $siteName && service apache2 restart
