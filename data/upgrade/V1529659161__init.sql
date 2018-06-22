CREATE TABLE `questionnaires` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `positions` text,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
