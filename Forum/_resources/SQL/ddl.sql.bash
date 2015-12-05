#!/bin/bash

mysql --host=localhost --user=username --password=p@55W0rd --database=example_database < $( dirname "${BASH_SOURCE[0]}" )/forum.ddl.sql
