-- CREATE DATABASE example_database;

-- CREATE USER 'username'@'localhost' IDENTIFIED BY 'p@55W0rd';

-- GRANT ALL PRIVILEGES ON example_database.* TO 'username'@'localhost';

DROP TABLE IF EXISTS Objects;
CREATE TABLE Objects (
  object_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  object_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  object_title VARCHAR(50) NOT NULL,
  object_description VARCHAR(1000)
);

INSERT INTO Objects (object_title, object_description)
  VALUES ('first object', 'This would be the description for the first object.');
INSERT INTO Objects (object_title, object_description)
  VALUES ('second object', 'Description for the second object.');
INSERT INTO Objects (object_title, object_description)
  VALUES ('third object', 'After the title, then would be the description for the third object.');
INSERT INTO Objects (object_title, object_description)
  VALUES ('fourth object', 'More information can be found here about the fourth object.');
INSERT INTO Objects (object_title, object_description)
  VALUES ('fifth object', 'Further reading for the fifth object.');
INSERT INTO Objects (object_title, object_description)
  VALUES ('sixth object', 'This would be the description for the sixth object.');