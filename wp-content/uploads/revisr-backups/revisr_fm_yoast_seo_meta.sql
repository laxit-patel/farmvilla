
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
DROP TABLE IF EXISTS `fm_yoast_seo_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_yoast_seo_meta` (
  `object_id` bigint(20) unsigned NOT NULL,
  `internal_link_count` int(10) unsigned DEFAULT NULL,
  `incoming_link_count` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `object_id` (`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_yoast_seo_meta` WRITE;
/*!40000 ALTER TABLE `fm_yoast_seo_meta` DISABLE KEYS */;
INSERT INTO `fm_yoast_seo_meta` VALUES (16,0,0),(18,0,0),(19,0,0),(44,0,0),(42,0,0),(46,0,0),(49,0,0),(10,0,0),(11,0,0),(12,0,0),(69,0,0),(74,0,0),(70,0,0),(68,0,0),(71,0,0),(88,0,0),(107,0,0),(110,0,0),(112,0,0),(138,0,0),(140,0,0),(141,0,0),(142,0,0),(143,0,0),(144,0,0),(100,0,0),(169,0,0),(172,10,0),(23,0,0),(189,0,0),(196,0,0),(216,0,0),(218,0,0),(220,0,0),(221,0,0),(223,0,0),(228,0,0),(230,0,0),(234,0,0),(237,0,0),(236,0,0),(239,0,0),(219,0,0),(1,0,0),(251,0,0),(259,0,0),(260,0,0),(2,0,0),(265,3,0),(284,0,0),(285,0,0),(283,0,0),(286,4,0),(307,0,0),(310,0,0),(315,0,0),(314,0,0),(341,0,2),(356,0,0),(361,0,0),(349,0,0),(377,0,0),(380,0,0),(383,0,0),(392,0,0),(403,0,0),(408,0,0),(409,0,0),(407,0,0),(432,0,0),(433,0,0),(431,0,0),(434,0,0),(406,0,0),(456,8,0),(470,0,0),(475,0,0),(463,0,0),(465,0,0),(471,0,0),(472,0,0),(476,0,0),(477,0,0),(481,0,0),(479,0,0),(480,0,0),(486,0,0),(485,0,0),(484,0,0),(483,0,0),(482,0,0),(448,0,0),(449,0,0),(452,0,0),(334,0,0),(335,0,0),(325,0,0),(326,0,0),(496,0,0),(502,0,2),(500,0,0),(499,0,0),(510,0,0),(515,0,0),(511,0,0),(324,0,0),(322,0,0),(323,0,0),(328,0,0),(329,0,0),(519,0,0),(521,0,0),(522,0,0),(524,0,0),(534,0,0),(545,0,0),(550,0,0),(551,0,0),(279,0,0),(567,0,0),(568,0,0),(571,0,0),(572,0,0),(565,0,0),(566,0,0),(576,0,0),(34,0,0),(50,0,0),(127,0,0),(135,0,0),(4,0,0),(584,0,0),(98,0,0),(96,0,0);
/*!40000 ALTER TABLE `fm_yoast_seo_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

