CREATE DATABASE example_database;

CREATE USER 'username'@'localhost' IDENTIFIED BY 'p@55W0rd';

GRANT ALL PRIVILEGES ON example_database.* TO 'username'@'localhost';