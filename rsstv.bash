#!/bin/bash

# change these variables to match your environment
rssURL="https://example.com/path-to-feed/rss?"
feedList="feeds.lst"
feeds=$rssURL
workingDirectory=$HOME"/rsstv/"
favorites=$workingDirectory"tvShows.lst"
downloadDirectory=$workingDirectory"downloads/"
# "Name" cannot have spaces in it.
emailFrom="Name<username-from@example.com>"
emailTo="username-to@example.com"

# optionally store these variables in a separate file
source creds.bash
DEBUGS=true

# validate directories
if [ -d "$workingDirectory" ]; then cd $workingDirectory
else echo "error: working directory '"$workingDirectory"' doesn't exist"; exit 1; fi
if [ ! -d "$downloadDirectory" ]; then
	echo "downloads directory '"$downloadDirectory"' not found."
	echo "using '"$workingDirectory"' for downloads."
	downloadDirectory=$workingDirectory
fi

# main log file
if [ $DEBUGS = true ]
        then chronicle=$workingDirectory"DEBUGS--chronicle.log"
        else chronicle=$workingDirectory"chronicle.log"; fi
temp=$workingDirectory"temp.log"
function chronicle {
        echo $(date)" "$1 > $temp; head -200 $chronicle >> $temp; mv $temp $chronicle
}

chronicle "-- rsstv script executing..."

# get favorite list
if [ ! -f $favorites ]; then msg="no list of favorites"; chronicle "$msg"; echo $msg; exit 1; fi
shows=( $( cat $favorites ) )

# get list of feeds
if [ -f $feedList ]; then
	feeds=( $( cat $feedList ) )
fi

for feed in ${feeds[*]}; do
	rssURL=$feed

# get snatched.log
if [ $DEBUGS = true ]
	then snatchlog=$workingDirectory"DEBUGS--snatched.log"
	else snatchlog=$workingDirectory"snatched.log"; fi
if [ ! -f $snatchlog ]; then chronicle "creating new "$snatchlog; echo "snatch" > $snatchlog; fi
snatched=( $( cat $snatchlog ) )

# get new rss
if [ $DEBUGS = true ]; then newrss=$workingDirectory"DEBUGS--new.xml"; else newrss=$workingDirectory"new.xml"; fi
curl -s -o $newrss $rssURL

# case insensitive comparison
shopt -s nocasematch

# iterate through news items
let itemsCount=$(xmllint --xpath 'count(rss/channel/item/link)' $newrss)
for ((i=0; i < $itemsCount; i++)); do
    item=$(xmllint --xpath 'rss/channel/item['$i+1']/title/text()' $newrss)

	# check to see if news item matches any favorites
	for show in ${shows[*]}; do
		if [[ $item == "$show"* ]]; then
                        found=0

			# get episode number
			showlen=${#show}
			if [ $DEBUGS = true ]; then echo $show" length "$showlen; fi
			re='^[0-9]+$' # regular expression for integer number
			if [[ ${item:($showlen+1):1} == "s" ]] && [[ ${item:($showlen+2):2} =~ $re ]] &&  [[ ${item:($showlen+4):1} == "e" ]] && [[ ${item:($showlen+5):2} =~ $re ]]
				then episode=${item:($showlen+1):6}
				else if [[ ${item:($showlen+1):4} =~ $re ]] && [[ ${item:($showlen+5):1} == '.' ]] &&  [[ ${item:($showlen+6):2} =~ $re ]] && [[ ${item:($showlen+8):1} == '.' ]] && [[ ${item:($showlen+9):2} =~ $re ]]
					then episode=${item:($showlen+1):10}; else found=2; fi
			fi
			if [ $DEBUGS = true ]; then echo "episode "$episode; fi

			# check to see if already snatched
			for each in ${snatched[*]}; do
				check=$show'.'$episode
				if [[ $each == $check* ]]; then
					if [ $DEBUGS = true ]; then echo "already snatched."; fi

					found=1
					break
				fi
			done
			if [ $found == 1 ] && [ $DEBUGS = false ]; then break; fi

			# download new item
			if [ $found == "0" ]; then
				dl=$(xmllint --xpath 'rss/channel/item['$i+1']/link/text()' $newrss)
				cd $downloadDirectory && { curl -s -O $dl ; cd $workingDirectory; }
				if [ $DEBUGS = true ]; then echo "snatching $item"; fi

				# snatched.log
				echo $item > $temp; head -50 $snatchlog >> $temp; mv $temp $snatchlog

				chronicle "snatched $item"

                                # email
                                if [ $DEBUGS = false ]; then echo $item | mail -s "new episode" -aFrom:$emailFrom $emailTo; fi
			fi
		fi
	done
done

done

chronicle "-- rsstv script executed."

