
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
DROP TABLE IF EXISTS `fm_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `fm_term_taxonomy` DISABLE KEYS */;
INSERT INTO `fm_term_taxonomy` VALUES (1,1,'category','',0,1),(2,2,'nav_menu','',0,4),(3,3,'nav_menu','',0,5),(4,4,'yst_prominent_words','',0,0),(5,5,'yst_prominent_words','',0,1),(6,6,'yst_prominent_words','',0,0),(7,7,'yst_prominent_words','',0,0),(8,8,'yst_prominent_words','',0,0),(9,9,'yst_prominent_words','',0,0),(10,10,'yst_prominent_words','',0,0),(11,11,'yst_prominent_words','',0,0),(12,12,'yst_prominent_words','',0,0),(13,13,'yst_prominent_words','',0,0),(14,14,'yst_prominent_words','',0,0),(15,15,'yst_prominent_words','',0,0),(16,16,'yst_prominent_words','',0,0),(17,17,'yst_prominent_words','',0,0),(18,18,'yst_prominent_words','',0,0),(19,19,'yst_prominent_words','',0,0),(20,20,'yst_prominent_words','',0,0),(21,21,'yst_prominent_words','',0,0),(22,22,'yst_prominent_words','',0,0),(23,23,'yst_prominent_words','',0,0),(24,24,'yst_prominent_words','',0,0),(25,25,'yst_prominent_words','',0,0),(26,26,'yst_prominent_words','',0,0),(27,27,'yst_prominent_words','',0,0),(28,28,'yst_prominent_words','',0,0),(29,29,'yst_prominent_words','',0,0),(30,30,'yst_prominent_words','',0,0),(31,31,'yst_prominent_words','',0,0),(32,32,'yst_prominent_words','',0,1),(33,33,'yst_prominent_words','',0,0),(34,34,'yst_prominent_words','',0,0),(35,35,'nav_menu','',0,4),(36,36,'elementor_library_type','',0,1),(37,37,'yst_prominent_words','',0,1),(38,38,'yst_prominent_words','',0,1),(39,39,'yst_prominent_words','',0,1),(40,40,'yst_prominent_words','',0,1),(41,41,'yst_prominent_words','',0,1),(42,42,'yst_prominent_words','',0,1),(43,43,'yst_prominent_words','',0,1),(44,44,'yst_prominent_words','',0,1),(45,45,'yst_prominent_words','',0,1),(46,46,'yst_prominent_words','',0,1),(47,47,'yst_prominent_words','',0,1),(48,48,'yst_prominent_words','',0,1),(49,49,'yst_prominent_words','',0,1),(50,50,'yst_prominent_words','',0,1),(51,51,'yst_prominent_words','',0,1),(52,52,'yst_prominent_words','',0,1),(53,53,'yst_prominent_words','',0,1),(54,54,'yst_prominent_words','',0,1),(55,55,'yst_prominent_words','',0,1),(56,56,'yst_prominent_words','',0,1),(57,57,'yst_prominent_words','',0,1),(58,58,'yst_prominent_words','',0,1),(59,59,'yst_prominent_words','',0,1),(60,60,'yst_prominent_words','',0,1),(61,61,'yst_prominent_words','',0,1),(62,62,'yst_prominent_words','',0,1),(63,63,'yst_prominent_words','',0,1),(64,64,'yst_prominent_words','',0,1),(65,65,'yst_prominent_words','',0,1),(66,66,'yst_prominent_words','',0,1),(67,67,'yst_prominent_words','',0,1),(68,68,'yst_prominent_words','',0,1),(69,69,'yst_prominent_words','',0,1),(70,70,'yst_prominent_words','',0,1),(71,71,'yst_prominent_words','',0,1),(72,72,'yst_prominent_words','',0,1),(73,73,'yst_prominent_words','',0,1),(74,74,'yst_prominent_words','',0,1),(75,75,'yst_prominent_words','',0,0),(76,76,'yst_prominent_words','',0,0),(77,77,'yst_prominent_words','',0,0),(78,78,'yst_prominent_words','',0,0),(79,79,'yst_prominent_words','',0,0),(80,80,'yst_prominent_words','',0,0),(81,81,'yst_prominent_words','',0,0),(82,82,'yst_prominent_words','',0,0),(83,83,'yst_prominent_words','',0,0),(84,84,'yst_prominent_words','',0,0);
/*!40000 ALTER TABLE `fm_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

