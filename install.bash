#!/bin/bash

# INITIALIZE BOOLEAN OPTION VARIABLES
createVhost=false
createSSL=false
createGIT=false

# GET OPTIONS FROM PARAMETERS
if ! [[ -z "$1" ]]; then

  # VALIDATE SWITCH
  if ! [[ ${1:0:1} = "-" ]]; then
        echo "Invalid option '${1:0:1}'"
        echo "Expecting switch '-${1:0:1}'"
        echo "Exiting"; exit 1
  fi

  # SPLIT INTO ARRAY
  # remove switch '-' character to prevent command usage in pipeline
  options=( $(echo ${1:1} | grep -o .) )

  # LOOP THROUGH ARRAY OF OPTIONS
  for opt in "${options[@]}"
  do

	# SET BOOLEAN OPTIONS
	case $opt in

		a)
		  # SET ALL OPTIONS
		  createVhost=true
		  createSSL=true
		  createGIT=true
		  ;;

		h)
		  # CREATE APACHE 2.4 VIRTUAL HOST
		  if [[ $( apache2 -version | grep 2.4 ) ]]; then
			createVhost=true
		  else
			echo "Apache 2.4 not found. Cannot create virtual host file."
			createVhost=false
		  fi
		  ;;

		s)
		  # CREATE SSL CERTIFICATE
		  if $(command -v openssl >/dev/null 2>&1); then
			createSSL=true
		  else
		  	echo "openssl not found. Cannot create SSL certificate."
			createSSL=false
		  fi
		  ;;

		g)
		  # CREATE NEW GIT BRANCH
		  if $(command -v git >/dev/null 2>&1); then
			createGIT=true
		  else
		  	echo "git not found. Cannot create new branch."
			createGIT=false
		  fi
		  ;;

		*)
		  echo "Invalid option '-$opt'"
		  echo $"Expecting:  -h(host) | -s(SSL) | -g(git) | -a(all)"
		  echo "Exiting"; exit 1
		  ;;

	esac

  done


# GET OPTIONS FROM PROMPT
else

  # CREATE APACHE 2.4 VIRTUAL HOST
  if [[ $( apache2 -version | grep 2.4 ) ]]; then
	  echo "Would you like to create a new Apache virtual host?"
	  read -p "(y/n): "

	  if [[ ${REPLY:0:1} = "y" ]]; then
		createVhost=true
	  fi
  fi

  # CREATE SSL CERTIFICATE
  if $(command -v openssl >/dev/null 2>&1); then
	  echo "Would you like to create a self-signed SSL certificate?"
	  read -p "(y/n): "

	  if [[ ${REPLY:0:1} = "y" ]]; then
		createSSL=true
	  fi
  fi

  # CREATE NEW GIT BRANCH
  if $(command -v git >/dev/null 2>&1); then
	  echo "Would you like to create a new git branch?"
	  read -p "(y/n): "

	  if [[ ${REPLY:0:1} = "y" ]]; then
		createGIT=true
	  fi
  fi

fi

# GET SITE NAME
read -e -p "Enter the fully qualified domain name of the site 
(for example: www.example.com): " siteName
if [[ -z "$siteName" ]]; then
	echo "Error: site name cannot be empty"
	echo "Exiting"; exit 1
fi

# RENAME CLONED DIRECTORY
currentGitDir=$(pwd)
vhostDirectory=$( cd .. && pwd )
vhostDirectory=$vhostDirectory/$siteName
mv -v $currentGitDir $vhostDirectory

# TRUMP DEFAULT WITH SITENAME IN CREDENTIALS FILE
echo "Creating web site PHP variables 'credentials.php'"
echo "<?php
	\$siteTitle = '$siteName';
?>" >> $vhostDirectory/html/credentials.php

# CREATE VIRTUAL HOST
if $createVhost ; then
        echo "Creating Apache 2.4 virtual host..."
        vhostConf="/etc/apache2/sites-available/"$siteName".conf"
        if [ -f $vhostConf ]; then
		echo "Configuration file '"$vhostConf"' already exists."
		echo "Operation would overwrite. Please rename existing configuration file."
		echo "Aborting."
		exit 1
	fi
	echo "Creating virtual host configuration file..."
	echo "<VirtualHost *:80>
		ServerAdmin webmaster@$siteName
		ServerName $siteName
		DocumentRoot $vhostDirectory/html
	</VirtualHost>" > VirtualHostConfigurationFile
fi

# CREATE SSL CERTIFICATE
if $createSSL ; then
        echo "Creating self-signed SSL certificate..."
        sslDirectory=$vhostDirectory
	openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -keyout $sslDirectory/$siteName.key -out $sslDirectory/$siteName.crt -subj "/CN=$siteName/emailAddress=webmaster@$siteName"

	# APPEND VIRTUAL HOST CONFIGURATION FILE
	if $createVhost ; then
		echo "<IfModule mod_ssl.c>
		<VirtualHost *:443>
			ServerAdmin webmaster@$siteName
			ServerName $siteName
			DocumentRoot $vhostDirectory/html
			SSLEngine on
			SSLCertificateFile $sslDirectory/$siteName.crt
			SSLCertificateKeyFile $sslDirectory/$siteName.key
		</VirtualHost>
		</IfModule>" >> VirtualHostConfigurationFile
		# ENABLE APACHE SSL MODULE
		sudo a2enmod ssl
	fi
fi

# ENABLE NEW VIRTUAL HOST
if $createVhost ; then
	sudo mv VirtualHostConfigurationFile $vhostConf
	sudo a2ensite $siteName && sudo service apache2 restart
fi

# CREATE NEW GIT BRANCH
if $createGIT ; then
        echo "Creating new git branch..."
        git checkout -b $siteName
	git rm README.md
	git rm $0
	git add .
	git commit -m "create $siteName"

	# CREATE PRIVATE REMOTE
	read -e -p "Enter the URL for new private git remote.
	To skip, leave blank and press ENTER : " gitRemote
	if ! [[ -z "$gitRemote" ]]; then
		git remote add private $gitRemote
		git push private $siteName
	fi
fi
