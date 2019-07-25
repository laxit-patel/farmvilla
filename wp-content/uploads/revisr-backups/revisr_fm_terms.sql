
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
DROP TABLE IF EXISTS `fm_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_terms` WRITE;
/*!40000 ALTER TABLE `fm_terms` DISABLE KEYS */;
INSERT INTO `fm_terms` VALUES (1,'Uncategorized','uncategorized',0),(2,'Primary Menu','primary-menu',0),(3,'Social','social',0),(4,'hestia','hestia',0),(5,'events','events',0),(6,'traditional habitats known as bhunga','traditional-habitats-known-as-bhunga',0),(7,'lit and radiates bright aura','lit-and-radiates-bright-aura',0),(8,'radiates bright aura to lift','radiates-bright-aura-to-lift',0),(9,'bright aura to lift mood','bright-aura-to-lift-mood',0),(10,'lift mood up relieve stress','lift-mood-up-relieve-stress',0),(11,'kutchi traditional habitats known','kutchi-traditional-habitats-known',0),(12,'feeling of tradition of kutch','feeling-of-tradition-of-kutch',0),(13,'notch and available 24 x','notch-and-available-24-x',0),(14,'well lit and radiates bright','well-lit-and-radiates-bright',0),(15,'habitats known as bhunga','habitats-known-as-bhunga',0),(16,'unique feeling of tradition','unique-feeling-of-tradition',0),(17,'available 24 x 7','available-24-x-7',0),(18,'clean everyday for hygiene','clean-everyday-for-hygiene',0),(19,'lit and radiates bright','lit-and-radiates-bright',0),(20,'bright aura to lift','bright-aura-to-lift',0),(21,'aura to lift mood','aura-to-lift-mood',0),(22,'lift mood up relieve','lift-mood-up-relieve',0),(23,'mood up relieve stress','mood-up-relieve-stress',0),(24,'kutchi traditional habitats','kutchi-traditional-habitats',0),(25,'traditional habitats known','traditional-habitats-known',0),(26,'₨ 1200','%e2%82%a8-1200',0),(27,'air conditioned','air-conditioned',0),(28,'room service','room-service',0),(29,'book','book',0),(30,'page','page',0),(31,'site','site',0),(32,'farmvilla','farmvilla',0),(33,'wedding','wedding',0),(34,'marriage','marriage',0),(35,'Review','review',0),(36,'section','section',0),(37,'planning themes ideas of wedding','planning-themes-ideas-of-wedding',0),(38,'themes ideas of wedding décor','themes-ideas-of-wedding-decor',0),(39,'ideas of wedding décor according','ideas-of-wedding-decor-according',0),(40,'conference hall','conference-hall',0),(41,'business meeting','business-meeting',0),(42,'conference','conference',0),(43,'business','business',0),(44,'hall','hall',0),(45,'meeting','meeting',0),(46,'team','team',0),(47,'event','event',0),(48,'trade','trade',0),(49,'ceremony','ceremony',0),(50,'covered','covered',0),(51,'plan','plan',0),(52,'morale','morale',0),(53,'employees','employees',0),(54,'working','working',0),(55,'typical','typical',0),(56,'experience','experience',0),(57,'projector','projector',0),(58,'ideas our experienced designer team','ideas-our-experienced-designer-team',0),(59,'décor according to your taste','decor-according-to-your-taste',0),(60,'exchange of ideas our experienced','exchange-of-ideas-our-experienced',0),(61,'themes ideas of wedding','themes-ideas-of-wedding',0),(62,'ideas of wedding décor','ideas-of-wedding-decor',0),(63,'taste with proper exchange','taste-with-proper-exchange',0),(64,'proper exchange of ideas','proper-exchange-of-ideas',0),(65,'ideas our experienced designer','ideas-our-experienced-designer',0),(66,'varieties of decoration settings','varieties-of-decoration-settings',0),(67,'decoration settings to choose','decoration-settings-to-choose',0),(68,'planning themes ideas','planning-themes-ideas',0),(69,'wedding décor according','wedding-decor-according',0),(70,'experienced designer team','experienced-designer-team',0),(71,'according to your taste','according-to-your-taste',0),(72,'ideas of wedding','ideas-of-wedding',0),(73,'taste with proper','taste-with-proper',0),(74,'exchange of ideas','exchange-of-ideas',0),(75,'single bed','single-bed',0),(76,'room','room',0),(77,'24','24',0),(78,'1200','1200',0),(79,'₨1500','%e2%82%a81500',0),(80,'air','air',0),(81,'conditioned','conditioned',0),(82,'single','single',0),(83,'bed','bed',0),(84,'service','service',0);
/*!40000 ALTER TABLE `fm_terms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

