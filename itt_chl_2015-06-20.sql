# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 192.168.0.2 (MySQL 5.1.73)
# Database: itt_chl
# Generation Time: 2015-06-19 23:42:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table competitors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `competitors`;

CREATE TABLE `competitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `type_of_events` varchar(20) NOT NULL DEFAULT '',
  `gendar` varchar(7) NOT NULL,
  `group` int(11) NOT NULL,
  `joined` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `competitors` WRITE;
/*!40000 ALTER TABLE `competitors` DISABLE KEYS */;

INSERT INTO `competitors` (`id`, `username`, `password`, `salt`, `firstname`, `lastname`, `phone_no`, `type_of_events`, `gendar`, `group`, `joined`)
VALUES
	(1,'Tony','4ce49e8b3e31b6a8aeaf147d92a128ab7764946040a5c818a117c0858c08cb06','ùµA—rÖÎ@õtêm»ã:Á)Mâ:õÊ¨Õ^Œ','Tony','Ampomah','07598 431497','Time Trials','Male',2,'2014-03-29 02:14:53');

/*!40000 ALTER TABLE `competitors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `details` varchar(50) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL,
  `map` varchar(20) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `title`, `event_date`, `type`, `details`, `distance`, `map`, `description`)
VALUES
	(1,'Langthorpe - Beech House League','2014-05-29','timetrial','Langthorpe 2 Laps',16,'1.jpg','Langthorpe, Kirby Hill, Ripon, Skelton, Langthorpe x 2. HQ at Boroughbridge main car park.'),
	(2,'Farnham 9 - Beech House League','2014-05-21','timetrial','Farnham',9,'2.jpg','Farnham Cross Roads, down hill, left,join Boroughbridge road (left) Golf Club Hill, Minskip (left), Stavely to Finish before Farnham Cross Roads. upd'),
	(3,'V212. Arkendale L/E - Walshford. Beech House League.','2014-05-01','races','Arkendale L/E V212',10,'3.jpg','Arkendale Lane End to Walshford and back'),
	(7,'Kirby Hill - Beech House League','2014-04-09','sportive','Kirby Hill - Ripon Racecourse',14,'4.jpg','Kirby Hill to Dishforth to Sharow to Ripon Race course to Kirby Hill'),
	(8,'Penny Pot - Beech House League','2014-05-06','sportive','Pennypot',12,'5.jpg','Pennypot Lane to Norwood to Beckwithshaw to Pennypot Lane');

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_details`;

CREATE TABLE `membership_details` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `forename` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(35) NOT NULL,
  `address` varchar(25) NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `county` varchar(25) NOT NULL,
  `town` varchar(15) NOT NULL,
  `telephone_number` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`forename`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `membership_details` WRITE;
/*!40000 ALTER TABLE `membership_details` DISABLE KEYS */;

INSERT INTO `membership_details` (`id`, `forename`, `surname`, `date_of_birth`, `email`, `address`, `postcode`, `county`, `town`, `telephone_number`, `gender`, `password`)
VALUES
	(11,'Kwame','Ampomah','0000-00-00','antonydat@yahoo.com','Fifth Avenue','YO31 0UW','England','York','441904423359','male','5f4dcc3b5aa765d61d8327deb882cf99'),
	(9,'Tony','Ampomah','0000-00-00','antonydat@live.co.uk','Fifth Avenue, 142','YO31 0UW','North Yorkshire','York','07598 431497','male','5f4dcc3b5aa765d61d8327deb882cf99');

/*!40000 ALTER TABLE `membership_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table merchandise
# ------------------------------------------------------------

DROP TABLE IF EXISTS `merchandise`;

CREATE TABLE `merchandise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `shipping` decimal(4,2) DEFAULT NULL,
  `img` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `merchandise` WRITE;
/*!40000 ALTER TABLE `merchandise` DISABLE KEYS */;

INSERT INTO `merchandise` (`id`, `name`, `price`, `category`, `quantity`, `shipping`, `img`, `description`)
VALUES
	(1,'Shimano R064 SPD SL ',41.99,'shoes',5,2.99,'shoes.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(2,'The Cycling Jersey',40.14,'shirts',7,1.99,'shirt.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(3,'Molteni Wool Cycling',52.99,'shirts',12,4.99,'shirt1.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(4,'R1.0 Road Cycling Sh',39.99,'shoes',43,3.99,'shoes1.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(5,'Various Bicycle Labe',2.99,'badges',6,2.99,'badges.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(6,'Set Of Vintage And M',5.99,'badges',7,3.99,'badges1.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(7,'Endura Retro Cycling',9.99,'hats',8,1.99,'hats.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels'),
	(8,'3-Panel Brooklyn Cyc',12.99,'hats',10,3.99,'hats1.jpg','Shimano R064 SPD-SL Shoes are entry level shoes that deliver high performance for the enthusiast rider. Glass fibre reinforced nylon outer sole gives an excellent combination of stiffness and compliance for club and sport riders. Synthetic leather upper with highly breathable nylon mesh panels');

/*!40000 ALTER TABLE `merchandise` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `news` varchar(2000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `img` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `title`, `news`, `date`, `img`)
VALUES
	(1,'Ketteringham and Worden Top British Finishers in Majorca!','Last week saw Nova sportive riders Greg Ketteringham and Mike Wooden tackle the grueling 200 mile Tour of Majorca. A group of professional rides made an early break away and stayed clear but Ketteringham and Worden stayed in the second group to finish in an astonishing 9 hours 26 minutes in 22nd and 26th place overall, the first British finishers!\n\nEvent 1 of the Beech House Dental Practice TT league was shortened due to roadworks to 8 miles from Farnham to Staveley to Farnham. Nova\'s Duncan Mullier put clear space between himself and the competition with 17:30, 21 seconds clear of PH-MAS\' talented junior Julian Varley, who in turn was 6 seconds ahead of Patron\'s Glen Turnbull. Nova\'s Paul Caswell was a further second back, 3 seconds ahead of teammate Dave Morris. One of the rides of the night was from Boneshakers junior Bobbin Gardner, just 5 seconds off the podium and Tim Jarvis, usually seen on a retro bike, has accepted that carbon fibre is the way forward with a fantastic 10th place in 19:03. Alison Sarmiento won the ladies? event in 20:55, ahead of Fran Varley.\n\nAt the YCF 25 Mullier achieved his second fastest 25 time ever with 52:23, just 12 seconds off his own club record set on a faster course. Enough to earn himself fourth place of 100 riders behind a Team Swift 1,2,3 of Andy Jackson, Nova open winner Joel Wainman and Mark Wolstenholme. Alison Sarimento competed her week with 1st lady veteran at the 15 mile TT round Bassenthwaite Lake in 41:57.','2014-04-30','1.jpg'),
	(2,'Nova Open won by Joel Wainman','At the end of March Harrogate Nova Hosted some of the UK?s Top Time Trialists on a 2 lap/26 mile course from Dishforth-Boroughbridge-Asenby. The event was won by Team Swift?s Joel Wainman in 59:36 ahead of Strategic Lion\'s Nigel Haigh 59:51. Pro and Commonwealth Games hopeful Rob Partridge of Giordana was third with 1:00:05. Top Nova finisher was Simon Cave in 9th in 1:05:12. Alison Sarmiento of Nova won the ladies? event with 1:16:19. Other Nova riders were Mike Worden 01:07:48 in 18th, Rob Senior 1:09:11 in 20th, Roger Bromiley 1:13:08 in 30th and Mike Hutchings in 1:17:36 in 39th. Thanks to all the volunteers for making this a successful event. The following day Nova?s Duncan Mullier came third in the Yorkshire Road Club Hilly 10, reputed to be the hardest 10 mile TT course in the country, at Addingham with 26:28, behind Pro Pete Williams of Haribo-Beacon RT (25:27) and YCF Champion Andy Jackson of Team Swift (25:38). The points in the premier event of the YCF sporting course championship puts Mullier in second place with two events gone behind Jackson. Photo of Joel Wainman by Samantha Dixon.','2014-03-22','2.jpg'),
	(3,'Todmorden','The final round of the 2013 Yorkshire Points Cyclo-cross series took place on the iconic Todmorden course this weekend featuring the infamous cobbled climb. After weeks of rain the grassy sections of the course were extremely soft requiring riders to choose between running and riding with the cobbled climb being one of the few ride-able uphill sections.\n\nHarrogate riders were in action in all 3 main races braving the cold conditions to record some of their best positions of the season , showing they are coming into form for the upcoming National Championship in Derby on the 11th/12th January 2014.\n\nThe first to race was Nova?s Dylan Flesher finishing 6th in the Youth race. With conditions deteriorating with the increase in traffic Nova?s Paul Lehan finished in his first top 10 of the season in 9th followed by Cyclo-cross magazines Ted Sarmiento in 25th place his highest Yorkshire position of the year. In The Vet 50?s both Charles Warren in 4th and Tim Evans in 7th produced season best performances.\n\nIn the final Race won by Hope?s Mike Thompson, Cyclo-cross magazines Edwyn Oliver-Evans came home a seasons best 7th followed by Nova?s Dave Morris who after a slow start climbed back to 13th.\n\nOn Boxing Day Cyclo-Cross magazines Steve Smales travelled to South Shields and after a disastrous start being last after the first corner managed to claw his way back to 9th overall and 7th Vet','2013-12-29','3.jpg'),
	(4,'National Trophy Bradford','Last weekend saw the local edition of the National Trophy Series, held once again at Peel Park Bradford on a similar course to last years national Championship. This is the hardest National Trophy course in the country featuring as it does steep climbs , off camber descents as well as the usual twists turns and hurdles. Whilst some riders have driven to other rounds of the National Trophy series given the proximity more of the local riders decided to pit themselves against the countries finest cycle-cross riders.\n\nThe first race was the Veterans race and having contested previous rounds both Cyclocross magazine?s Steve Smales and Nova?s Paul Lehan had good griding positions and used this to full advantage to get a good start. Steve Smales finished 22nd which was his highest position this year despite overcooking a descent and colliding with a tree which cost him at least 4 places, Paul Lehan finished 30th and Ted Sarmiento finished 48th. In the V50 Charles Warren finished 22nd, Nick Mason 30th and Tim Evans 33rd.\n\nIn the Youth races Nova?s Louis Mason was 24th in the U14 and Nova?s Joe Sarmiento was 20th in the U12.\n\nThe final race saw a race long battle between the National Champion Hargrove?s Ian Field and the National Trophy series leader Hope?s Paul Oldham which Field eventually won also saw Nova?s Dave Morris come home 39th and Cyclocross magazines Edwyn Oliver-Evans finish 46th.','2013-12-13','4.jpg'),
	(5,'Beverley and South Shields','Last Weekend saw Harrogate riders in cyclo-cross action in Beverley and South Shields.This is the halfway point in the cross league and a number of Nova riders are looking to win the Moonglu Cyclo-cross trophy .\nThe Beverley course was on bumpy estate fields with numerous dead turns followed by sharp climbs. There was a race long battle amongst the Nova Veterans who were neck and neck throughout the race. Eventually Nick Mason pulled clear finishing in 12th place followed by Neil Mcloughlin in 16th and Tim Evans in 18th.\nIn the senior race Edwyn Oliver-Evans and Dave Morris were soon at the front of the race battling for podium places,, Dave faded in the last few laps to finish 5th and Edwyn crashed and had to run half a lap to the pits with a broken bike and finished a disappointed 16th. In the Youth race Louis Mason finished 22nd and in the under 12 race Joe Sarmiento finished 9th.\nFurther North in South Shields in the CXNE league four riders rode on a more mixed terrain top rider was Alison Sarmiento who narrowly missed out on a podium position finishing 4th lady after a race long battle the 3rd placed lady. Dylan Flesher fresh from his win last week finished 6th in the Youth race and in the veterans race CX magazines Steve Smales finished 9th despite a puncture and a forced bike change with Ted Sarmiento 36th. Next week see riders in action in the North of England Championship in York','2013-12-01','5.jpg');

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table results
# ------------------------------------------------------------

DROP TABLE IF EXISTS `results`;

CREATE TABLE `results` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(9) DEFAULT NULL,
  `Rider` varchar(30) NOT NULL DEFAULT '',
  `Points` int(11) DEFAULT NULL,
  `1` int(11) DEFAULT NULL,
  `2` int(11) DEFAULT NULL,
  `3` int(11) DEFAULT NULL,
  `4` int(11) DEFAULT NULL,
  `5` int(11) DEFAULT NULL,
  `6` int(11) DEFAULT NULL,
  `7` int(11) DEFAULT NULL,
  `8` int(11) DEFAULT NULL,
  `9` int(11) DEFAULT NULL,
  `10` int(11) DEFAULT NULL,
  `11` int(11) DEFAULT NULL,
  `12` int(11) DEFAULT NULL,
  `13` int(11) DEFAULT NULL,
  `14` int(11) DEFAULT NULL,
  `15` int(11) DEFAULT NULL,
  `16` int(11) DEFAULT NULL,
  `17` int(11) DEFAULT NULL,
  `18` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;

INSERT INTO `results` (`id`, `gender`, `Rider`, `Points`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`)
VALUES
	(1,'female','Jessica Bacon',270,30,30,0,30,0,30,0,0,0,0,0,0,30,30,30,0,30,30),
	(2,'female','Joanne Ketteringham',263,28,28,30,29,30,NULL,NULL,29,30,NULL,NULL,NULL,29,29,29,NULL,0,0),
	(3,'female','Alison Sarmiento',258,NULL,27,28,NULL,NULL,NULL,NULL,27,28,30,NULL,30,NULL,NULL,28,29,29,29),
	(4,'female','Corinne Mitchell',253,26,NULL,29,28,29,NULL,NULL,28,27,NULL,NULL,NULL,28,NULL,NULL,30,28,0),
	(5,'female','Carolyn Nelson',243,NULL,26,NULL,26,NULL,28,NULL,NULL,26,28,29,NULL,27,26,NULL,NULL,0,27),
	(6,'female','Heather Thomson',197,NULL,NULL,NULL,27,28,29,NULL,NULL,NULL,NULL,30,NULL,NULL,28,27,NULL,0,28),
	(7,'female','Eleanor Haresign',144,29,29,27,NULL,NULL,NULL,NULL,30,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0),
	(8,'female','Gill Crane',85,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,29,NULL,29,NULL,27,NULL,NULL,0,0),
	(9,'female','Francis Varley',27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,27,0),
	(10,'female','Fran Varley',27,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,26),
	(11,'male','Steve Smales',540,60,60,NULL,60,60,60,NULL,NULL,60,NULL,60,60,NULL,60,NULL,NULL,0,0),
	(12,'male','Duncan Mullier',525,54,57,60,57,57,57,NULL,60,57,60,NULL,55,60,57,NULL,NULL,52,NULL),
	(13,'male','Julian Varley',506,41,45,49,54,NULL,54,NULL,55,53,NULL,NULL,49,NULL,53,57,60,60,60),
	(14,'male','Simon Cave',494,51,55,57,52,55,NULL,NULL,57,54,53,NULL,31,54,54,55,51,49,NULL),
	(15,'male','Paul Lamb',490,50,52,54,NULL,NULL,NULL,NULL,NULL,NULL,54,57,57,57,55,54,NULL,NULL,NULL),
	(16,'male','Richard Hamilton',486,53,54,52,49,40,55,NULL,NULL,55,57,NULL,53,55,52,NULL,NULL,NULL,NULL),
	(17,'male','Dave Morris',483,55,NULL,55,51,54,NULL,NULL,NULL,51,NULL,55,54,NULL,51,NULL,NULL,NULL,57),
	(18,'male','Edwyn Oliver-Evans',467,49,51,48,NULL,51,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,50,53,57,55,NULL),
	(19,'male','Rob Senior',466,48,NULL,NULL,48,52,NULL,NULL,53,50,NULL,54,NULL,37,49,51,53,49,55),
	(20,'male','Simon Ketteringham',463,32,49,47,53,NULL,NULL,NULL,54,49,NULL,NULL,52,52,NULL,52,55,NULL,NULL),
	(23,'male','Kelvin Johnson',62,4,5,4,3,45,0,0,0,0,0,0,0,0,0,0,0,0,1),
	(24,'female','Sherida',120,43,0,34,0,43,0,0,0,0,0,0,0,0,0,0,0,0,0);

/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `password_recover` int(11) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0',
  `allow_email` int(11) NOT NULL DEFAULT '1',
  `profile` varchar(55) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`)
VALUES
	(16,'antonydat','5f4dcc3b5aa765d61d8327deb882cf99','Tony','Ampomah','antonydat@hotmail.com','49548a959c605ce598cfdc64df4509c1',1,0,1,1,''),
	(20,'kwamedat','5f4dcc3b5aa765d61d8327deb882cf99','KWame','Dart','antonydat@gmail.com','1274a64cdd8504020ea90bbc8bc58646',0,0,0,0,'');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
