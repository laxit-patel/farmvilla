
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
DROP TABLE IF EXISTS `fm_hb_resa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_hb_resa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `accom_id` bigint(20) NOT NULL,
  `accom_num` bigint(20) NOT NULL,
  `adults` smallint(10) NOT NULL,
  `children` smallint(10) NOT NULL,
  `price` decimal(14,2) NOT NULL,
  `deposit` decimal(14,2) NOT NULL,
  `paid` decimal(14,2) NOT NULL,
  `payment_gateway` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `additional_info` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `payment_type` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `payment_info` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `admin_comment` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lang` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `coupon` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `payment_token` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `payment_status` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `payment_status_reason` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `amount_to_pay` decimal(14,2) NOT NULL,
  `received_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `uid` varchar(256) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `origin` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `synchro_id` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `booking_form_num` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_hb_resa` WRITE;
/*!40000 ALTER TABLE `fm_hb_resa` DISABLE KEYS */;
INSERT INTO `fm_hb_resa` VALUES (1,'2019-07-13','2019-07-16',223,1,2,1,45.00,0.00,0.00,'','USD',1,'new','[]','[]','offline','','','en_US','','','','',0.00,'2019-07-13 10:31:22','2019-07-13 10:31:22','D2019-07-13T10:31:22U5d29b2fa718af@http://resortfarmvilla.com','website','',1);
/*!40000 ALTER TABLE `fm_hb_resa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

