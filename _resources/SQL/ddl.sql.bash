#!/bin/bash

# must be in proper order for drop/add with key relationships
sql_files=( \
  "Forum/_resources/SQL/Forum.drop.sql"\
  "Login/Database/_resources/SQL/Users.drop.sql"\
  "Login/Database/_resources/SQL/Users.ddl.sql"\
  "Forum/_resources/SQL/Forum.ddl.sql"\
  "Forum/_resources/SQL/Forum.procedures.sql"\
  "Tables/_resources/SQL/Object.ddl.sql"\
)

# move to working directory
cd $( dirname "${BASH_SOURCE[0]}" )
cd ../..

for sql in "${sql_files[@]}"
do
  mysql --host=localhost --user=username --password=p@55W0rd --database=example_database < $sql
done