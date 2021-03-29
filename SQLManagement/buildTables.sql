CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email_address` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY (`username`),
  UNIQUE KEY (`email_address`)
);

CREATE TABLE IF NOT EXISTS `comments` (
  `media_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`media_id`),
  UNIQUE KEY (`user_id`),
);
