DROP PROCEDURE IF EXISTS Forum_proc_Update_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Delete_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Insert_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Fetch_Messages;
DROP TABLE IF EXISTS Forum_Messages;
DROP TABLE IF EXISTS Forum_Threads;


-- TABLES --
-- threads
CREATE TABLE Forum_Threads (
  thread_creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  thread_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  thread_name VARCHAR(100) NOT NULL,
  thread_createdby_user_id INT NOT NULL,
  -- TODO: add foreign key constraint to User table.
  thread_deleted BIT(1) DEFAULT 0,
  thread_deleted_time TIMESTAMP,
  thread_deletedby INT
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
  message_author_user_id INT NOT NULL,
  -- TODO: add foreign key constraint to User table.
  message_deleted BIT(1) DEFAULT 0,
  message_deleted_time TIMESTAMP,
  message_deletedby INT,
  -- TODO: add foreign key constraint to User table.
  message_edited_time TIMESTAMP,
  message_editedby INT
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


-- PROCEDURES --
DELIMITER $$

-- fetch messages
CREATE PROCEDURE Forum_proc_Fetch_Messages(
   IN p_thread_id INT
)
BEGIN

	SELECT * FROM Forum_Messages
	WHERE	message_thread_id = p_thread_id
	  AND	message_deleted = 0;

END $$

-- insert message, and return it
CREATE PROCEDURE Forum_proc_Insert_Message(
   IN p_message_text VARCHAR(140),
   IN p_message_thread_id INT,
   IN p_message_author_user_id INT,
   IN p_thread_name VARCHAR(100)
)
BEGIN

	IF p_message_thread_id IS NULL THEN
	  -- create thread
	  INSERT INTO Forum_Threads (thread_name, thread_createdby_user_id)
	  VALUES (p_thread_name, p_message_author_user_id);
	  
	  SET p_message_thread_id = LAST_INSERT_ID();
	
	END IF;
	
	INSERT INTO Forum_Messages
		(message_text,		message_thread_id,	message_author_user_id)
	VALUES
		(p_message_text,	p_message_thread_id,	p_message_author_user_id);

	SELECT * FROM Forum_Messages
	WHERE message_id = LAST_INSERT_ID();

END $$

-- delete message
CREATE PROCEDURE Forum_proc_Delete_Message(
   IN p_user_id INT,
   IN p_message_id INT,
   IN deleted BIT(1)
)
BEGIN

	UPDATE	Forum_Messages
	SET	message_deleted = deleted,
		message_deleted_time = CURRENT_TIMESTAMP,
		message_deletedby = p_user_id
	WHERE	message_id = p_message_id;

END $$

-- update message
CREATE PROCEDURE Forum_proc_Update_Message(
   IN p_user_id INT,
   IN p_message_id INT,
   IN p_message_text VARCHAR(140)
)
BEGIN

	UPDATE	Forum_Messages
	SET	message_text = p_message_text,
		message_edited_time = CURRENT_TIMESTAMP,
		message_editedby = p_user_id
	WHERE	message_id = p_message_id;

	SELECT * FROM Forum_Messages
	WHERE message_id = p_message_id;

END $$

DELIMITER ;
