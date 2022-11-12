/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `pet`;
CREATE TABLE `pet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `pet` (`id`, `name`, `type`, `owner`) VALUES
(1, 'Felix', 'cat', 1);
INSERT INTO `pet` (`id`, `name`, `type`, `owner`) VALUES
(2, 'Tobi', 'dog', 1);
INSERT INTO `pet` (`id`, `name`, `type`, `owner`) VALUES
(3, 'Hector', 'aligator', 2);
INSERT INTO `pet` (`id`, `name`, `type`, `owner`) VALUES
(4, 'Mireille', 'chicken', 2),
(5, 'Twitter', 'gnatcatcher', 2),
(6, 'Hamtaro', 'hamster', 3),
(7, 'Neko', 'cat', 4),
(8, 'Sylvestre', 'cat', 4),
(9, 'Spirou', 'cat', 4),
(10, 'Harry', 'hare', 5),
(11, 'Franklin', 'turtule', 5),
(12, 'Foxy', 'fox', 6),
(13, 'Jason', 'dog', 6),
(14, 'Flocon', 'dog', 6),
(15, 'Ursulle', 'tarantula', 7),
(16, 'Medusa', 'snake', 7),
(17, 'Jafaar', 'snake', 7),
(18, 'Titi', 'canary', 3),
(19, 'Kiwi', 'marmoset', 3),
(20, 'Marco', 'snail', 6);

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(1, 'Monkey D', 'Luffy', 'm@m.m', '$2y$10$AVMk1JI5aoK4Hk6k5.ufeO7ITPG2Br1ewpdPep8k0mG4.cJ1lCoza', 1);
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(2, 'John', 'Doe', 'jd@jd.jd', '$2y$10$A2YAw2BwF8icFdJOJ5s0ruIyi5d7t8kCE1OX7kxUo/EjSs.1D6FYO', 0);
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(3, 'Jean', 'Titouplin', 'j@j.j', '$2y$10$U/DS/T9h0Trie7.FnM.rjuwsfSSf17IbBVFpn734SA0N3Zoi1SgCi', 0);
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(4, 'Mika', 'Akim', 'ma@ma.ma', '$2y$10$5GISqAI7HRCA5jejHdVRsOVC9O4BuVxmTHkFVP7aQbEFnKR2Abvpm', 0),
(5, 'Estelle', 'Man Important', 'es@es.es', '$2y$10$eIl2BO0bEMCkv2rZPOfq6e.7Fs/p67CEHglbh1ZJECT85/tDXEDOO', 0),
(6, 'Guy', 'Tar', 'gt@gt.gt', '$2y$10$xfQp.coO7OgmffJmEFnYeexv8Zv064Zx3uZ7Bvr7vnD2IiMVZqIqu', 0),
(7, 'Terry', 'Kikki', 'tk@tk.tk', '$2y$10$6QSYj5Ivvv62v3OqZXzp3.Ld/dmqIZ4H8VWJMLqctkG3lQcnFf4yu', 0);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;