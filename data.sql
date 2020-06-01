-- Databasa name: php_ex_12

CREATE DATABASE IF NOT EXISTS `php_ex_12`;

USE `php_ex_12`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) DEFAULT NULL,
    `status` tinyint(1) DEFAULT '0' COMMENT '0: active 1:inactive',
    `ordering` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `users` (`id`,`name`, `status`, `ordering`) VALUES
(1, 'Miko', 0, 23),
(2, 'Takeshi', 1, 237),
(3, 'Vy', 1, 33),
(4, 'Thanh', 0, 7),
(5, 'Ashea', 1, 11),
(6, 'Key', 1, 99),
(7, 'Tk', 0, 44),
(8, 'Natsume', 0, 243),
(9, 'Khanh', 1, 2537),
(10, 'Binh', 1, 363),
(11, 'Vinh Hoa', 0,547),
(12, 'Jessica', 1, 151),
(13, 'Asha', 0, 23),
(14, 'Isi', 1, 237),
(15, 'Van', 1, 33),
(16, 'Hoa', 0, 557),
(17, 'Faang', 1, 91),
(18, 'Tim', 1, 89),
(19, 'Jes', 0, 54),
(20, 'Haku', 0, 343),
(21, 'Fir', 1, 87),
(22, 'Thany', 1, 63),
(23, 'Des', 0,47),
(24, 'Takuno', 1, 237),
(25, 'Viktor', 1, 33),
(26, 'Theresa', 0, 7),
(27, 'Barnabi', 1, 11),
(28, 'Karla', 1, 99),
(29, 'Taki', 0, 44),
(30, 'Nat', 0, 243)

