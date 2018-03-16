DROP SCHEMA `gtw`;
CREATE SCHEMA `gtw`;
USE `gtw`;
CREATE TABLE `user`
(
  `id` VARCHAR(100) NOT NULL PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `full_name` VARCHAR(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `password`, `full_name`) VALUES
('725a7f14-ed1a-45e2-b82c-24736c673429', 'mike', 'mike', 'Mike'),
('2929d8a4-7c3a-4fbc-a564-126aece71447', 'miki', 'miki', 'Miki'),
('e1346b39-671c-4f46-93e6-41b70a482594', 'pribi', 'pribi', 'Pribi'),
('221d67d2-04dc-4993-a243-591661ad8642', 'yuri', 'yuri', 'Yuri');

CREATE TABLE `address`
(
  `user_id` VARCHAR(100) NOT NULL,
  `home_address` VARCHAR(200) NOT NULL,
  `work_address` VARCHAR(200) NOT NULL,
  `home_geo` VARCHAR(100) NOT NULL,
  `work_geo` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

INSERT INTO `address` (`user_id`, ) VALUES
('725a7f14-ed1a-45e2-b82c-24736c673429', 'Eurener Straße, Trier, Germany', '44 Avenue John F. Kennedy, Luxembourg', '', ''),
('2929d8a4-7c3a-4fbc-a564-126aece71447', "Route d'Arlon, Luxembourg", '44 Avenue John F. Kennedy, Luxembourg', '', ''),
('e1346b39-671c-4f46-93e6-41b70a482594', 'Luxemburger Straße, Trier, Germany', '44 Avenue John F. Kennedy, Luxembourg', '', ''),
('221d67d2-04dc-4993-a243-591661ad8642', 'Luxembourg Central Station, Luxembourg City, Luxembourg', '44 Avenue John F. Kennedy, Luxembourg', '', '');
