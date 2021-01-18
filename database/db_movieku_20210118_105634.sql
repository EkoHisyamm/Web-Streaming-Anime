-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- DROP TABLE "episode" ----------------------------------------
DROP TABLE IF EXISTS `episode` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "episode" --------------------------------------
CREATE TABLE `episode`( 
	`judul` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`episode` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`link` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- DROP TABLE "genre" ------------------------------------------
DROP TABLE IF EXISTS `genre` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "genre" ----------------------------------------
CREATE TABLE `genre`( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nama` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`info` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- DROP TABLE "movies" -----------------------------------------
DROP TABLE IF EXISTS `movies` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "movies" ---------------------------------------
CREATE TABLE `movies`( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`judul` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`gambar` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`sinopsis` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`status` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`studio` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`rilis` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`rate` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`genre` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`durasi` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`type` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`episode` Int( 11 ) NOT NULL DEFAULT 0,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 37;
-- -------------------------------------------------------------


-- DROP TABLE "users" ------------------------------------------
DROP TABLE IF EXISTS `users` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users`( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------


-- Dump data of "episode" ----------------------------------
BEGIN;

INSERT INTO `episode`(`judul`,`episode`,`link`,`id`) VALUES 
( 'Kimetsu no yaiba', 'Kimetsu-no-yaiba-1', 'https://uservideo.xyz/file/nanime.in.kimetsu.no.yaiba.e01.sub.indo.480p.mp4?embed=true&autoplay=true', '1' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "genre" ------------------------------------
BEGIN;

INSERT INTO `genre`(`id`,`nama`,`info`) VALUES 
( '1', 'action', '' ),
( '2', 'comedy', '' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "movies" -----------------------------------
BEGIN;

INSERT INTO `movies`(`id`,`judul`,`gambar`,`sinopsis`,`status`,`studio`,`rilis`,`rate`,`genre`,`durasi`,`type`,`episode`) VALUES 
( '20', 'hunter x hunter', '36634.jpeg', 'seorang anak yang ingin menjadi seperti ayahnya yaitu seorang hunter', 'Ongoing', 'Bones', '12 april 2020', '8', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '23 min. per ep', 'Movie', '124' ),
( '22', 'shuumatsu no valkyre', 'index.jpeg', 'perang antara dewa melawan umat manusia untuk menentukan nasib bumi', 'Complated', 'deen', '12 april 2021', '8.0', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '23 min. per ep', 'Movie', '24' ),
( '30', 'shuumatsu no valkyre', '36634.jpeg', 'ini sinopsis', 'Ongoing', 'MAPPA', '12 april 2020', '9.21', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '24 min. per ep.', 'TV', '24' ),
( '31', 'Shingeki no Kyojin: The Final Season', '36634.jpeg', 'test', 'Ongoing', 'MAPPA', '12 april 2020', '9.08', 'Action, Military, Mystery, Super Power, Drama, Fantasy, Shounen', '24 min. per ep', 'TV', '16' ),
( '36', 'Kimetsu no yaiba', 'index.jpeg', '<p>seorang anak yang ingin mengembalikan adiknya yang telah menjadi oni<br></p>', 'Complated', 'MAPPA', '12 april 2020', '9', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '24 min. per eps', 'BD', '26' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
BEGIN;

INSERT INTO `users`(`id`,`name`,`password`) VALUES 
( '1', 'admin', 'admin' );
COMMIT;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


