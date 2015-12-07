# WebSite
blank template

## Purpose
This is built to take the tedium out of creating the following:  

- apache virtual host configuration  
- self-signed SSL certificate  
- common php/html/css and site includes for use with MySQL  
  - jquery-ui
  - bootstrap
  - tablesorter
  - chartist
  - active directory login session via php LDAP
- checkout new git branch and commit to private remote

## Requirements
Might work elsewhere, but designed and tested on:  
- Ubuntu 14.04  
  - GNU bash, version 4.3.11(1)  
- Apache 2.4.7  
  - .htaccess files use both `require all denied` and `deny from all` for backwards compatibility with 2.2
- PHP 5.5.9  
- OpenSSL 1.0.1f  
- Git 2.6.2
- MySQL  Ver 14.14 Distrib 5.5.46, for debian-linux-gnu (x86_64) using readline 6.3

## Issues
- Currently using the deprecated mysql functions. Need to upgrade to mysqli ASAP

## Getting Started
run `./_resources/_setup/install.bash`  
follow prompts
