-- CREATE DATABASE example_database;

-- CREATE USER 'username'@'localhost' IDENTIFIED BY 'p@55W0rd';

-- GRANT ALL PRIVILEGES ON example_database.* TO 'username'@'localhost';

DROP TABLE IF EXISTS Message;
CREATE TABLE Message (
  message_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  message_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  message_text VARCHAR(140) NOT NULL,
  user_id INT NOT NULL
  -- TODO: add foreign key constraint to User table.
);

INSERT INTO Message (message_text, user_id)
  VALUES ('first message is very bland.', 1);
INSERT INTO Message (message_text, user_id)
  VALUES ('second message is still bland.', 2);
INSERT INTO Message (message_text, user_id)
  VALUES ('third message is slightly interesting.', 3);
INSERT INTO Message (message_text, user_id)
  VALUES ('fourth message is catchy.', 4);
INSERT INTO Message (message_text, user_id)
  VALUES ('fifth message is pretty cool.', 5);
INSERT INTO Message (message_text, user_id)
  VALUES ('sixth message is profound.', 6);