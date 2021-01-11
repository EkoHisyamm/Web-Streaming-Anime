-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "genre" ----------------------------------------
CREATE TABLE `genre`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nama` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`info` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "movies" ---------------------------------------
CREATE TABLE `movies`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`judul` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`gambar` LongText CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`sinopsis` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`status` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`studio` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`rilis` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`rate` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`genre` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`durasi` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`type` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`episode` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 23;
-- -------------------------------------------------------------


-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------


-- Dump data of "genre" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "movies" -----------------------------------
BEGIN;

INSERT INTO `movies`(`id`,`judul`,`gambar`,`sinopsis`,`status`,`studio`,`rilis`,`rate`,`genre`,`durasi`,`type`,`episode`) VALUES 
( '10', 'Shingeki no Kyojin: The Final Season', '36634.jpeg', 'With Eren and company now at the shoreline and the threat of Marley looming, whatâ€™s next for the Scouts and their quest to unravel the mysteries of the Titans, humanity, and more? ', 'Ongoing', 'MAPPA', 'WInter 2020', '9.08', 'Action, Military, Mystery, Super Power, Drama, Fantasy, Shounen', '23 min. per ep', 'BD', '16' ),
( '15', 'Fullmetal Alchemist: Brotherhood', 'index.jpeg', '"In order for something to be obtained, something of equal value must be lost."  Alchemy is bound by this Law of Equivalent Exchangeâ€”something the young brothers Edward and Alphonse Elric only realize after attempting human transmutation: the one forbidden act of alchemy. They pay a terrible price for their transgressionâ€”Edward loses his left leg, Alphonse his physical body. It is only by the desperate sacrifice of Edward\'s right arm that he is able to affix Alphonse\'s soul to a suit of armor. Devastated and alone, it is the hope that they would both eventually return to their original bodies that gives Edward the inspiration to obtain metal limbs called "automail" and become a state alchemist, the Fullmetal Alchemist.  Three years of searching later, the brothers seek the Philosopher\'s Stone, a mythical relic that allows an alchemist to overcome the Law of Equivalent Exchange. Even with military allies Colonel Roy Mustang, Lieutenant Riza Hawkeye, and Lieutenant Colonel Maes Hughes on their side, the brothers find themselves caught up in a nationwide conspiracy that leads them not only to the true nature of the elusive Philosopher\'s Stone, but their country\'s murky history as well. In between finding a serial killer and racing against time, Edward and Alphonse must ask themselves if what they are doing will make them human again... or take away their humanity.
""', 'Complated', 'Bones', 'Spring 2009', '9.21', 'Action, Military, Adventure', '24 min. per ep.', 'TV', '64' ),
( '20', 'hunter x hunter', '36634.jpeg', 'seorang anak yang ingin menjadi seperti ayahnya yaitu seorang hunter', 'Ongoing', 'Bones', '12 april 2020', '8', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '23 min. per ep', 'Movie', '124' ),
( '22', 'shuumatsu no valkyre', 'index.jpeg', 'perang antara dewa melawan umat manusia untuk menentukan nasib bumi', 'Complated', 'deen', '12 april 2021', '8.0', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen', '23 min. per ep', 'Movie', '24' );
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


