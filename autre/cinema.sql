-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.1.0 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_2
CREATE DATABASE IF NOT EXISTS `cinema_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_2`;

-- Listage de la structure de table cinema_2. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_actor`),
  KEY `id_person` (`id_person`),
  CONSTRAINT `FK_actor_person` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.actor : ~6 rows (environ)
REPLACE INTO `actor` (`id_actor`, `id_person`) VALUES
	(2, 1),
	(1, 2),
	(4, 3),
	(6, 5),
	(3, 6),
	(5, 13);

-- Listage de la structure de table cinema_2. categorise
CREATE TABLE IF NOT EXISTS `categorise` (
  `id_genre` int NOT NULL,
  `id_movie` int NOT NULL,
  KEY `id_genre` (`id_genre`),
  KEY `FK_categorise_movie` (`id_movie`),
  CONSTRAINT `FK_categorise_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  CONSTRAINT `FK_categorise_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.categorise : ~19 rows (environ)
REPLACE INTO `categorise` (`id_genre`, `id_movie`) VALUES
	(7, 12),
	(9, 12),
	(11, 12),
	(15, 13),
	(6, 15),
	(14, 15),
	(6, 13),
	(19, 16),
	(6, 16),
	(10, 17),
	(13, 17),
	(19, 18),
	(16, 18),
	(17, 19),
	(6, 19),
	(21, 19),
	(6, 20),
	(21, 20),
	(10, 21);

-- Listage de la structure de table cinema_2. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_director`),
  KEY `id_person` (`id_person`),
  CONSTRAINT `FK_director_person` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.director : ~8 rows (environ)
REPLACE INTO `director` (`id_director`, `id_person`) VALUES
	(1, 3),
	(3, 4),
	(4, 7),
	(5, 8),
	(8, 9),
	(7, 10),
	(6, 11),
	(10, 12);

-- Listage de la structure de table cinema_2. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `label_genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.genre : ~16 rows (environ)
REPLACE INTO `genre` (`id_genre`, `label_genre`) VALUES
	(6, 'Drama'),
	(7, 'Fantasy'),
	(9, 'Adventure'),
	(10, 'Thriller'),
	(11, 'Action'),
	(12, 'Crime'),
	(13, 'Mystery'),
	(14, 'Romance'),
	(15, 'Sci-fi'),
	(16, 'Black comedy'),
	(17, 'History'),
	(18, 'Biography'),
	(19, 'Horror'),
	(20, 'Superhero'),
	(21, 'War'),
	(22, 'Mafia');

-- Listage de la structure de table cinema_2. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(50) NOT NULL DEFAULT '',
  `movie_duration` time NOT NULL DEFAULT '00:00:00',
  `movie_release_date` year NOT NULL,
  `movie_synopsys` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `movie_image` varchar(50) DEFAULT NULL,
  `movie_rating` int DEFAULT NULL,
  `id_director` int NOT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `id_director` (`id_director`),
  CONSTRAINT `FK_movie_director` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.movie : ~11 rows (environ)
REPLACE INTO `movie` (`id_movie`, `movie_title`, `movie_duration`, `movie_release_date`, `movie_synopsys`, `movie_image`, `movie_rating`, `id_director`) VALUES
	(12, 'The lord of the rings : the Return of the King', '02:59:00', '2003', NULL, NULL, 4, 4),
	(13, 'Interstellar', '02:49:00', '2014', NULL, NULL, 4, 3),
	(14, 'The Dark Knight Rises', '02:45:00', '2012', NULL, NULL, 4, 3),
	(15, 'Lost in transition', '01:42:00', '2004', NULL, NULL, 4, 1),
	(16, '28 Days Later', '01:53:00', '2003', NULL, NULL, 4, 5),
	(17, 'Memento', '01:53:00', '2000', NULL, NULL, 4, 3),
	(18, 'American Psycho', '01:41:00', '2000', NULL, NULL, 4, 8),
	(19, 'Schindler\'s List', '03:15:00', '1993', NULL, NULL, 4, 7),
	(20, 'The Godfather Part III', '02:42:00', '1990', NULL, NULL, 4, 6),
	(21, 'The Machinist', '01:42:00', '2004', NULL, NULL, 4, 10),
	(23, 'bla', '00:03:00', '2001', NULL, NULL, 4, 4);

-- Listage de la structure de table cinema_2. person
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `person_first_name` varchar(50) NOT NULL,
  `person_last_name` varchar(50) NOT NULL,
  `person_birthday` date NOT NULL,
  `person_sexe` varchar(10) NOT NULL,
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.person : ~13 rows (environ)
REPLACE INTO `person` (`id_person`, `person_first_name`, `person_last_name`, `person_birthday`, `person_sexe`) VALUES
	(1, 'Cyllian', 'Murphy', '1976-05-25', 'male'),
	(2, 'Christian', 'Bale', '1974-01-30', 'male'),
	(3, 'Sophia', 'Coppola', '1971-05-14', 'female'),
	(4, 'Christopher', 'Nolan', '1970-06-30', 'male'),
	(5, 'Matthew', 'McConaughey', '1969-11-04', 'male'),
	(6, 'Jessica', 'Chastain', '1977-03-14', 'female'),
	(7, 'Peter', 'Jackson', '1961-10-31', 'male'),
	(8, 'Danny', 'Boyle', '1956-10-20', 'male'),
	(9, 'Mary', 'Harron', '1953-01-12', 'female'),
	(10, 'Steven', 'Spielberg', '1946-12-18', 'male'),
	(11, 'Ford', 'Coppola', '1939-04-07', 'male'),
	(12, 'Brad', 'Anderson', '1964-11-26', 'male'),
	(13, 'Anne', 'Hathaway', '1969-11-04', 'female');

-- Listage de la structure de table cinema_2. play
CREATE TABLE IF NOT EXISTS `play` (
  `id_movie` int NOT NULL,
  `id_actor` int NOT NULL,
  `id_role` int NOT NULL,
  KEY `id_movie` (`id_movie`),
  KEY `id_actor` (`id_actor`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `FK__movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`),
  CONSTRAINT `FK__role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  CONSTRAINT `FK_play_actor` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.play : ~6 rows (environ)
REPLACE INTO `play` (`id_movie`, `id_actor`, `id_role`) VALUES
	(18, 1, 2),
	(21, 1, 3),
	(14, 1, 1),
	(13, 5, 5),
	(13, 3, 6),
	(13, 6, 4);

-- Listage de la structure de table cinema_2. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `name_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.role : ~6 rows (environ)
REPLACE INTO `role` (`id_role`, `name_role`) VALUES
	(1, 'Bruce Wayne / Batman'),
	(2, 'Patrick Bateman'),
	(3, 'Trevor Reznik'),
	(4, 'Cooper'),
	(5, 'Amelia Brand'),
	(6, 'Murph (adult)');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
