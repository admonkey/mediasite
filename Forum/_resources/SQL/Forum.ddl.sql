-- TABLES --
-- threads
CREATE TABLE IF NOT EXISTS Forum_Threads (
  thread_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  thread_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  thread_name VARCHAR(100) NOT NULL,
  thread_createdby_user_id INT NOT NULL,
  FOREIGN KEY (thread_createdby_user_id) REFERENCES Users(user_id),
  thread_deleted BIT(1) DEFAULT 0,
  thread_deleted_time TIMESTAMP,
  thread_deletedby INT,
  FOREIGN KEY (thread_deletedby) REFERENCES Users(user_id)
);


-- messages
CREATE TABLE IF NOT EXISTS Forum_Messages (
  message_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  message_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  message_text VARCHAR(140) NOT NULL,
  message_thread_id INT NOT NULL,
  FOREIGN KEY (message_thread_id) REFERENCES Forum_Threads(thread_id),
  message_author_user_id INT NOT NULL,
  FOREIGN KEY (message_author_user_id) REFERENCES Users(user_id),
  message_deleted BIT(1) DEFAULT 0,
  message_deleted_time TIMESTAMP,
  message_deletedby INT,
  FOREIGN KEY (message_deletedby) REFERENCES Users(user_id),
  message_edited_time TIMESTAMP,
  message_editedby INT,
  FOREIGN KEY (message_editedby) REFERENCES Users(user_id)
);
