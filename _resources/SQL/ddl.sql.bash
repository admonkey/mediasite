#!/bin/bash

ddl_files=( \
  "Tables/_resources/SQL/Object.ddl.sql"\
  "Forum/_resources/SQL/Forum.drop.sql"\
  "Login/Database/_resources/SQL/Users.drop.sql"\
  "Login/Database/_resources/SQL/Users.ddl.sql"\
  "Forum/_resources/SQL/Forum.ddl.sql"\
  "Forum/_resources/SQL/Forum.procedures.sql"\
)

# move to working directory
cd $( dirname "${BASH_SOURCE[0]}" )
cd ../..

for ddl in "${ddl_files[@]}"
do
  mysql --host=localhost --user=username --password=p@55W0rd --database=example_database < $ddl
done