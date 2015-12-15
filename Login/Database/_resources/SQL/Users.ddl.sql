CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_creation_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` VARCHAR(30) NOT NULL UNIQUE,
  `email` VARCHAR(50) NOT NULL UNIQUE,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `password` CHAR(128) NOT NULL,
  `salt` CHAR(128) NOT NULL
);
-- ROOT USER PASSWORD IS P@55W0rd
INSERT INTO `Users` (username,email,first_name,last_name,password,salt)
  VALUES (
    'root','root@example.com','root','user',
    'e491685a7e7ea32116eadd3911848b22b734fd3685796c719c1b14fca0c76a5efede54b7e48f569d8579e1a295145e8aaf8053e735e2c692dc80528fe02670be',
    'ec51c8c90854b1d9f18a0ac9daa75d611c3d01f7ac4a12059439d730322659d3528596b6c674d8ea3ae8d14b8b552cb0b46c32912ae82e470bc52d04bd229b88'
  );


CREATE TABLE IF NOT EXISTS `User_Login_Attempts` (
  `user_id` INT NOT NULL,
  `time` VARCHAR(30) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);


CREATE TABLE IF NOT EXISTS `User_Groups` (
  `group_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `group_creation_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_name` VARCHAR(30) NOT NULL UNIQUE,
  `group_createdby_user_id` INT NOT NULL,
  FOREIGN KEY (group_createdby_user_id) REFERENCES Users(user_id)
);
INSERT INTO `User_Groups` (group_name,group_createdby_user_id) VALUES ('ADMIN',1);
INSERT INTO `User_Groups` (group_name,group_createdby_user_id) VALUES ('TEST',1);


CREATE TABLE IF NOT EXISTS `User_Groups-link` (
  `user_id` INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  `group_id` INT NOT NULL,
  FOREIGN KEY (group_id) REFERENCES User_Groups(group_id),
  `membership_creation_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(user_id,group_id)
);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (1,1);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (1,2);
