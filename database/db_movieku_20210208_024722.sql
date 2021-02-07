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
	`link` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'link video stream',
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 129;
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
AUTO_INCREMENT = 37;
-- -------------------------------------------------------------


-- DROP TABLE "movies" -----------------------------------------
DROP TABLE IF EXISTS `movies` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "movies" ---------------------------------------
CREATE TABLE `movies`( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`judul` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-',
	`gambar` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'gambar cover',
	`sinopsis` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`status` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-',
	`studio` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-',
	`rilis` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-' COMMENT 'musim rilis',
	`rate` VarChar( 11 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-' COMMENT 'rateing anime',
	`genre` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`durasi` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-',
	`type` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '-',
	`episode` VarChar( 11 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'jumlah episode',
	`views` Int( 20 ) NULL DEFAULT 0,
	`time` DateTime NOT NULL COMMENT 'update time',
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT 'Berisi info tentang anime
'
ENGINE = InnoDB
AUTO_INCREMENT = 105;
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
( 'Log Horizon: Entaku Houkai', '03', 'https://www.yourupload.com/embed/fLo5PP2414yW', '111' ),
( 'Kono Subarashii Sekai ni Shukufuku wo! 2', '01', 'https://www.mp4upload.com/embed-vgv5sc8mhhmm.html', '113' ),
( 'Kono Subarashii Sekai ni Shukufuku wo! 2', '02', 'https://www.mp4upload.com/embed-2yjyg490gpqh.html', '116' ),
( 'One Punch Man 2nd Season', '02', 'https://www.yourupload.com/embed/2B15ECqqG7t3', '117' ),
( 'One Punch Man 2nd Season', '03', 'https://www.mp4upload.com/embed-ufxetkdopmsi.html', '118' ),
( 'One Punch Man 2nd Season', '00', 'https://www.yourupload.com/embed/2t46XP23b25k', '119' ),
( 'Kono Subarashii Sekai ni Shukufuku wo! 2', '03', 'https://www.mp4upload.com/embed-9i6n93n3h80z.html', '120' ),
( 'Re:Zero kara Hajimeru Isekai Seikatsu 2nd Season Part 2', '01', 'https://www.yourupload.com/embed/OK1q7vapWwSu', '121' ),
( 'Re:Zero kara Hajimeru Isekai Seikatsu 2nd Season Part 2', '02', 'https://www.yourupload.com/embed/FiFo86HQ2u87', '122' ),
( 'Black Clover (TV)', '01', 'https://www.yourupload.com/embed/8g5T3y4kFw1M', '126' ),
( 'One Punch Man 2nd Season', '05', 'https://www.yourupload.com/embed/T8BK21KE1J6E', '127' ),
( 'Shingeki no Kyojin: The Final Season', '09', 'https://www.yourupload.com/embed/syQTfW8D1657', '128' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "genre" ------------------------------------
BEGIN;

INSERT INTO `genre`(`id`,`nama`,`info`) VALUES 
( '2', 'Romance', '' ),
( '8', 'Comedy', '' ),
( '9', 'Drama', '' ),
( '10', 'Adventure', '' ),
( '11', 'Supernatural', '' ),
( '15', 'Psychological', '' ),
( '16', 'Ecchi', '' ),
( '30', 'Isekai', '' ),
( '31', 'School', '' ),
( '32', 'Fantasy', '' ),
( '33', 'Harem', '' ),
( '34', 'Action', '' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "movies" -----------------------------------
BEGIN;

INSERT INTO `movies`(`id`,`judul`,`gambar`,`sinopsis`,`status`,`studio`,`rilis`,`rate`,`genre`,`durasi`,`type`,`episode`,`views`,`time`) VALUES 
( '76', 'Seishun Buta Yarou wa Yumemiru Shoujo no Yume wo Minai', 'https://cdn.myanimelist.net/images/anime/1613/102179.jpg', 'Six months ago, Sakuta Azusagawa had a chance encounter with a bunny girl in a library. Ever since then, he&rsquo;s been blissfully happy with his girlfriend: Mai Sakurajima, that same bunny girl. However, the reappearance of his mysterious first crush, the now-adult Shouko Makinohara, adds a new complication to his relationship with Mai. To make matters worse, he then encounters a middle school Shouko in the hospital, suffering from a grave illness. Mysteriously, his old scars begin throbbing whenever he&rsquo;s near her.<br />
<br />
With Shouko&rsquo;s bizarre situation somehow revolving around him, Sakuta will need to come to terms with his own conflicting feelings, for better or worse. With a girl&#039;s life in his hands, just what can he do?<br />
<br />
[Written by MAL Rewrite]', 'Finished Airing', 'CloverWorks', 'Jun 15, 2019', '8.69', 'Supernatural,Drama,Romance,School', '1 hr. 30 min.', 'Movie', '1', '101', '2021-02-04 12:17:58' ),
( '80', 'Death Note', 'https://cdn.myanimelist.net/images/anime/9/9453.jpg', 'A shinigami, as a god of death, can kill any person&mdash;provided they see their victim&#039;s face and write their victim&#039;s name in a notebook called a Death Note. One day, Ryuk, bored by the shinigami lifestyle and interested in seeing how a human would use a Death Note, drops one into the human realm.<br />
<br />
High school student and prodigy Light Yagami stumbles upon the Death Note and&mdash;since he deplores the state of the world&mdash;tests the deadly notebook by writing a criminal&#039;s name in it. When the criminal dies immediately following his experiment with the Death Note, Light is greatly surprised and quickly recognizes how devastating the power that has fallen into his hands could be.            <br />
<br />
With this divine capability, Light decides to extinguish all criminals in order to build a new world where crime does not exist and people worship him as a god. Police, however, quickly discover that a serial killer is targeting criminals and, consequently, try to apprehend the culprit. To do this, the Japanese investigators count on the assistance of the best detective in the world: a young and eccentric man known only by the name of L.<br />
<br />', 'Finished Airing', 'Madhouse', 'Oct 4, 2006 to Jun 27, 2007', '8.63', 'Mystery,Drama,Shounen,Supernatural,Psychological,Mystery,Police,Psychological,Supernatural,Thriller,Shounen', '23 min. per ep.', 'TV', '37', '101', '2021-02-04 12:17:58' ),
( '83', 'Non Non Biyori Nonstop', 'https://cdn.myanimelist.net/images/anime/1159/107670.jpg', 'Third season of <i>Non Non Biyori</i>.', 'Currently Airing', 'SILVER LINK', 'Jan 11, 2021 to ?', '8.35', 'Slice of Life,Comedy,Seinen', '24 min. per ep.', 'TV', '12', '101', '2021-02-04 12:17:58' ),
( '84', 'Log Horizon: Entaku Houkai', 'https://cdn.myanimelist.net/images/anime/1510/108026.jpg', 'Third season of <i>Log Horizon</i>.', 'Currently Airing', 'Studio Deen', 'Jan 13, 2021 to ?', '7.39', 'Action,Game,Adventure,Magic,Fantasy', '24 min. per ep.', 'TV', '12', '108', '2021-02-04 13:27:01' ),
( '86', 'One Punch Man 2nd Season', 'https://cdn.myanimelist.net/images/anime/1805/99571.jpg', 'In the wake of defeating Boros and his mighty army, Saitama has returned to his unremarkable everyday life in Z-City. However, unbeknownst to him, the number of monsters appearing is still continuously on the rise, putting a strain on the Hero Association&rsquo;s resources. Their top executives decide on the bold move of recruiting hoodlums in order to help in their battle. But during the first meeting with these potential newcomers, a mysterious man calling himself Garou makes his appearance. Claiming to be a monster, he starts mercilessly attacking the crowd. <br />
<br />
The mysterious Garou continues his rampage against the Hero Association, crushing every hero he encounters. He turns out to be the legendary martial artist Silverfang&rsquo;s best former disciple and seems driven by unknown motives. Regardless, this beast of a man seems unstoppable. Intrigued by this puzzling new foe and with an insatiable thirst for money, Saitama decides to seize the opportunity and joins the interesting martial arts competition. <br />
<br />
As the tournament commences and Garou continues his rampage, a new great menace reveals itself, threatening the entire human world. Could this finally be the earth-shattering catastrophe predicted by the great seer Madame Shibabawa? <br />
<br />
[Written by MAL Rewrite]<br />', 'Finished Airing', 'J.C.Staff', 'Apr 10, 2019 to Jul 3, 2019', '7.41', 'Action,Sci-Fi,Comedy,Parody,Super Power,Supernatural', '23 min. per ep.', 'TV', '12', '107', '2021-02-08 01:01:23' ),
( '87', 'Koe no Katachi', 'https://cdn.myanimelist.net/images/anime/1122/96435.jpg', 'As a wild youth, elementary school student Shouya Ishida sought to beat boredom in the cruelest ways. When the deaf Shouko Nishimiya transfers into his class, Shouya and the rest of his class thoughtlessly bully her for fun. However, when her mother notifies the school, he is singled out and blamed for everything done to her. With Shouko transferring out of the school, Shouya is left at the mercy of his classmates. He is heartlessly ostracized all throughout elementary and middle school, while teachers turn a blind eye.<br />
<br />
Now in his third year of high school, Shouya is still plagued by his wrongdoings as a young boy. Sincerely regretting his past actions, he sets out on a journey of redemption: to meet Shouko once more and make amends.<br />
<br />
<i>Koe no Katachi</i> tells the heartwarming tale of Shouya&#039;s reunion with Shouko and his honest attempts to redeem himself, all while being continually haunted by the shadows of his past.<br />
 <br />
[Written by MAL Rewrite]', 'Finished Airing', 'Kyoto Animation', 'Sep 17, 2016', '9.00', 'Drama,School,Shounen', '2 hr. 10 min.', 'Movie', '1', '101', '2021-02-04 12:17:58' ),
( '88', 'Kono Subarashii Sekai ni Shukufuku wo! 2', 'https://cdn.myanimelist.net/images/anime/2/83188.jpg', 'When Kazuma Satou died, he was given two choices: pass on to heaven or be revived in a fantasy world. After choosing the new world, the goddess Aqua tasked him with defeating the Demon King, and let him choose any weapon to aid him. Unfortunately, Kazuma chose to bring Aqua herself and has regretted the decision ever since then.<br />
<br />
Not only is he stuck with a useless deity turned party archpriest, the pair also has to make enough money for living expenses. To add to their problems, their group continued to grow as more problematic adventurers joined their ranks. Their token spellcaster, Megumin, is an explosion magic specialist who can only cast one spell once per day and refuses to learn anything else. There is also their stalwart crusader, Lalatina &quot;Darkness&quot; Dustiness Ford, a helpless masochist who makes Kazuma look pure in comparison.<br />
<br />
<i>Kono Subarashii Sekai ni Shukufuku wo! 2</i> continues to follow Kazuma and the rest of his party through countless more adventures as they struggle to earn money and have to deal with one another&#039;s problematic personalities. However, things rarely go as planned, and they are often sidetracked by their own idiotic tendencies.<br />
<br />
[Written by MAL Rewrite]', 'Finished Airing', 'Studio Deen', 'Jan 12, 2017 to Mar 16, 2017', '8.32', 'Adventure,Comedy,Parody,Supernatural,Magic,Fantasy', '23 min. per ep.', 'TV', '10', '214', '2021-02-04 12:17:58' ),
( '89', 'Shingeki no Kyojin', 'https://cdn.myanimelist.net/images/anime/10/47347.jpg', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.<br />
<br />
After witnessing a horrific personal loss at the hands of the invading creatures, Eren Yeager dedicates his life to their eradication by enlisting into the Survey Corps, an elite military unit that combats the merciless humanoids outside the protection of the walls. Based on Hajime Isayama&#039;s award-winning manga, <i>Shingeki no Kyojin</i> follows Eren, along with his adopted sister Mikasa Ackerman and his childhood friend Armin Arlert, as they join the brutal war against the titans and race to discover a way of defeating them before the last walls are breached.<br />
<br />
[Written by MAL Rewrite]', 'Finished Airing', 'Wit Studio', 'Apr 7, 2013 to Sep 29, 2013', '8.48', 'Action,Military,Mystery,Super Power,Drama,Fantasy,Shounen', '24 min. per ep.', 'TV', '25', '101', '2021-02-04 12:17:58' ),
( '90', 'Shingeki no Kyojin: The Final Season', 'https://cdn.myanimelist.net/images/anime/1000/110531.jpg', 'Gabi Braun and Falco Grice have been training their entire lives to inherit one of the seven titans under Marley&#039;s control and aid their nation in eradicating the Eldians on Paradis. However, just as all seems well for the two cadets, their peace is suddenly shaken by the arrival of Eren Yeager and the remaining members of the Survey Corps. <br />
<br />
Having finally reached the Yeager family basement and learned about the dark history surrounding the titans, the Survey Corps has at long last found the answer they so desperately fought to uncover. With the truth now in their hands, the group set out for the world beyond the walls.<br />
<br />
In <i>Shingeki no Kyojin: The Final Season</i>, two utterly different worlds collide as each party pursues its own agenda in the long-awaited conclusion to Paradis&#039; fight for freedom.<br />
<br />
[Written by MAL Rewrite]', 'Currently Airing', 'MAPPA', 'Dec 7, 2020 to ?', '9.21', 'Action,Military,Mystery,Super Power,Drama,Fantasy,Shounen', '23 min. per ep.', 'TV', '16', '101', '2021-02-08 01:59:23' ),
( '94', 'Re:Zero kara Hajimeru Isekai Seikatsu 2nd Season Part 2', 'https://cdn.myanimelist.net/images/anime/1132/110666.jpg', 'Second half of <i>Re:Zero kara Hajimeru Isekai Seikatsu 2nd Season</i>.', 'Currently Airing', 'White Fox', 'Jan 6, 2021 to ?', '8.70', 'Psychological,Drama,Thriller,Fantasy', '28 min. per ep.', 'TV', '12', '5', '2021-02-04 13:12:17' ),
( '95', 'Tate no Yuusha no Nariagari', 'https://cdn.myanimelist.net/images/anime/1490/101365.jpg', 'The Four Cardinal Heroes are a group of ordinary men from modern-day Japan summoned to the kingdom of Melromarc to become its saviors. Melromarc is a country plagued by the Waves of Catastrophe that have repeatedly ravaged the land and brought disaster to its citizens for centuries. The four heroes are respectively bestowed a sword, spear, bow, and shield to vanquish these Waves. Naofumi Iwatani, an otaku, becomes cursed with the fate of being the &quot;Shield Hero.&quot; Armed with only a measly shield, Naofumi is belittled and ridiculed by his fellow heroes and the kingdom&#039;s people due to his weak offensive capabilities and lackluster personality.<br />
<br />
When the heroes are provided with resources and comrades to train with, Naofumi sets out with the only person willing to train alongside him, Malty Melromarc. He is soon betrayed by her, however, and becomes falsely accused of taking advantage of her. Naofumi then becomes heavily discriminated against and hated by the people of Melromarc for something he didn&#039;t do. With a raging storm of hurt and mistrust in his heart, Naofumi begins his journey of strengthening himself and his reputation. Further along however, the difficulty of being on his own sets in, so Naofumi buys a demi-human slave on the verge of death named Raphtalia to accompany him on his travels.<br />
<br />
As the Waves approach the kingdom, Naofumi and Raphtalia must fight for the survival of the kingdom and protect the people of Melromarc from their ill-fated future.<br />
<br />', 'Finished Airing', 'Kinema Citrus', 'Jan 9, 2019 to Jun 26, 2019', '8.00', 'Action,Adventure,Drama,Fantasy', '24 min. per ep.', 'TV', '25', '1', '2021-02-04 12:17:58' ),
( '96', 'Fate/stay night', 'https://cdn.myanimelist.net/images/anime/4/30327.jpg', 'After a mysterious inferno kills his family, Shirou is saved and adopted by Kiritsugu Emiya, who teaches him the ways of magic and justice.<br />
<br />
One night, years after Kiritsugu&#039;s death, Shirou is cleaning at school, when he finds himself caught in the middle of a deadly encounter between two superhumans known as Servants. During his attempt to escape, the boy is caught by one of the Servants and receives a life-threatening injury. Miraculously, he survives, but the same Servant returns to finish what he started. In desperation, Shirou summons a Servant of his own, a knight named Saber. The two must now participate in the Fifth Holy Grail War, a battle royale of seven Servants and the mages who summoned them, with the grand prize being none other than the omnipotent Holy Grail itself.<br />
<br />
<i>Fate/stay night</i> follows Shirou as he struggles to find the fine line between a hero and a killer, his ideals clashing with the harsh reality around him. Will the boy become a hero like his foster father, or die trying?<br />
<br />', 'Finished Airing', 'Studio Deen', 'Jan 7, 2006 to Jun 17, 2006', '7.34', 'Action,Supernatural,Magic,Romance,Fantasy', '24 min. per ep.', 'TV', '24', '1', '2021-02-04 12:17:58' ),
( '97', '5-toubun no Hanayome âˆ¬', 'https://cdn.myanimelist.net/images/anime/1775/109514.jpg', 'Through their tutor Fuutarou Uesugi\'s diligent guidance, the Nakano quintuplets\' academic performance shows signs of improvement, even if their path to graduation is still rocky. However, as they continue to cause various situations that delay any actual tutoring, Fuutarou becomes increasingly involved with their personal lives, further complicating their relationship with each other.<br />
<br />
On another note, Fuutarou slowly begins to realize the existence of a possible connection between him and the past he believes to have shared with one of the five girls. With everyone\'s feelings beginning to develop and overlap, will they be able to keep their bond strictly to that of a teacher and his studentsâ€”or will it mature into something else entirely?<br />
<br />', 'Currently Airing', 'Bibury Animation Studios', 'Jan 8, 2021 to ?', '8.01', 'Harem,Comedy,Romance,School,Shounen', '24 min. per ep.', 'TV', '12', '4', '2021-02-05 13:14:07' ),
( '98', 'Tensei shitara Slime Datta Ken 2nd Season', 'https://cdn.myanimelist.net/images/anime/1271/109841.jpg', 'Second season of <i>Tensei shitara Slime Datta Ken</i>.', 'Currently Airing', '8bit', 'Jan 12, 2021 to 2021', '8.04', 'Comedy,Fantasy', '23 min.', 'TV', 'Unknown', '1', '2021-02-05 13:12:34' ),
( '101', 'Black Clover (TV)', 'https://cdn.myanimelist.net/images/anime/2/88336.jpg', 'Asta and Yuno were abandoned at the same church on the same day. Raised together as children, they came to know of the  Wizard King â€”a title given to the strongest mage in the kingdomâ€”and promised that they would compete against each other for the position of the next Wizard King. However, as they grew up, the stark difference between them became evident. While Yuno is able to wield magic with amazing power and control, Asta cannot use magic at all and desperately tries to awaken his powers by training physically.<br />
<br />
When they reach the age of 15, Yuno is bestowed a spectacular Grimoire with a four-leaf clover, while Asta receives nothing. However, soon after, Yuno is attacked by a person named Lebuty, whose main purpose is to obtain Yuno\'s Grimoire. Asta tries to fight Lebuty, but he is outmatched. Though without hope and on the brink of defeat, he finds the strength to continue when he hears Yuno\'s voice. Unleashing his inner emotions in a rage, Asta receives a five-leaf clover Grimoire, a  Black Clover  giving him enough power to defeat Lebuty. A few days later, the two friends head out into the world, both seeking the same goalâ€”to become the Wizard King!<br />
<br />', 'Currently Airing', 'Studio Pierrot', 'Oct 3, 2017 to Mar 30, 2021', '7.36', 'Action,Comedy,Magic,Fantasy,Shounen', '23 min. per ep.', 'TV', '170', '3', '2021-02-05 15:06:11' ),
( '102', 'Nanatsu no Taizai', 'https://cdn.myanimelist.net/images/anime/8/65409.jpg', 'In a world similar to the European Middle Ages, the feared yet revered Holy Knights of Britannia use immensely powerful magic to protect the region of Britannia and its kingdoms. However, a small subset of the Knights supposedly betrayed their homeland and turned their blades against their comrades in an attempt to overthrow the ruler of Liones. They were defeated by the Holy Knights, but rumors continued to persist that these legendary knights, called the &quot;Seven Deadly Sins,&quot; were still alive. Ten years later, the Holy Knights themselves staged a coup d&rsquo;&eacute;tat, and thus became the new, tyrannical rulers of the Kingdom of Liones.<br />
<br />
Based on the best-selling manga series of the same name, <i>Nanatsu no Taizai</i> follows the adventures of Elizabeth, the third princess of the Kingdom of Liones, and her search for the Seven Deadly Sins. With their help, she endeavors to not only take back her kingdom from the Holy Knights, but to also seek justice in an unjust world.<br />
 <br />', 'Finished Airing', 'A-1 Pictures', 'Oct 5, 2014 to Mar 29, 2015', '7.90', 'Action,Adventure,Ecchi,Fantasy,Magic,Shounen,Supernatural,Action,Adventure,Ecchi,Fantasy,Magic,Shounen,Supernatural', '24 min. per ep.', 'TV', '24', '1', '2021-02-05 15:38:15' ),
( '103', 'Tonikaku Kawaii', 'https://cdn.myanimelist.net/images/anime/1613/108722.jpg', 'Nasa Yuzaki is determined to leave his name in the history books. Ranking first in the national mock exam and aiming for a distinguished high school, he is certain that he has his whole life mapped out. However, fate is a fickle mistress. On his way home one snowy evening, Nasa&#039;s eyes fall upon a peerless beauty across the street. Bewitched, Nasa tries to approach her&mdash;only to get blindsided by an oncoming truck. <br />
<br />
Thankfully, his life is spared due to the girl&#039;s swift action. Bleeding by the side of an ambulance, he watches as the girl walks away under the moonlight&mdash;reminiscent of Princess Kaguya leaving for the moon. Refusing to let this chance meeting end, he forces his crippled body to chase after her and asks her out. Surprised by his foolhardiness and pure resolve, the girl accepts his confession under a single condition: they can only be together if he marries her!<br />
<br />', 'Finished Airing', 'Seven Arcs', 'Oct 3, 2020 to Dec 19, 2020', '7.97', 'Comedy,Romance,Shounen', '23 min. per ep.', 'TV', '12', '1', '2021-02-08 01:03:57' );
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


