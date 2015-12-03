DROP TABLE IF EXISTS Forum_Messages;
DROP TABLE IF EXISTS Forum_Threads;


-- threads
CREATE TABLE Forum_Threads (
  thread_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  thread_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  thread_name VARCHAR(100) NOT NULL,
  thread_createdby_user_id INT NOT NULL
  -- TODO: add foreign key constraint to User table.
);

INSERT INTO Forum_Threads (thread_name, thread_createdby_user_id)
  VALUES ('Hellow Orld!', 1),('A New Thread', 2);


-- messages
CREATE TABLE Forum_Messages (
  message_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  message_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  message_text VARCHAR(140) NOT NULL,
  message_thread_id INT NOT NULL,
  FOREIGN KEY (message_thread_id) REFERENCES Forum_Threads(thread_id),
  message_author_user_id INT NOT NULL
  -- TODO: add foreign key constraint to User table.
);

INSERT INTO Forum_Messages (message_text, message_thread_id, message_author_user_id)
  VALUES
('first message is very bland.', 1, 1),
('second message is still bland.', 1, 2),
('third message is slightly interesting.', 1, 3),
('fourth message is catchy.', 1, 4),
('fifth message is pretty cool.', 1, 5),
('sixth message is profound.', 1, 6),
('This is a totally new thread!', 2, 2),
('Wow, this is so cool!', 2, 4),
('I love reading messages!', 2, 6);
