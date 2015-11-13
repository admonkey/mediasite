# rsstv
bash script for:
 1. downloading an RSS (XML) feed of TV shows
 2. checking the feed for any shows on "favorites list"
 3. downloading links for all the new favorite shows

## Requirements
- GNU bash, version 4.3.11(1)-release (x86_64-pc-linux-gnu)
- curl 7.35.0
- xmllint: using libxml version 20901

## Optional
- mailutils

## Getting Started
edit the `rsstv.bash` file and change the variables at the top.
- specify the URL's for your RSS feeds
- list out your favorite TV shows
- if using mailutils, then set `DEBUGS=false` and specify your email address for notifications

## Automation
to check for your new shows every 10 minutes, edit your crontab  
`crontab -e`  
and write a line similar to this:  
`*/10 * * * * ~/rsstv/rsstv.bash > /dev/null`  
[more info on crontab](https://help.ubuntu.com/community/CronHowto)
