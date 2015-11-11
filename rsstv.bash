#!/bin/bash
DEBUGS=true

# change these variables to match your environment
rssURL="https://example.com/path-to-feed/rss?"
feedList="feeds.lst"
feeds=$rssURL
workingDirectory=$HOME"/rsstv/"
favorites=$workingDirectory"tvShows.lst"
downloadDirectory=$workingDirectory"downloads/"
# # "Name" cannot have spaces in it.
emailFrom="Name<username-from@example.com>"
emailTo="username-to@example.com"

# optionally store these variables in a separate file
source creds.bash


# validate directories
# # working directory
  if [ -d "$workingDirectory" ]; then
    cd $workingDirectory
  else
    echo "ERROR: working directory '"$workingDirectory"' doesn't exist. Exiting."
    exit 1
  fi

  # download directory
  if [ ! -d "$downloadDirectory" ]; then
    echo "downloads directory '"$downloadDirectory"' not found."
    echo "using '"$workingDirectory"' for downloads."
    downloadDirectory=$workingDirectory
  fi

# main log file
# # file name
  if $DEBUGS; then
    chronicle=$workingDirectory"DEBUGS--chronicle.log"
  else
    chronicle=$workingDirectory"chronicle.log"
  fi

  # temp file
  temp=$workingDirectory"temp.log"

  # log writer 
  function chronicle {
    echo $(date)" "$1 > $temp
    head -200 $chronicle >> $temp
    mv $temp $chronicle
  }


# begin
chronicle "-- rsstv script executing..."

# get favorite list
# # validate list exists
  if [ ! -f $favorites ]; then
    msg="ERROR: no list of favorites. Exiting."
    chronicle "$msg"; echo $msg
    exit 1
  fi

  # read into array
  shows=( $( cat $favorites ) )

  
# get list of feeds
if [ -f $feedList ]; then
  feeds=( $( cat $feedList ) )
else
  # FIX read first URL into array
  echo "need to use single feed for list[0]"
fi

# iterate through feed list
for feed in ${feeds[*]}; do
  # get next feed URL
  rssURL=$feed

  # # get snatched.log
    # FIX need to get log names before loop
    # file name
    if $DEBUGS; then
      snatchlog=$workingDirectory"DEBUGS--snatched.log"
    else
      snatchlog=$workingDirectory"snatched.log"
    fi

    # create it if it doesn't exist
    if [ ! -f $snatchlog ]; then
      chronicle "creating new "$snatchlog
      echo "snatch" > $snatchlog
    fi
    
    # get list into array
    snatched=( $( cat $snatchlog ) )


  # get new rss
  # # file name
    if $DEBUGS; then
      newrss=$workingDirectory"DEBUGS--new.xml"
    else
      newrss=$workingDirectory"new.xml"
    fi
    
    # download xml
    curl -s --max-time 30 -o $newrss $rssURL


  # case insensitive comparison
  shopt -s nocasematch

  # iterate through news items
  let itemsCount=$(xmllint --xpath 'count(rss/channel/item/link)' $newrss)
  for ((i=0; i < $itemsCount; i++)); do
  
    # get news item
    # FIX need validate xmllint installed
    item=$(xmllint --xpath 'rss/channel/item['$i+1']/title/text()' $newrss)

    # iterate through every favorite show
    for show in ${shows[*]}; do
      # check to see if news item matches favorite show
      if [[ $item == "$show"* ]]; then

	# print show to console
	if $DEBUGS; then echo $show; fi
	
	# potential new show found
	found=0


	# get character length of show name
	showlen=${#show}
	
	# regular expression for integer number
	re='^[0-9]+$'
	
	# get episode number
	# # check episode format S00E00
	if    [[ ${item:($showlen+1):1} == "s" ]] && \
	      [[ ${item:($showlen+2):2} =~ $re ]] && \
	      [[ ${item:($showlen+4):1} == "e" ]] && \
	      [[ ${item:($showlen+5):2} =~ $re ]]; then
	      
	      episode=${item:($showlen+1):6}
	  
	# # check episode format 20YY-MM-DD
	elif  [[ ${item:($showlen+1):4} =~ $re ]] && \
	      [[ ${item:($showlen+5):1} == '.' ]] && \
	      [[ ${item:($showlen+6):2} =~ $re ]] && \
	      [[ ${item:($showlen+8):1} == '.' ]] && \
	      [[ ${item:($showlen+9):2} =~ $re ]]; then
	  
	      episode=${item:($showlen+1):10}
	  
	else
	  found=2
	fi
	
	# print episode number to console
	if $DEBUGS; then echo -e '\t'$episode; fi


	# check to see if already snatched
	for each in ${snatched[*]}; do
	  check=$show'.'$episode
	  if [[ $each == $check* ]]; then
	    if $DEBUGS; then echo -e '\t'"already snatched."; fi
	    found=1
	    break
	  fi
	done

	# quit loop if found already
	# FIX why if debugs = false?
	if [ $found == 1 ] && [ $DEBUGS = false ]; then break; fi

	# download new item
	if [ $found == "0" ]; then
	
	  # get download link URL
	  dl=$(xmllint --xpath 'rss/channel/item['$i+1']/link/text()' $newrss)
	  
	  # download file
	  cd $downloadDirectory && { curl -s --max-time 30 -O $dl ; cd $workingDirectory; }
	  
	  # print download to console
	  if $DEBUGS; then echo -e '\t'"snatching $item"; fi

	  # snatched.log
	  echo $item > $temp; head -50 $snatchlog >> $temp; mv $temp $snatchlog

	  chronicle "snatched $item"

	  # email
	  if ! $DEBUGS; then echo $item | mail -s "new episode" -aFrom:$emailFrom $emailTo; fi
	fi
      fi
    done
  done

done

chronicle "-- rsstv script executed."

