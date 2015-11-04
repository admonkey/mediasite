#!/bin/bash

read -e -p "Enter the fully qualified domain name of the host to DELETE.
(for example: www.example.com): " siteName
if [[ -z "$siteName" ]]; then
	echo "error: site name cannot be empty."
	exit 1
fi

sudo a2dissite $siteName && sudo service apache2 restart

sudo rm "/etc/apache2/sites-available/"$siteName".conf"

git checkout master
git branch -D $siteName

# rename cloned directory for virtual host
# move to working directory
cd $( dirname "${BASH_SOURCE[0]}" )
cd ..
currentGitDir=$(pwd)
vhostDirectory=$( cd .. && pwd )
vhostDirectory=$vhostDirectory/WebSite
mv -v $currentGitDir $vhostDirectory
