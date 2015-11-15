#!/bin/bash
DEBUGS=true

# RSS feeds
feeds=( 
  "https://example.com/path-to-feed/rss?" \
  "https://example.com/path-to-another-feed/rss?" \
)

# set working directory to current one by default
workingDirectory=$( cd $(dirname "${BASH_SOURCE[0]}") && pwd )"/"
downloadDirectory=$workingDirectory"downloads/"

# email notification
emailFrom="Name<username-from@example.com>"
emailTo="username-to@example.com"

# list of tv shows to watch
shows=( \
  "Last.Week.Tonight.With.John.Oliver" \
  "Game.of.Thrones" \
  "House.Of.Cards.2013" \
  "Fargo" \
  "Louie" \
  "Blackish" \
  "Portlandia" \
  "Workaholics" \
  "Key.and.Peele" \
  "Modern.Family" \
  "The.Big.Bang.Theory" \
  "Its.Always.Sunny.in.Philadelphia" \
  "The.Simpsons" \
  "Better.Call.Saul" \
  "Breaking.Bad" \
  "Family.Guy" \
  "American.Dad" \
  "Veep" \
  "Silicon.Valley" \
  "The.Daily.Show" \
  "Archer.2009" \
  "The.Venture.Bros" \
  "Community" \
  "The.Last.Man.On.Earth" \
  "Rick.and.Morty" \
  "South.Park" \
  "Trailer.Park.Boys" \
  "Man.Seeking.Woman" \
  "The.Brink" \
  "The.Jim.Gaffigan.Show" \
  "Stephen.Colbert" \
  "Gravity.Falls" \
)

# optionally store these variables in a separate file
if [ -f $workingDirectory"creds.bash" ]; then
  source $workingDirectory"creds.bash"
fi

# require xmllint
if ( ! command -v xmllint > /dev/null 2>&1); then
  echo "ERROR: xmllint required. install and try again. exiting."
  exit 1
fi

# require curl
if ( ! command -v curl > /dev/null 2>&1); then
  echo "ERROR: curl required. install and try again. exiting."
  exit 1
fi

# validate directories
# # working directory
  if [ ! -d "$workingDirectory" ]; then
    mkdir "$workingDirectory" || ( echo "ERROR: can't create $workingDirectory. Exiting."; exit 1 )
  fi
  
  cd $workingDirectory

  # download directory
  if [ ! -d "$downloadDirectory" ]; then
    mkdir "$downloadDirectory" || ( echo "ERROR: can't create $downloadDirectory. Exiting."; exit 1 )
  fi

# main log file
# # file name
  chronicle=$workingDirectory"chronicle.log"

  # log writer 
  function chronicle {
    echo $(date)" "$1 > temp
    head -200 $chronicle >> temp
    mv temp $chronicle
  }

# get snatched.log
snatchlog=$workingDirectory"snatched.log"

# # create it if it doesn't exist
  if [ ! -f $snatchlog ]; then
    chronicle "creating new "$snatchlog
    echo "snatch" > $snatchlog
  fi

# # get snatch list into array
  snatched=( $( cat $snatchlog ) )

# begin
chronicle "-- rsstv script executing..."

# iterate through feed list
for feed in ${feeds[*]}; do

  # get new rss
  # # file name
    newrss=$workingDirectory"new.xml"
    
    # download xml
    curl -s --max-time 30 -o $newrss $feed


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
	  echo $item > temp; head -50 $snatchlog >> temp; mv temp $snatchlog

	  chronicle "snatched $item"

	  # email
	  if ( command -v mail > /dev/null 2>&1); then
	    if ! $DEBUGS; then echo $item | mail -s "new episode" -aFrom:$emailFrom $emailTo; fi
	  fi
	fi
      fi
    done
  done

done

chronicle "-- rsstv script executed."

