
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
DROP TABLE IF EXISTS `fm_yoast_seo_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_yoast_seo_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=490 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_yoast_seo_links` WRITE;
/*!40000 ALTER TABLE `fm_yoast_seo_links` DISABLE KEYS */;
INSERT INTO `fm_yoast_seo_links` VALUES (121,'',265,0,'internal'),(43,'http://resortfarmvilla.com/wp-content/uploads/2019/07/33b6d2d17a195047.jpg',172,0,'internal'),(42,'http://resortfarmvilla.com/wp-content/uploads/2019/07/7710a3e01cd80ad6.jpg',172,0,'internal'),(41,'http://resortfarmvilla.com/wp-content/uploads/2019/07/89da379facf85d6c.jpg',172,0,'internal'),(40,'http://resortfarmvilla.com/wp-content/uploads/2019/07/16c4b0dfd4747c98.jpg',172,0,'internal'),(39,'http://resortfarmvilla.com/wp-content/uploads/2019/07/0d464cb1c1f49f00-1.jpg',172,0,'internal'),(38,'http://resortfarmvilla.com/wp-content/uploads/2019/07/35289abf07157aa2.jpg',172,0,'internal'),(37,'http://resortfarmvilla.com/wp-content/uploads/2019/07/9e485c11dcef94b4.jpg',172,0,'internal'),(36,'http://resortfarmvilla.com/wp-content/uploads/2019/07/ea5743d9d190138a-2.jpg',172,0,'internal'),(35,'http://resortfarmvilla.com/wp-content/uploads/2019/07/3e548ed3f8e3de99.jpg',172,0,'internal'),(34,'http://resortfarmvilla.com/wp-content/uploads/2019/07/31cc1e8c9679e49b.jpg',172,0,'internal'),(109,'http://www.resortfarmvilla.com/wp-admin/',2,0,'external'),(120,'',265,0,'internal'),(119,'',265,0,'internal'),(256,'https://search.google.com/local/reviews?placeid=ChIJhxBQOSXhUDkRua4D7t24hwQ',18,0,'external'),(483,'http://resortfarmvilla.com/corporate',286,502,'internal'),(481,'http://resortfarmvilla.com/wedding',286,341,'internal'),(482,'http://resortfarmvilla.com/corporate',286,502,'internal'),(343,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_trip_png.png',456,0,'internal'),(255,'https://www.google.com/maps/contrib/100981533885576443637/reviews',18,0,'external'),(254,'https://www.google.com/maps/contrib/101759757307560197211/reviews',18,0,'external'),(253,'https://www.google.com/maps/contrib/101676936381736016876/reviews',18,0,'external'),(252,'https://www.google.com/maps/contrib/103807280311971178538/reviews',18,0,'external'),(251,'https://www.google.com/maps/contrib/104272991585427326743/reviews',18,0,'external'),(250,'https://maps.google.com/?cid=326432761328152249',18,0,'external'),(342,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_fb_svg.svg',456,0,'internal'),(341,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_fb_png.png',456,0,'internal'),(339,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_google_png.png',456,0,'internal'),(340,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_google_svg.svg',456,0,'internal'),(337,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_farmvilla_png.png',456,0,'internal'),(338,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_farmvilla_svg.svg',456,0,'internal'),(344,'http://resortfarmvilla.com/wp-content/uploads/2019/07/qr_trip_svg.svg',456,0,'internal'),(480,'http://resortfarmvilla.com/wedding',286,341,'internal');
/*!40000 ALTER TABLE `fm_yoast_seo_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

