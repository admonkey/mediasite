#!/bin/bash

read -e -p "Enter the fully qualified domain name of the site 
(for example: www.example.com): " siteName
if [[ -z "$siteName" ]]; then
	echo "error: site name cannot be empty."
	exit 1
fi

# rename cloned directory for virtual host
currentGitDir=$(pwd)
vhostDirectory=$( cd .. && pwd )
vhostDirectory=$vhostDirectory/$siteName
mv -v $currentGitDir $vhostDirectory

sslDirectory=$vhostDirectory
vhostConf="/etc/apache2/sites-available/"$siteName".conf"

if [ -f $vhostConf ]; then
	echo "Configuration file '"$vhostConf"' already exists."
	echo "Operation would overwrite. Please rename existing configuration file."
	echo "Aborting."
	exit 1
fi

echo "Creating web site PHP variables 'credentials.php'"
echo "<?php
	\$siteTitle = '$siteName';
?>" >> $vhostDirectory/html/credentials.php

echo "Creating self-signed SSL certificate..."
openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -keyout $sslDirectory/$siteName.key -out $sslDirectory/$siteName.crt -subj "/CN=$siteName/emailAddress=webmaster@$siteName"

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
</IfModule>" > VirtualHostConfigurationFile

sudo mv VirtualHostConfigurationFile $vhostConf

sudo a2enmod ssl
sudo a2ensite $siteName && sudo service apache2 restart

git checkout -b $siteName
git rm README.md
git rm $0
git add .
git commit -m "create $siteName"

read -e -p "Enter the url for new private git remote: " gitRemote
if ! [[ -z "$gitRemote" ]]; then
	git remote add private $gitRemote
	git push private $siteName
fi
