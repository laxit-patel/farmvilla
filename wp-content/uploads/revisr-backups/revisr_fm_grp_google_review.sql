
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `fm_grp_google_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_grp_google_review` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `google_place_id` bigint(20) unsigned NOT NULL,
  `hash` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `text` varchar(10000) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `time` int(11) NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `author_url` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `profile_photo_url` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grp_google_review_hash` (`hash`),
  KEY `grp_google_place_id` (`google_place_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_grp_google_review` WRITE;
/*!40000 ALTER TABLE `fm_grp_google_review` DISABLE KEYS */;
INSERT INTO `fm_grp_google_review` VALUES (1,1,'1560163554',4,'Nice place to enjoy with kids. It\'s a pet friendly property,so one can bring the pets along. They\'ve a small and safe swimming pool.resort is surrounded by mango orchards .the only reason I didn\'t give five star is that there is no proper restaurant.one gets tea and coffee but for food, they get it packed from outside for you. Otherwise the management is good and helping.It\'s around 8km from City and one doesn\'t get cabs easily. Cottages are better place to stay than rooms. Nearby village bhujodi is good for handicraft purchasing',1560163554,'en','Mohit Sudan','https://www.google.com/maps/contrib/101676936381736016876/reviews','https://lh4.googleusercontent.com/-XcnmrZ1uRA0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfIBRzCfD-_lVVlzUrkuXSEAFPvig/s128-c0x00000000-cc-rp-mo-ba4/photo.jpg'),(2,1,'1562828166',5,'Best place for weekends with families. resort have many amenities including indoor Gymnasium, Swimming Pool and Party Plot. Resort Have Friendly Staff and Serves Traditional Cuisine along With Many Type Of Other Foods. I had Good Time Here And I Recommend It To Everyone.',1562828166,'en','Laxit Patel','https://www.google.com/maps/contrib/104272991585427326743/reviews','https://lh3.googleusercontent.com/-LErw4MFR7M0/AAAAAAAAAAI/AAAAAAAAAE8/FLcGjZhK63w/s128-c0x00000000-cc-rp-mo/photo.jpg'),(3,1,'1561735438',5,'Happy to come here... Service is very good. Helping staff... Good location',1561735438,'en','Rekha Vora','https://www.google.com/maps/contrib/103807280311971178538/reviews','https://lh5.googleusercontent.com/-lWscMPtpIVs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNvghOOoISEtEolsMO_bfACwd5Tg/s128-c0x00000000-cc-rp-mo/photo.jpg'),(4,1,'1559139649',5,'Felling amazing here with swimming pool.\n\nBathroom Facility\nChanging Room Facility\nAnd\nMuch more\n\nI experienced swimming pool here, water quality is so good very clean.\n\nKids have separate pool and adults have separate pool.',1559139649,'en','Mehul Maharaj','https://www.google.com/maps/contrib/101759757307560197211/reviews','https://lh3.googleusercontent.com/-WlJzrTLTcYg/AAAAAAAAAAI/AAAAAAAABSY/0MT_sOgTH6s/s128-c0x00000000-cc-rp-mo-ba5/photo.jpg'),(5,1,'1552031102',4,'The property gives you \"a small farm house\" feel with a clean and calm environment. \nExisting Swimming Pool is very small. They should be expand pool area.\nHotel Location is very prime area. on the National Highway.\nThe only thing Hotel should improve is PARKING SPACE.\nwell managed property. I liked it.',1552031102,'en','Harshal Patel','https://www.google.com/maps/contrib/100981533885576443637/reviews','https://lh4.googleusercontent.com/-3OKJoURpJRU/AAAAAAAAAAI/AAAAAAAABco/2YAh_f06ls0/s128-c0x00000000-cc-rp-mo-ba3/photo.jpg');
/*!40000 ALTER TABLE `fm_grp_google_review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

