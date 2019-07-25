
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
DROP TABLE IF EXISTS `fm_hb_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_hb_email_templates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `to_address` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `reply_to_address` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `from_address` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `format` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lang` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_hb_email_templates` WRITE;
/*!40000 ALTER TABLE `fm_hb_email_templates` DISABLE KEYS */;
INSERT INTO `fm_hb_email_templates` VALUES (1,'Admin notification','','','','New reservation','New reservation:\n\n- Customer first name: [customer_first_name]\n- Customer last name: [customer_last_name]\n- Customer email: [customer_email]\n- Check-in date: [resa_check_in]\n- Check-out date: [resa_check_out]\n- Number of adults: [resa_adults]\n- Number of children: [resa_children]\n- Accommodation: [resa_accommodation]\n- Price: [resa_price]','TEXT','all','new_resa'),(2,'Customer notification','[customer_email]','','','Your reservation','Hello [customer_first_name],\n\nThank you for choosing to stay with us! We are pleased to confirm your reservation as follows:\n\nCheck-in date: [resa_check_in]\nCheck-out date: [resa_check_out]\nNumber of adults: [resa_adults]\nNumber of children: [resa_children]\nAccommodation: [resa_accommodation]\nPrice: [resa_price]\n\nSee you soon!','TEXT','all','new_resa'),(3,'Reservation confirmation','[customer_email]','','','Your reservation','Hello [customer_first_name],\n\nThank you for choosing to stay with us! We are pleased to confirm your reservation as follows:\n\nCheck-in date: [resa_check_in]\nCheck-out date: [resa_check_out]\nNumber of adults: [resa_adults]\nNumber of children: [resa_children]\nAccommodation: [resa_accommodation]\nPrice: [resa_price]\n\nSee you soon!','TEXT','all','confirmation_resa');
/*!40000 ALTER TABLE `fm_hb_email_templates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

