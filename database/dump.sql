CREATE TABLE `user`
(
  `id` VARCHAR(11) NOT NULL PRIMARY KEY,
  `username` VARCHAR(11) NOT NULL,
  `password` VARCHAR(11) NOT NULL,
  `full_name` VARCHAR(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;
