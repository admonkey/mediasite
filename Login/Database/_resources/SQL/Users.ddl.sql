DROP TABLE IF EXISTS `Users_Login_Attempts`;
DROP TABLE IF EXISTS `Users`;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(30) NOT NULL UNIQUE,
  `email` VARCHAR(50) NOT NULL UNIQUE,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `password` CHAR(128) NOT NULL,
  `salt` CHAR(128) NOT NULL
);

CREATE TABLE IF NOT EXISTS `Users_Login_Attempts` (
  `user_id` INT NOT NULL,
  `time` VARCHAR(30) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);