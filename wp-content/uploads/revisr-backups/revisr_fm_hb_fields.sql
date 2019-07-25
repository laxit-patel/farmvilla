
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
DROP TABLE IF EXISTS `fm_hb_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_hb_fields` (
  `id` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `standard` tinyint(1) NOT NULL,
  `displayed` tinyint(1) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `has_choices` tinyint(1) NOT NULL,
  `order_num` bigint(20) NOT NULL,
  `form_name` varchar(15) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `data_about` varchar(15) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `column_width` varchar(15) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_hb_fields` WRITE;
/*!40000 ALTER TABLE `fm_hb_fields` DISABLE KEYS */;
INSERT INTO `fm_hb_fields` VALUES ('details_form_title','Form title',1,1,0,'title',0,1,'booking','customer',''),('first_name','First name',1,1,1,'text',0,2,'booking','customer',''),('last_name','Last name',1,0,1,'text',0,3,'booking','customer',''),('email','Email',1,1,1,'email',0,4,'booking','customer',''),('phone','Phone',0,1,0,'text',0,5,'booking','customer',''),('city','City',0,1,0,'text',0,6,'booking','customer',''),('zip_code','Zip code',0,1,0,'text',0,7,'booking','customer','');
/*!40000 ALTER TABLE `fm_hb_fields` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

