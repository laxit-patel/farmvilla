
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
DROP TABLE IF EXISTS `fm_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `fm_usermeta` WRITE;
/*!40000 ALTER TABLE `fm_usermeta` DISABLE KEYS */;
INSERT INTO `fm_usermeta` VALUES (1,1,'nickname','farmvilla'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'syntax_highlighting','true'),(7,1,'comment_shortcuts','false'),(8,1,'admin_color','fresh'),(9,1,'use_ssl','0'),(10,1,'show_admin_bar_front','true'),(11,1,'locale',''),(12,1,'fm_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(13,1,'fm_user_level','10'),(14,1,'dismissed_wp_pointers','amp_stories_support_pointer_12'),(15,1,'show_welcome_panel','1'),(16,1,'session_tokens','a:12:{s:64:\"adc6868a3e7ef60e3df7ff11e964b0af39430b415502241af9f6a22f52b1625d\";a:4:{s:10:\"expiration\";i:1564030778;s:2:\"ip\";s:13:\"59.94.207.220\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1562821178;}s:64:\"8ae3da7701209df4ed548e5e0e8559a3820db9c05aff7adf6cf9a024e2ad11b3\";a:4:{s:10:\"expiration\";i:1564063708;s:2:\"ip\";s:13:\"59.94.207.220\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1562854108;}s:64:\"a102f156db3c09e5a0d0107cba2207b78badfefffacc53bf8cb5cb56d19eabde\";a:4:{s:10:\"expiration\";i:1564063743;s:2:\"ip\";s:13:\"59.94.207.220\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1562854143;}s:64:\"1ac07389c79d63bcaf150b5eddcc1607b31e34c9c999e91bcffbb9a8bced2133\";a:4:{s:10:\"expiration\";i:1564123529;s:2:\"ip\";s:11:\"49.34.34.47\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1562913929;}s:64:\"89495fa94ee48f7e6c06873b0d87f666d8a5bf9e732802665abb147d007b3f06\";a:4:{s:10:\"expiration\";i:1564298545;s:2:\"ip\";s:13:\"27.61.185.225\";s:2:\"ua\";s:124:\"Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.99 Mobile Safari/537.36\";s:5:\"login\";i:1563088945;}s:64:\"fa465b00c4dfbd3ffcb4ed8053f0edc736c72643b9b5c3684a4c57be927ef8a9\";a:4:{s:10:\"expiration\";i:1564378579;s:2:\"ip\";s:13:\"59.94.204.126\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563168979;}s:64:\"c628bc3b46d1cbf2ef7db23345a1b0d1c97673b84d92ce21366e4d6f9b798c73\";a:4:{s:10:\"expiration\";i:1564393272;s:2:\"ip\";s:13:\"59.94.204.126\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563183672;}s:64:\"5b2f9717c441b092a7973ec26337e232dbd6b8a6d21b26afee2412fc7ddc9d30\";a:4:{s:10:\"expiration\";i:1564548267;s:2:\"ip\";s:13:\"59.94.204.200\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563338667;}s:64:\"a84f252d8f6fa2339437ec1e904e7e89d51c5a51d863b3354550a44b7affaea8\";a:4:{s:10:\"expiration\";i:1564548292;s:2:\"ip\";s:13:\"59.94.204.200\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563338692;}s:64:\"07b06d6dc935bd5dadf24092f5a339c144d448679c945030e71f5ef710b403f5\";a:4:{s:10:\"expiration\";i:1564549358;s:2:\"ip\";s:13:\"59.94.204.200\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563339758;}s:64:\"963ad3e0f208e8fddce932e6a8938ff735f8f38c1a615009580406ed2f0c0bd8\";a:4:{s:10:\"expiration\";i:1564549411;s:2:\"ip\";s:13:\"59.94.204.200\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36\";s:5:\"login\";i:1563339811;}s:64:\"fcc60f0454cae7a2fc50f3a1d5b7a1409b9ea8a2b379468f515b9bce62ad30e1\";a:4:{s:10:\"expiration\";i:1564653401;s:2:\"ip\";s:12:\"117.228.66.2\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36\";s:5:\"login\";i:1563443801;}}'),(17,1,'fm_dashboard_quick_press_last_post_id','583'),(18,1,'community-events-location','a:1:{s:2:\"ip\";s:11:\"59.94.204.0\";}'),(19,1,'obfx_ignore_visit_dashboard_notice','true'),(20,1,'_yoast_wpseo_profile_updated','1562824260'),(21,1,'fm_user-settings','libraryContent=browse&editor=tinymce&widgets_access=on'),(22,1,'fm_user-settings-time','1563276061'),(24,1,'jetpack_tracks_wpcom_id','160159640'),(25,1,'jetpack_tracks_anon_id','jetpack:aXb/teh7jmqr1leVpKC+2WxN'),(26,1,'elementor_introduction','a:1:{s:10:\"rightClick\";b:1;}'),(28,1,'closedpostboxes_hb_accommodation','a:2:{i:0;s:10:\"wpseo_meta\";i:1;s:22:\"yoast_internal_linking\";}'),(33,1,'closedpostboxes_page','a:3:{i:0;s:14:\"review_metabox\";i:1;s:25:\"wpassetcleanup_asset_list\";i:2;s:16:\"seopress_pro_cpt\";}'),(34,1,'metaboxhidden_page','a:0:{}'),(35,1,'closedpostboxes_wptwa_accounts','a:1:{i:0;s:14:\"review_metabox\";}'),(36,1,'metaboxhidden_wptwa_accounts','a:1:{i:0;s:7:\"slugdiv\";}'),(29,1,'metaboxhidden_hb_accommodation','a:0:{}'),(31,1,'fm_media_library_mode','grid');
/*!40000 ALTER TABLE `fm_usermeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

