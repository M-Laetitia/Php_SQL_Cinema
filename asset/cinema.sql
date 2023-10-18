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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.actor : ~10 rows (environ)
REPLACE INTO `actor` (`id_actor`, `id_person`) VALUES
	(33, 57),
	(34, 58),
	(35, 59),
	(36, 60),
	(37, 61),
	(38, 62),
	(39, 63),
	(40, 64),
	(41, 65),
	(55, 83);

-- Listage de la structure de table cinema_2. categorise
CREATE TABLE IF NOT EXISTS `categorise` (
  `id_genre` int NOT NULL,
  `id_movie` int NOT NULL,
  KEY `id_genre` (`id_genre`),
  KEY `FK_categorise_movie` (`id_movie`),
  CONSTRAINT `FK_categorise_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  CONSTRAINT `FK_categorise_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.categorise : ~28 rows (environ)
REPLACE INTO `categorise` (`id_genre`, `id_movie`) VALUES
	(6, 53),
	(9, 53),
	(15, 53),
	(6, 55),
	(12, 55),
	(20, 55),
	(6, 54),
	(12, 54),
	(19, 54),
	(10, 57),
	(13, 57),
	(6, 58),
	(10, 58),
	(6, 59),
	(17, 59),
	(18, 59),
	(6, 52),
	(45, 52),
	(6, 56),
	(15, 56),
	(19, 56),
	(6, 60),
	(9, 60),
	(11, 60),
	(9, 83),
	(15, 83),
	(6, 51),
	(10, 51);

-- Listage de la structure de table cinema_2. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_director`),
  KEY `id_person` (`id_person`),
  CONSTRAINT `FK_director_person` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.director : ~10 rows (environ)
REPLACE INTO `director` (`id_director`, `id_person`) VALUES
	(21, 50),
	(22, 51),
	(23, 52),
	(24, 53),
	(25, 54),
	(26, 55),
	(27, 56),
	(28, 66),
	(29, 68),
	(30, 69);

-- Listage de la structure de table cinema_2. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `label_genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.genre : ~16 rows (environ)
REPLACE INTO `genre` (`id_genre`, `label_genre`) VALUES
	(6, 'Drama'),
	(7, 'Fantasy'),
	(9, 'Adventure'),
	(10, 'Thriller'),
	(11, 'Action'),
	(12, 'Crime'),
	(13, 'Mystery'),
	(15, 'Sci-fi'),
	(16, 'Black comedy'),
	(17, 'History'),
	(18, 'Biography'),
	(19, 'Horror'),
	(20, 'Superhero'),
	(21, 'War'),
	(42, 'Animation'),
	(45, 'Romance');

-- Listage de la structure de table cinema_2. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(50) NOT NULL DEFAULT '',
  `movie_duration` time NOT NULL DEFAULT '00:00:00',
  `movie_release_date` year NOT NULL,
  `movie_rating` int DEFAULT NULL,
  `movie_country` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `movie_synopsys` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `movie_image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_director` int NOT NULL,
  `movie_alt_desc` varchar(255) DEFAULT 'null',
  `movie_background` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `id_director` (`id_director`),
  CONSTRAINT `FK_movie_director` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.movie : ~12 rows (environ)
REPLACE INTO `movie` (`id_movie`, `movie_title`, `movie_duration`, `movie_release_date`, `movie_rating`, `movie_country`, `movie_synopsys`, `movie_image`, `id_director`, `movie_alt_desc`, `movie_background`) VALUES
	(51, 'Parasite', '02:12:00', '2019', 4, 'South Korean', 'Parasite&#34; is a South Korean black comedy thriller film directed by Bong Joon-ho. It follows the story of the impoverished Kim family as they gradually infiltrate the wealthy Park family&#39;s lives, leading to unexpected and darkly comedic consequences', './public/Images/upload/651ebfdbc60809.65524474.jpg', 21, 'null', './public/Images/upload/651ebfdbc66572.28555443.png'),
	(52, 'Lost in Translation', '01:42:00', '2003', 4, 'USA', 'test', './public/Images/upload/651134aea68277.99952935.jpg', 22, 'null', NULL),
	(53, 'Interstellar', '02:49:00', '2014', 4, 'USA', ' Interstellar,&#34; directed by Christopher Nolan, is a science fiction film set in a future where Earth is dying. A group of astronauts embarks on a journey through a wormhole in search of a new habitable planet, exploring themes of love, time, and human survival.', './public/Images/upload/6511329944c962.34665101.jpg', 23, 'null', 'public/Images/bg.jpg'),
	(54, 'American Psycho', '01:41:00', '2000', 4, 'USA', 'American Psycho,&#34; directed by Mary Harron, is a psychological horror film based on Bret Easton Ellis&#39;s novel. It delves into the twisted life of Patrick Bateman, a wealthy New York investment banker who harbors violent and psychopathic tendencies.', './public/Images/upload/6511341d564fa7.28360448.jpg', 24, 'null', NULL),
	(55, 'Batman: The Dark Knight', '02:32:00', '2008', 4, 'USA', 'The Dark Knight,&#34; directed by Christopher Nolan, is a superhero film that explores the conflict between Batman and the Joker in Gotham City. It delves into themes of morality and chaos as the two iconic characters clash in a battle of ideologies.', './public/Images/upload/651133df7be016.79337010.jpg', 23, 'null', NULL),
	(56, '28 Days Later', '01:53:00', '2002', 4, 'UK', '28 Days Later,&#34; directed by Danny Boyle, is a post-apocalyptic horror film set in a world devastated by a contagious rage virus. It follows a group of survivors as they attempt to navigate a desolate London while facing both infected humans and their own fears.', './public/Images/upload/651134cb6b57d3.74205840.jpg', 25, 'null', NULL),
	(57, 'Memento', '01:53:00', '2001', 4, 'USA', ' Memento,&#34; directed by Christopher Nolan, tells the story of Leonard Shelby, a man with short-term memory loss who is trying to find his wife&#39;s killer. The film is known for its unique narrative structure, with scenes presented in reverse order, putting the audience in Leonard&#39;s shoes.', './public/Images/upload/65113448128701.20919133.jpg', 23, 'null', NULL),
	(58, 'The Machinist', '01:41:00', '2004', 4, 'Spain', 'The Machinist,&#34; directed by Brad Anderson, is a psychological thriller that follows Trevor Reznik, a machinist suffering from severe insomnia. His life takes a dark turn as he becomes increasingly paranoid and is haunted by a mysterious coworker.', './public/Images/upload/65113465aea295.27097600.jpg', 26, 'null', NULL),
	(59, 'Schindler&#39;s List', '03:15:00', '1993', 4, 'USA', 'Schindler&#39;s List,&#34; directed by Steven Spielberg, is a powerful historical drama based on the true story of Oskar Schindler, a German businessman who saved the lives of over a thousand Polish-Jewish refugees during the Holocaust. The film explores themes of heroism, morality, and the horrors of genocide.', './public/Images/upload/6511348ccb0923.43264204.jpg', 27, 'null', NULL),
	(60, 'Mad Max Furry Road', '02:00:00', '2015', 4, 'USA', 'Mad Max: Fury Road&#34; is a post-apocalyptic action film directed by George Miller. The film is set in a dystopian future where social order has collapsed, and resources are scarce. Max Rockatansky, portrayed by Tom Hardy, is a lone wanderer in this devastated world. However, he becomes entangled in a spectacular escape led by Furiosa, played by Charlize Theron, a rebel empress who seeks to liberate a group of enslaved women from the clutches of the tyrannical Immortan Joe. The film is an adrenaline-fueled journey through the desert, filled with action, breathtaking stunts, and a message of resistance and the quest for freedom.', './public/Images/upload/651134eb3d74d4.76763079.jpg', 28, 'null', NULL),
	(83, 'Dune ', '02:35:00', '2021', 4, 'usa', '&#34;Dune&#34; is a science fiction film directed by Denis Villeneuve. The story is set on the desert planet of Arrakis, where rival factions battle for control of the spice, a valuable resource with mystical powers. Paul Atreides, the son of the noble House Atreides, becomes the focal point of political and religious conflicts that shape the destiny of the planet.', './public/Images/upload/651986104397e8.77019604.jpg', 30, 'Poster of Dune ', 'public/Images/upload/6519861043d806.57704237.png'),
	(85, 'test02', '23:02:00', '2014', 3, 'usa', '424242', './public/Images/upload/651d36717405d9.31943873.jpg', 23, 'Poster of test', './public/Images/upload/651d36717441c2.97260827.jpg');

-- Listage de la structure de table cinema_2. person
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `person_first_name` varchar(50) NOT NULL,
  `person_last_name` varchar(50) NOT NULL,
  `person_birthday` date NOT NULL,
  `person_sexe` varchar(10) NOT NULL,
  `person_nationality` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `person_image` varchar(255) DEFAULT NULL,
  `person_alt_desc` varchar(255) DEFAULT 'null',
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.person : ~36 rows (environ)
REPLACE INTO `person` (`id_person`, `person_first_name`, `person_last_name`, `person_birthday`, `person_sexe`, `person_nationality`, `person_image`, `person_alt_desc`) VALUES
	(6, 'Jessica', 'Chastain', '1977-03-14', 'female', 'American', NULL, 'null'),
	(7, 'Peter', 'Jackson', '1961-10-31', 'male', 'American', './public/Images/upload/650f0b09d32cd7.66943172.jpg', 'null'),
	(9, 'Mary', 'Harron', '1953-01-12', 'female', 'American', NULL, 'null'),
	(50, 'Bong', 'Joon-ho', '1969-09-14', 'male', 'South Korean', './public/Images/upload/651096bcdc7344.58104636.jpg', 'null'),
	(51, 'Sofia', 'Coppola', '1971-05-14', 'female', 'American', './public/Images/upload/651097144f9bc8.83006553.jpg', 'null'),
	(52, 'Christopher', 'Nolan', '1970-06-30', 'male', 'British-American', './public/Images/upload/651097a719abf8.61232466.jpg', 'null'),
	(53, 'Marry', 'Harron', '1953-01-12', 'female', 'Canadian', './public/Images/upload/6510978a62c648.24384076.jpg', 'null'),
	(54, 'Danny', 'Boyle', '1956-10-20', 'male', 'British', './public/Images/upload/651097edd8fc46.62139809.jpg', 'null'),
	(55, 'Brad', 'Anderson', '1964-11-17', 'male', 'American', './public/Images/upload/65109823ab8dc8.89941393.jpg', 'null'),
	(56, 'Steven', 'Spielberg', '1946-12-18', 'male', 'American', './public/Images/upload/651098576a8cf6.56108502.jpg', 'null'),
	(57, 'Song', 'South Korean', '1967-01-17', 'male', 'South Korean', './public/Images/upload/65199b375cf311.85310876.jpg', 'null'),
	(58, 'Bill', 'Murray', '1950-09-21', 'male', 'American', './public/Images/upload/65109c32ae8f28.19370302.jpg', 'null'),
	(59, 'Matthew', 'McConaughey', '1969-10-04', 'male', 'American', './public/Images/upload/65109c5835abc7.51135347.jpg', 'null'),
	(60, 'Christian', 'Bale', '1974-01-30', 'male', 'British/American', './public/Images/upload/65109c833fc6b3.57177069.jpg', 'null'),
	(61, 'Cillian', 'Murphy', '1967-05-25', 'male', 'Irelan', './public/Images/upload/65109ca60336b1.56797092.jpg', 'null'),
	(62, 'Liam', 'Neeson', '1952-07-07', 'male', 'Irish', './public/Images/upload/65109ce9854f81.35323040.jpg', 'null'),
	(63, 'Jessica', ' Chastain', '1977-05-24', 'female', 'American', './public/Images/upload/65109d5ae0ee68.43300871.jpg', 'null'),
	(64, 'Charlize', 'Theron', '1975-08-07', 'female', 'American', './public/Images/upload/65109db141d490.11425010.jpg', 'null'),
	(65, 'Tom', 'Hardy', '1977-09-15', 'male', 'British', './public/Images/upload/6510a1dd8b10e2.56873758.jpg', 'null'),
	(66, 'George', 'Miller', '1945-03-03', 'male', 'Australian', './public/Images/upload/6510aaff758bf9.74122501.jpg', 'null'),
	(67, 'test01', 'test01', '2023-09-07', 'male', 'american', './public/Images/upload/65141b74ebd904.25583440.jpg', 'Portrait of test01 test01'),
	(68, 'Bidule', 'Truc', '2023-09-07', 'male', 'american', './public/Images/upload/65141d73874c81.19858356.jpg', 'Portrait of Bidule Truc'),
	(69, 'Denis', 'Villeneuve', '1967-10-03', 'male', 'Canadian', './public/Images/upload/6519849b7e0505.91321225.jpeg', 'Portrait of Denis Villeneuve'),
	(70, 'test', 'test', '1790-02-14', 'male', 'american', NULL, 'Portrait of test test'),
	(71, 'test', 'test', '1990-12-01', 'male', 'american', './public/Images/upload/651d322092da23.45764202.jpg', 'Portrait of test test'),
	(72, 'test04', 'american', '1990-02-01', 'female', 'american', './public/Images/upload/651d33484ec256.70607471.jpg', 'Portrait of test test01'),
	(73, 'Bidule', 'Truc', '1990-12-01', 'male', 'american', './public/Images/upload/651d339c9aa061.81024190.jpg', 'Portrait of Bidule Truc'),
	(75, 'test', 'test', '1965-11-20', 'male', 'American', NULL, 'Portrait of test test'),
	(76, 'ajout', 'test2', '1990-12-12', 'male', 'American', NULL, 'Portrait of ajout test2'),
	(77, 'ajout', 'test2', '1990-12-12', 'male', 'American', NULL, 'Portrait of ajout test2'),
	(78, 'ajout', 'test2', '1990-12-12', 'male', 'American', NULL, 'Portrait of ajout test2'),
	(79, 'fdfdf', 'dfdf', '1890-12-12', 'female', 'usa', NULL, 'Portrait of fdfdf dfdf'),
	(80, 'fdfdf', 'dfdf', '1890-12-12', 'female', 'usa', NULL, 'Portrait of fdfdf dfdf'),
	(81, 'ddd', 'test', '1987-10-01', 'male', 'Irish', NULL, 'Portrait of ddd test'),
	(82, 'ddd', 'test2', '1984-02-21', 'female', 'ddd', NULL, 'Portrait of ddd test2'),
	(83, 'Charlize', 'test2', '1945-05-12', 'female', 'Irish', NULL, 'Portrait of Charlize test2');

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

-- Listage des données de la table cinema_2.play : ~13 rows (environ)
REPLACE INTO `play` (`id_movie`, `id_actor`, `id_role`) VALUES
	(53, 39, 6),
	(54, 36, 19),
	(58, 36, 22),
	(56, 37, 21),
	(59, 38, 26),
	(52, 34, 16),
	(51, 33, 15),
	(60, 41, 24),
	(53, 35, 17),
	(55, 36, 28),
	(60, 40, 27),
	(54, 40, 6),
	(55, 38, 22);

-- Listage de la structure de table cinema_2. rating
CREATE TABLE IF NOT EXISTS `rating` (
  `id_rating` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL DEFAULT '0',
  `id_movie` int NOT NULL,
  `note` int DEFAULT NULL,
  `date_review` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewComplete` json DEFAULT NULL,
  PRIMARY KEY (`id_rating`),
  KEY `id_user` (`id_user`),
  KEY `id_movie` (`id_movie`),
  CONSTRAINT `FK__user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `FK_rating_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.rating : ~15 rows (environ)
REPLACE INTO `rating` (`id_rating`, `id_user`, `id_movie`, `note`, `date_review`, `reviewComplete`) VALUES
	(27, 11, 55, 3, NULL, NULL),
	(28, 11, 54, 5, NULL, NULL),
	(30, 14, 59, 2, '2023-10-05 12:26:57', '{"text": " Schindler&#39;s List,&#34; directed by Steven Spielberg, is a powerful historical drama based on the true story of Oskar Schindler, a German businessman who saved the lives of over a thousand Polish-Jewish refugees during the Holocaust. The film explores themes of heroism, morality, and the horrors of genocide.", "title": "test"}'),
	(31, 14, 52, 3, NULL, NULL),
	(32, 14, 83, 4, '2023-10-05 06:02:56', NULL),
	(42, 5, 53, 5, '2023-10-03 06:30:48', NULL),
	(43, 16, 52, 5, '2023-10-03 07:23:19', NULL),
	(50, 5, 51, NULL, '2023-10-04 08:39:45', NULL),
	(53, 14, 85, 3, '2023-10-04 09:53:32', NULL),
	(64, 16, 58, NULL, '2023-10-05 05:20:15', NULL),
	(65, 14, 60, NULL, '2023-10-05 12:49:57', NULL),
	(66, 14, 58, NULL, '2023-10-05 06:02:18', NULL),
	(67, 14, 54, NULL, '2023-10-05 06:04:08', NULL),
	(68, 14, 51, 2, '2023-10-05 09:44:34', NULL),
	(69, 14, 56, NULL, '2023-10-05 12:27:12', '{"text": "Movie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days LaterMovie : 28 Days Later", "title": "wxqqsqs"}');

-- Listage de la structure de table cinema_2. review_likes
CREATE TABLE IF NOT EXISTS `review_likes` (
  `id_review_likes` int NOT NULL AUTO_INCREMENT,
  `id_rating` int NOT NULL,
  `id_user` int NOT NULL,
  `is_like` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_review_likes`),
  KEY `id_rating` (`id_rating`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_review_likes_rating` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id_rating`),
  CONSTRAINT `FK_review_likes_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.review_likes : ~4 rows (environ)
REPLACE INTO `review_likes` (`id_review_likes`, `id_rating`, `id_user`, `is_like`) VALUES
	(30, 50, 16, 1),
	(32, 50, 16, 0),
	(33, 50, 16, 1),
	(40, 64, 16, 0);

-- Listage de la structure de table cinema_2. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `name_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.role : ~15 rows (environ)
REPLACE INTO `role` (`id_role`, `name_role`) VALUES
	(5, 'Amelia Brand'),
	(6, 'Murph (adult)'),
	(15, 'Kim Ki-taek'),
	(16, 'Bob Harris'),
	(17, 'Joseph Cooper'),
	(19, 'Patrick Bateman'),
	(21, 'Jim'),
	(22, 'Trevor Reznik2'),
	(24, 'Max Rockatansky'),
	(26, 'Oskar Schindler'),
	(27, 'Furiosa'),
	(28, 'Batman'),
	(29, 'test02'),
	(30, 'test02'),
	(31, 'test');

-- Listage de la structure de table cinema_2. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `preference` json DEFAULT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema_2.user : ~10 rows (environ)
REPLACE INTO `user` (`id_user`, `pseudo`, `email`, `password`, `register_date`, `preference`, `role`) VALUES
	(1, 'user01', 'user01@exemple.com', 'test01', '2023-09-25 17:55:25', '{"theme": "light"}', 'user'),
	(2, 'user02', 'user02@exemple.com', 'test02', '2023-09-25 17:55:40', NULL, 'user'),
	(5, 'test01', 'test01@exemple.com', '$2y$10$irHX/XDDewf1nW8i1CMubuDZ8cl/wQm8Yzz5gjSI1Tw.mHvKdpg8.', '2023-09-26 07:21:50', NULL, 'user'),
	(7, 'test03', 'test03@exemple.com', '$2y$10$ASjqINz3Of3x5OJKKyOfd.9khGMV/t9sXeiw3HUijwgWHXbFQoHZa', '2023-09-26 10:34:23', NULL, 'user'),
	(8, 'test04', 'test04@exemple.com', '$2y$10$19HVeq4mSmEx7w4MVR8MLOolSHRu0HnQL0K6wtHfV4YXom41nxxf6', '2023-09-26 10:36:55', NULL, 'user'),
	(9, 'test05', 'test05@exemple.com', '$2y$10$fxetHnYWFJqnDu0b65NOGO/3Dp2SWYj17rtujf4sImGNsI4i87MMK', '2023-09-26 10:37:57', NULL, 'user'),
	(10, 'user', 'user@exemple.fr', '$2y$10$B8AT6aZslBh847PXsu6BruVpUWCTxc62O0RXtvGXeebua3awdwI4a', '2023-09-26 12:55:55', NULL, 'user'),
	(11, 'test06', 'test06@exemple.com', '$2y$10$O2GFnVSThOXzl5Z0NydKv.6dC/ov51qSoY9na4pFpre1F3bFTWviW', '2023-09-28 12:14:16', '{"theme": "dark"}', 'user'),
	(14, 'John', 'john@gmail.com', '$2y$10$3dxNy2fFTnYt6FOSpE1C2ecDDASwIPMpHpzdvTANsQt0Mxlt14wvG', '2023-10-01 11:11:06', '{"theme": "light"}', 'moderateur'),
	(16, 'lisa', 'lisa@exemple.com', '$2y$10$sw7J9ySFaUIHaSbsys8EEe2.Ep7WY1i.CBPKDR56vV.NILjK5lOkm', '2023-10-03 05:20:08', NULL, 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
