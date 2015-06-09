CREATE TABLE IF NOT EXISTS `beers` (
  `id` int(11) NOT NULL,
  `beername` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `beerprice` decimal(5,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `beers` (`id`, `beername`, `beerprice`) VALUES
(1, 'Bud', '5.05'),
(2, 'Coors', '8.49'),
(3, 'Corona', '13.99'),
(4, 'Genesee', '4.99'),
(5, 'Guiness Draught', '12.99'),
(6, 'Labatt', '7.99'),
(7, 'Sam Adams', '12.49');

ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `beers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `age`, `role`) VALUES
(1, 'test', 'testing', 25, 'admin'),
(2, 'kevin', 'kevin', 25, 'user'),
(3, 'menor', 'menor', 18, 'user');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL,
  `guid` varchar(200) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
