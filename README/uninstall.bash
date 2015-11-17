#!/bin/bash

read -e -p "Enter the fully qualified domain name of the host to DELETE.
(for example: www.example.com): " siteName
if [[ -z "$siteName" ]]; then
	echo "error: site name cannot be empty."
	exit 1
fi

sudo a2dissite $siteName && sudo service apache2 restart

sudo rm "/etc/apache2/sites-available/"$siteName".conf"

# move to working directory
cd $( dirname "${BASH_SOURCE[0]}" )
cd ..
currentGitDir=$(pwd)

# remove ssl files
rm -iv $currentGitDir/ssl/$siteName.crt
rm -iv $currentGitDir/ssl/$siteName.key

git checkout master
git branch -D $siteName

# rename cloned directory for virtual host
vhostDirectory=$( cd .. && pwd )
# option to abort
echo -e "RENAMING $currentGitDir/ to $vhostDirectory/WebSite"
read -p "Press 'n' to abort, or just press ENTER to continue: "
if [[ ${REPLY:0:1} = "n" ]]; then
  exit 0
else
  vhostDirectory=$vhostDirectory/WebSite
  mv -v $currentGitDir $vhostDirectory
fi