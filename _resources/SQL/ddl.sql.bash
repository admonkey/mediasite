#!/bin/bash

database_server="localhost"
database_user="username"
database_password="p@55W0rd"
database_name="example_database"

include_fake_data=true


# must be in proper order for drop/add with key relationships
ddl_files=( \
  "Forum/_resources/SQL/Forum.drop.sql"\
  "Login/Database/_resources/SQL/Users.drop.sql"\
  "Login/Database/_resources/SQL/Users.ddl.sql"\
  "Forum/_resources/SQL/Forum.ddl.sql"\
  "Forum/_resources/SQL/Forum.procedures.sql"\
  "Tables/_resources/SQL/Objects.ddl.sql"\
)
fake_data_files=( \
  "Login/Database/_resources/SQL/Users.fakedata.sql"\
  "Forum/_resources/SQL/Forum.fakedata.sql"\
  "Tables/_resources/SQL/Objects.fakedata.sql"\
)

# move to working directory
cd $( dirname "${BASH_SOURCE[0]}" )
cd ../..

# trump credentials if external file exists
if [ -f credentials_local.bash ]; then
  source credentials_local.bash
fi

if $include_fake_data; then
  for sql in "${fake_data_files[@]}"
  do
    ddl_files+=($sql)
  done
fi

for sql in "${ddl_files[@]}"
do
  mysql --host=$database_server --user=$database_user --password=$database_password --database=$database_name < $sql
done
