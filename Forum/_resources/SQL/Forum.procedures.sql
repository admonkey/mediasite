DROP PROCEDURE IF EXISTS Forum_proc_Update_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Delete_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Insert_Message;
DROP PROCEDURE IF EXISTS Forum_proc_Fetch_Messages;

-- PROCEDURES --
DELIMITER $$

-- fetch messages
CREATE PROCEDURE Forum_proc_Fetch_Messages(
   IN p_thread_id INT
)
BEGIN

	SELECT m.*, u.username
	FROM Forum_Messages m
	JOIN Users u
	  ON u.user_id = m.message_author_user_id
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
