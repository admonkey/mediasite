INSERT INTO Forum_Threads (thread_name, thread_createdby_user_id)
  VALUES ('Hellow Orld!', 1),('A New Thread', 2);

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