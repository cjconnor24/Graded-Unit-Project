-- MySQL dump 10.13  Distrib 5.7.18, for osx10.12 (x86_64)
--
-- Host: localhost    Database: spectrummis
-- ------------------------------------------------------
-- Server version	5.7.18

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

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (2,2,'EB1QZvwnCTUCXuPnuU3hCHEtRGVpnuZs',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(4,4,'Q29KYiml5trnT0oh2kAed9wTN90a643h',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(5,5,'z82NRfc0TpyTim5sZp7ODEwZgPtCDbaK',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(6,6,'zDwBWpZtfw0Gfg7IqeCcagxhB3tltmvX',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(8,8,'5DV8cfmDNKKLUSkqVxUrlTfQkbAy1app',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(9,9,'SRNpFCvRPH4RKP72kJbWOYp3j3M05wYZ',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(10,10,'2qfTpzHUileIKrv5JEqpqbp9TwTxvtAm',1,'2017-05-08 12:30:02','2017-05-08 12:30:02','2017-05-08 12:30:02'),(12,12,'1vtjNde9rdoGW9G9S69FgOsVzs65HoHu',1,'2017-05-09 12:07:58','2017-05-09 12:07:28','2017-05-09 12:07:58'),(13,13,'2wJmyzkNdgQtUzyNoyB7PKU22EggZHEH',1,'2017-05-17 07:08:19','2017-05-17 07:07:56','2017-05-17 07:08:19'),(14,11,'cKUEKFxORTB6h8dmupmVhuqqlbwcDooO',1,'2017-05-17 10:00:54','2017-05-17 10:00:22','2017-05-17 10:00:54'),(31,7,'JaqCtnmq5hCJxGhhxFzKprDY7r23dsl0',1,'2017-05-17 11:01:22','2017-05-17 11:01:22','2017-05-17 11:01:22'),(34,3,'DBm0eOZeeMVrhn4amocMxxGqRFj1RUg7',1,'2017-05-17 11:35:15','2017-05-17 11:35:15','2017-05-17 11:35:15');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,'Walter, Miller and Becker','480 Mariam Wall Apt. 676','Ward Spring','West Ebonyland','Michigan','23167-4499',1,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(2,'Waelchi, Schaefer and Langworth','115 Schowalter Club Suite 898','Lehner Parkway','Joannyport','Illinois','16991',1,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(3,'Kulas-Raynor','4140 Flavie Vista','Camila Radial','East Tremayneton','Oregon','96630',2,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(4,'Volkman PLC','2261 Beatty Ranch Apt. 644','Grady Ways','Dickenshaven','','55522-7168',2,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(5,'Bernier, Emmerich and Durgan','180 Cruickshank Loop Suite 575','Rippin Terrace','Emardborough','Nevada','09904',3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(6,'Hyatt Inc','4128 Aufderhar Skyway','Kuhic Trail','Wuckertberg','New Hampshire','90174',3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(7,'Weber Ltd','35199 Gutmann Squares','Corine Crossing','Christinaville','West Virginia','03497',4,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(8,'Jakubowski Inc','346 Carolyn Pike','Westley Oval','Port Guidofort','Utah','91827-1981',4,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(9,'Hayes, Pagac and Schumm','663 Aufderhar Tunnel','Thiel Loaf','North Titus','Pennsylvania','64330-6629',5,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(10,'Murazik-Schmidt','18284 Dusty Summit Suite 353','Mandy Unions','Schusterborough','Alaska','57474-5651',5,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(11,'Lang, Pollich and Ullrich','89567 Miller Groves Apt. 726','Oscar Court','North Kariane','Nevada','39964-3238',6,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(12,'Grant-Keeling','5131 Connelly Walk','Tillman Ford','South Anjali','Alaska','85113',6,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(13,'Auer and Sons','66255 Mae Mills Apt. 780','Marcelino Cliff','Lake Carrie','New Jersey','81807-9064',7,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(14,'Strosin, Nolan and Nolan','2327 Ward Mews','Beahan Drive','Port Nellaview','Massachusetts','45155-4923',7,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(15,'Block-Walker','878 Bailey Turnpike','Everardo Hills','Declanfurt','Texas','20806-9744',8,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(16,'Kshlerin-Gibson','820 Magdalena Gateway','Harmony Roads','New Tedstad','New York','58261-9769',8,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(17,'Bogan Group','620 Elvis Crest Apt. 543','Bergstrom Ridges','North Alec','West Virginia','49268-9239',9,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(18,'Zieme, Parker and Stark','2720 Jacobson Glens Apt. 910','Kuvalis Centers','South Maceyfort','New Hampshire','79690',9,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(19,'Kuhlman-Gerhold','97681 Cole Prairie','Alysa Loop','Port Jadeburgh','North Carolina','55657',10,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(20,'Pacocha-Feeney','9395 Emerson Court Apt. 130','Bashirian Rapids','New Jakayla','South Carolina','08388',10,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(21,'Test','12 Linn Gardens','Craiglinn','Cumbernauld','Glasgow','G68 9AN',2,'2017-05-16 10:40:21','2017-05-16 10:40:21'),(22,'Additional','55 Old Tower Road',NULL,NULL,NULL,'G68 9GD',2,'2017-05-16 10:40:34','2017-05-16 10:40:34'),(23,'Bobby Castle','123 Bobbby Street','Glasgow',NULL,NULL,'G68 9YT',13,'2017-05-17 07:09:13','2017-05-17 07:09:13');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'DIFC','91252 Genoveva Burgs Suite 744','Upton Stravenue','Stromanfort','Florida','86867','230-919-3032 x45270','fhayes@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02'),(2,'DWTC','80054 Maggio Mountain','Eichmann Square','Lake Ashtyn','Ohio','11991-5780','435.753.0364 x0652','gislason.loren@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02'),(3,'ET','3670 Bogisich Shoals','Joanie Garden','Albinatown','South Dakota','59189-6135','871.718.6655','orie.lakin@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02'),(4,'TwoFour54','55997 Kunde Mission','Damien Shores','New Branson','Oregon','94042-0404','953.429.6377 x68439','sward@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02'),(5,'AbuDhabi Uni','197 Lind Land Apt. 914','Keven Lights','North Urban','Virginia','58414','691.817.6259','darwin.spencer@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02'),(6,'Dubai Uni','2940 Rath Station','Angelita Squares','East Cordelia','South Dakota','07564-4937','+1 (339) 918-2574','gleannon@spectrumdubai.com','2017-05-08 12:30:02','2017-05-08 12:30:02');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Business Cards','2017-03-21 07:41:47','2017-03-21 07:41:47'),(2,'Posters','2017-03-21 07:41:47','2017-03-21 07:41:47'),(3,'Booklets','2017-03-21 07:41:47','2017-03-21 07:41:47'),(4,'Leaflets','2017-03-21 07:41:47','2017-03-21 07:41:47');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_contact_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_main_contact_id_foreign` (`main_contact_id`),
  CONSTRAINT `companies_main_contact_id_foreign` FOREIGN KEY (`main_contact_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_07_02_230147_migration_cartalyst_sentinel',1),(2,'2017_03_20_131727_create_categories_table',1),(3,'2017_03_20_135145_create_sizes_table',1),(4,'2017_03_20_154935_create_products_table',1),(5,'2017_03_20_193038_create_product_size_table',1),(6,'2017_03_20_212614_create_papers_table',1),(7,'2017_03_21_102635_create_notes_table',1),(8,'2017_03_21_121619_create_addresses_table',1),(9,'2017_03_28_094349_create_companies_table',1),(10,'2017_03_29_171230_testing_migration',1),(11,'2017_04_23_092739_create_branches_table',1),(12,'2017_04_23_141500_create_order_states_table',1),(13,'2017_04_23_141635_create_orders_table',1),(14,'2017_05_02_102809_create_quote_approvals_table',1),(15,'2017_05_08_124222_create_order_statuses_table',1),(16,'2017_05_08_125512_add_order_status_columns',1),(19,'2017_05_09_085027_create_quote_rejections_table',2),(24,'2017_05_09_135831_create_payments_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_user_id_foreign` (`user_id`),
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,'Adding a note',26,11,'2017-05-22 10:21:56','2017-05-22 10:21:56');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_product` (
  `product_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `paper_id` int(10) unsigned NOT NULL,
  `size_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  KEY `order_product_paper_id_foreign` (`paper_id`),
  KEY `order_product_size_id_foreign` (`size_id`),
  KEY `order_product_order_id_foreign` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_product_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_product_ibfk_4` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` VALUES (1,11,1,9,1,NULL),(1,14,1,9,4,NULL),(1,16,1,9,1,NULL),(1,17,1,9,2,NULL),(1,19,1,9,3,NULL),(1,20,1,9,1,NULL),(1,21,1,9,1,NULL),(4,13,1,1,5,NULL),(4,15,1,2,4,NULL),(4,17,1,1,1,NULL),(5,11,5,6,1,NULL),(5,17,5,5,1,NULL),(4,22,1,1,1,NULL),(4,22,1,1,3,NULL),(1,23,1,9,1,NULL),(1,23,1,9,1,NULL),(1,26,1,9,1,NULL),(4,27,1,1,1,NULL),(4,28,2,1,1,NULL),(1,29,1,9,1,'chris connor testing this'),(1,30,1,9,1,NULL),(1,31,1,9,1,NULL),(1,32,1,9,1,NULL),(1,33,1,9,1,NULL),(1,34,1,9,1,NULL),(1,35,1,9,1,NULL),(1,36,2,9,1,NULL),(1,36,2,9,1,NULL),(1,36,1,1,1,'This is a test'),(3,38,2,5,1,'This is for john peter'),(1,37,1,9,2,NULL),(3,37,1,5,1,'Additional Notes here'),(3,39,3,5,1,'UPdate the covers'),(5,12,5,6,5,NULL),(4,12,2,2,3,'One post with names'),(4,18,1,1,1,'test'),(1,18,1,9,1,'Testing this'),(2,18,3,9,1,'Another test now'),(1,41,2,10,1,NULL),(3,41,2,5,1,NULL),(5,42,4,5,1,NULL),(5,43,4,5,1,NULL),(2,44,4,9,1,'some ntoes'),(3,45,1,5,1,NULL),(4,40,1,1,1,'John brown'),(4,40,1,1,3,'Jason Brown'),(4,46,1,1,1,'These are for the first brand'),(4,46,1,1,1,'These are for the second brand'),(3,47,2,5,1,'Some Bobby Tastic Leaflets'),(3,48,1,5,1,NULL),(4,49,1,1,1,NULL),(4,50,1,2,1,'adsadasd'),(4,51,1,2,1,'adsadasd'),(4,52,1,2,1,'adsadasd'),(5,53,4,5,1,NULL),(5,54,4,5,1,NULL),(4,55,1,1,1,NULL);
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1,'Awaiting Payment','2017-05-08 12:30:02',NULL),(2,'With Artworker','2017-05-08 12:30:02',NULL),(3,'Awaiting Proof Approval','2017-05-08 12:30:02',NULL),(4,'Production','2017-05-08 12:30:02',NULL),(5,'Finishing','2017-05-08 12:30:02',NULL),(6,'Distribution','2017-05-08 12:30:02',NULL),(7,'Completed','2017-05-08 12:30:02',NULL);
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_staff_id_foreign` (`staff_id`),
  KEY `orders_address_id_foreign` (`address_id`),
  KEY `orders_branch_id_foreign` (`branch_id`),
  KEY `orders_state_id_foreign` (`state_id`),
  KEY `orders_status_id_foreign` (`status_id`),
  CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (11,2,4,11,5,2,0.00,'2017-05-08 23:00:00','2017-05-09 08:21:01','2017-05-16 15:09:59',2),(12,2,3,11,5,2,0.00,'2017-05-08 23:00:00','2017-05-09 08:21:35','2017-05-17 09:20:12',1),(13,3,6,11,5,1,0.00,'2017-05-08 23:00:00','2017-05-09 09:31:49','2017-05-09 10:28:33',1),(14,2,3,11,1,1,0.00,'2017-05-09 23:00:00','2017-05-10 08:47:49','2017-05-10 09:53:53',1),(15,2,3,11,5,4,0.00,'2017-05-09 23:00:00','2017-05-10 10:49:33','2017-05-10 11:14:01',1),(16,3,6,7,1,1,0.00,'2017-05-10 23:00:00','2017-05-11 08:49:19','2017-05-11 13:32:33',NULL),(17,3,6,11,3,1,0.00,'2017-05-10 23:00:00','2017-05-11 08:49:32','2017-05-11 13:36:29',NULL),(18,1,2,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 08:49:55','2017-05-11 08:49:55',NULL),(19,4,7,11,6,1,0.00,'2017-05-10 23:00:00','2017-05-11 13:23:59','2017-05-11 14:37:39',NULL),(20,1,2,11,1,1,0.00,'2017-05-10 23:00:00','2017-05-11 14:52:33','2017-05-11 14:52:33',NULL),(21,1,2,11,1,1,0.00,'2017-05-10 23:00:00','2017-05-11 14:52:41','2017-05-11 14:52:41',NULL),(22,2,3,11,1,2,0.00,'2017-05-10 23:00:00','2017-05-11 15:01:32','2017-05-15 14:01:32',7),(23,1,1,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 15:23:34','2017-05-11 15:23:34',NULL),(24,1,1,11,6,1,0.00,'2017-05-10 23:00:00','2017-05-11 15:24:49','2017-05-11 15:24:49',NULL),(25,2,3,11,6,1,0.00,'2017-05-10 23:00:00','2017-05-11 15:25:19','2017-05-11 15:25:19',NULL),(26,2,3,11,6,2,0.00,'2017-05-11 16:00:00','2017-05-11 15:25:46','2017-05-22 09:02:55',3),(27,4,4,11,1,2,0.00,'2017-05-10 23:00:00','2017-05-11 15:26:50','2017-05-16 10:23:48',2),(28,1,2,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:26:13','2017-05-11 17:26:13',NULL),(29,2,4,11,1,2,0.00,'2017-05-10 23:00:00','2017-05-11 17:27:41','2017-05-22 09:03:13',5),(30,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:30:21','2017-05-11 17:30:21',NULL),(31,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:30:35','2017-05-11 17:30:35',NULL),(32,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:32:29','2017-05-11 17:32:29',NULL),(33,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:33:13','2017-05-11 17:33:13',NULL),(34,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:34:15','2017-05-11 17:34:15',NULL),(35,3,6,11,5,1,0.00,'2017-05-10 23:00:00','2017-05-11 17:35:26','2017-05-11 17:35:26',NULL),(36,2,3,11,1,1,0.00,'2017-05-10 23:00:00','2017-05-11 18:55:16','2017-05-11 18:55:16',NULL),(37,3,6,11,6,1,0.00,'2017-05-10 23:00:00','2017-05-11 19:01:35','2017-05-11 19:01:35',NULL),(38,1,2,11,1,1,0.00,'2017-05-10 23:00:00','2017-05-11 19:02:17','2017-05-11 19:02:17',NULL),(39,2,4,7,6,1,0.00,'2017-05-10 23:00:00','2017-05-11 19:09:51','2017-05-11 19:11:04',NULL),(40,2,4,11,1,1,0.00,'2017-05-11 23:00:00','2017-05-12 07:58:00','2017-05-12 07:58:00',NULL),(41,4,7,11,6,1,0.00,'2017-05-14 23:00:00','2017-05-15 11:24:23','2017-05-15 11:24:23',NULL),(42,1,4,11,4,2,0.00,'2017-05-14 23:00:00','2017-05-15 11:51:24','2017-05-16 10:36:21',2),(43,2,4,11,4,2,0.00,'2017-05-14 23:00:00','2017-05-15 11:51:31','2017-05-16 10:27:05',2),(44,3,4,11,1,2,0.00,'2017-05-15 18:59:43','2017-05-15 18:59:43','2017-05-16 09:04:27',2),(45,1,1,11,5,1,0.00,'2017-05-16 09:17:09','2017-05-16 09:17:09','2017-05-16 09:17:09',NULL),(46,2,4,11,1,4,0.00,'2017-05-16 13:10:15','2017-05-16 13:10:15','2017-05-17 07:53:42',NULL),(47,13,23,11,3,1,0.00,'2017-05-17 07:09:47','2017-05-17 07:09:47','2017-05-17 07:10:17',1),(48,6,11,11,2,1,0.00,'2017-05-17 07:21:53','2017-05-17 07:21:53','2017-05-17 07:21:53',NULL),(49,2,4,11,6,1,0.00,'2017-05-17 07:35:52','2017-05-17 07:35:52','2017-05-17 07:35:52',NULL),(50,2,4,11,1,1,0.00,'2017-05-17 07:50:49','2017-05-17 07:50:49','2017-05-17 07:50:49',NULL),(51,4,4,11,1,2,0.00,'2017-05-17 07:51:01','2017-05-17 07:51:01','2017-05-17 11:36:32',2),(52,2,4,11,1,1,0.00,'2017-05-17 07:51:26','2017-05-17 07:51:26','2017-05-17 07:51:26',NULL),(53,2,3,11,1,2,0.00,'2017-05-17 07:52:01','2017-05-17 07:52:01','2017-05-17 09:20:39',2),(54,2,3,11,1,4,0.00,'2017-05-17 07:52:37','2017-05-17 07:52:37','2017-05-17 07:53:27',NULL),(55,4,8,11,1,1,0.00,'2017-06-29 23:00:00','2017-05-22 10:27:33','2017-05-22 10:27:47',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paper_product`
--

DROP TABLE IF EXISTS `paper_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paper_product` (
  `paper_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`paper_id`,`product_id`),
  KEY `paper_product_product_id_foreign` (`product_id`),
  CONSTRAINT `paper_product_paper_id_foreign` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`),
  CONSTRAINT `paper_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_product`
--

LOCK TABLES `paper_product` WRITE;
/*!40000 ALTER TABLE `paper_product` DISABLE KEYS */;
INSERT INTO `paper_product` VALUES (1,1),(2,1),(3,2),(4,2),(1,3),(2,3),(3,3),(4,3),(1,4),(2,4),(4,5),(5,5);
/*!40000 ALTER TABLE `paper_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `papers`
--

LOCK TABLES `papers` WRITE;
/*!40000 ALTER TABLE `papers` DISABLE KEYS */;
INSERT INTO `papers` VALUES (1,'350gsm Uncoated','Xerox',350,'2017-03-21 09:43:18','2017-03-21 09:43:18'),(2,'350gsm Gloss','Xerox',350,'2017-03-21 09:43:18','2017-03-21 09:43:18'),(3,'210gsm Silk','Xerox',210,'2017-03-21 09:43:18','2017-03-21 09:43:18'),(4,'90gsm Copy Paper','Xerox',90,'2017-03-21 09:43:18','2017-03-21 09:43:18'),(5,'210gsm Uncoated','Xerox',210,'2017-03-21 09:43:18','2017-03-21 09:43:18');
/*!40000 ALTER TABLE `papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_type` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_customer_id_foreign` (`customer_id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (8,2,26,'qvd414xa',20.00,'paypal_account',1,'2017-05-15 10:47:34','2017-05-15 10:47:34'),(10,2,22,'4fjdv18s',92.00,'paypal_account',1,'2017-05-15 14:01:32','2017-05-15 14:01:32'),(11,2,29,'gjf0ss2a',20.00,'credit_card',1,'2017-05-15 18:58:20','2017-05-15 18:58:20'),(12,2,27,'messw89d',23.00,'credit_card',1,'2017-05-16 10:23:48','2017-05-16 10:23:48'),(13,2,43,'c2mq930b',20.00,'credit_card',1,'2017-05-16 10:27:05','2017-05-16 10:27:05'),(14,2,43,'2x8p35sh',20.00,'credit_card',1,'2017-05-16 10:28:52','2017-05-16 10:28:52'),(15,2,43,'g87m6ym4',20.00,'credit_card',1,'2017-05-16 10:31:35','2017-05-16 10:31:35'),(16,2,42,'2tdsp7kw',20.00,'credit_card',1,'2017-05-16 10:36:21','2017-05-16 10:36:21'),(17,2,11,'7z41vgzs',40.00,'credit_card',1,'2017-05-16 15:09:59','2017-05-16 15:09:59'),(18,2,53,'cewqm79x',20.00,'credit_card',1,'2017-05-17 09:20:39','2017-05-17 09:20:39'),(19,2,51,'j0e0h4t1',23.00,'credit_card',1,'2017-05-17 11:36:32','2017-05-17 11:36:32');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persistences`
--

DROP TABLE IF EXISTS `persistences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persistences`
--

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` VALUES (129,1,'Mp16NaFd4SN9AZ3DUZ3uqbanoQcANmlu','2017-05-17 10:30:09','2017-05-17 10:30:09'),(130,1,'IZnUY1f5veBnCtOXmPUhPgZhGSn7Gdm9','2017-05-17 10:31:08','2017-05-17 10:31:08'),(152,2,'wQXkWtfzM2hzHPDOMlli8ylLTikQkOJk','2017-05-22 12:26:01','2017-05-22 12:26:01');
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_size` (
  `product_id` int(10) unsigned NOT NULL,
  `size_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `product_size_size_id_foreign` (`size_id`),
  CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_size`
--

LOCK TABLES `product_size` WRITE;
/*!40000 ALTER TABLE `product_size` DISABLE KEYS */;
INSERT INTO `product_size` VALUES (4,1),(4,2),(3,5),(5,5),(5,6),(1,9),(2,9),(1,10),(2,10);
/*!40000 ALTER TABLE `product_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Deluxe Business Card','Deluxe',20.00,1,'2017-04-25 09:52:02','2017-04-25 09:52:02'),(2,'Standard Business Cards','Standard',20.00,1,'2017-04-25 09:52:14','2017-04-25 09:52:14'),(3,'A4 Leaflets - 16 pages','This i sa test',20.00,3,'2017-04-25 09:52:31','2017-04-25 09:52:31'),(4,'Deluxe Poster','TEst',23.00,2,'2017-04-25 09:52:47','2017-04-25 09:52:47'),(5,'Small Flyers','Small Flyers',20.00,4,'2017-04-25 09:56:26','2017-04-25 09:56:26');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_approvals`
--

DROP TABLE IF EXISTS `quote_approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `token` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_approvals_user_id_foreign` (`user_id`),
  KEY `quote_approvals_order_id_foreign` (`order_id`),
  CONSTRAINT `quote_approvals_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `quote_approvals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_approvals`
--

LOCK TABLES `quote_approvals` WRITE;
/*!40000 ALTER TABLE `quote_approvals` DISABLE KEYS */;
INSERT INTO `quote_approvals` VALUES (7,2,11,'GP1syPodh40eCHF4',1,'2017-05-09 08:21:01','2017-05-16 11:45:22'),(8,2,12,'h9EPmDOZQWwYUmgm',1,'2017-05-09 08:21:35','2017-05-17 09:20:12'),(9,3,13,'SOuCv4SbLHI4XbbC',0,'2017-05-09 09:31:49','2017-05-09 10:28:33'),(10,2,14,'dkMi6LKEsLbiVpyZ',0,'2017-05-10 08:47:49','2017-05-10 09:53:04'),(11,2,15,'gGVxeVQMdoMWVTSP',0,'2017-05-10 10:49:33','2017-05-10 10:49:33'),(12,3,16,'83YAAmDbh8mbEw6G',0,'2017-05-11 08:49:19','2017-05-11 08:49:19'),(13,3,17,'tOtzjxiZjMT2tKG1',0,'2017-05-11 08:49:32','2017-05-11 08:49:32'),(14,1,18,'p6SAuNFkOEj6MUIB',0,'2017-05-11 08:49:55','2017-05-11 08:49:55'),(15,2,19,'6Tz2JUfU8BBfTQZ3',0,'2017-05-11 13:23:59','2017-05-11 13:23:59'),(16,2,22,'MflmGBb2oSzBItpT',1,'2017-05-11 15:01:32','2017-05-13 11:41:10'),(17,1,23,'6Z8GTMcjGVoPrs5A',0,'2017-05-11 15:23:34','2017-05-11 15:23:34'),(18,2,26,'dgYZAfjke2ikTQcr',1,'2017-05-11 15:25:46','2017-05-15 13:28:41'),(19,2,27,'QkcrZHtnMEFZpmcS',1,'2017-05-11 15:26:50','2017-05-15 18:58:44'),(20,1,28,'NESPfhZ0eTZCAaVT',0,'2017-05-11 17:26:13','2017-05-11 17:26:13'),(21,2,29,'gItI1lGIaWFQGRip',1,'2017-05-11 17:27:41','2017-05-15 14:07:47'),(22,2,42,'Iv7aYWpa55KcLruA',1,'2017-05-15 11:51:24','2017-05-15 14:07:58'),(23,2,43,'04YiIvNBZfZE5a77',1,'2017-05-15 11:51:31','2017-05-15 11:51:51'),(24,2,44,'Yck5WTDhkHrRkFaE',1,'2017-05-15 18:59:43','2017-05-16 09:04:27'),(25,1,45,'Dlo8exnC7WHr7pmO',0,'2017-05-16 09:17:09','2017-05-16 09:17:09'),(26,2,46,'7eG5N9ErDGaGBVGk',0,'2017-05-16 13:10:15','2017-05-16 13:10:15'),(27,13,47,'z6opOpMBD0Jv6lsL',0,'2017-05-17 07:09:47','2017-05-17 07:10:17'),(28,6,48,'bTCooEKwYRCHy7fX',0,'2017-05-17 07:21:53','2017-05-17 07:21:53'),(29,2,49,'brNXPPXc7qbdaOOV',0,'2017-05-17 07:35:52','2017-05-17 07:35:52'),(30,2,50,'xPqr7AiMDmctz3I8',0,'2017-05-17 07:50:49','2017-05-17 07:50:49'),(31,2,51,'zAe9WFkkc0ujTUs4',1,'2017-05-17 07:51:01','2017-05-17 11:36:10'),(32,2,52,'6GpEJTgkN3iW5Om8',0,'2017-05-17 07:51:26','2017-05-17 07:51:26'),(33,2,53,'PriVGVk0sjDayX7Y',1,'2017-05-17 07:52:01','2017-05-17 09:20:20'),(34,2,54,'SaRXEMzruEeJfB8A',0,'2017-05-17 07:52:37','2017-05-17 07:52:37'),(35,4,55,'FMj0pmBjV2OAiVp7',0,'2017-05-22 10:27:33','2017-05-22 10:27:33');
/*!40000 ALTER TABLE `quote_approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_rejections`
--

DROP TABLE IF EXISTS `quote_rejections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_rejections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_rejections_order_id_foreign` (`order_id`),
  CONSTRAINT `quote_rejections_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_rejections`
--

LOCK TABLES `quote_rejections` WRITE;
/*!40000 ALTER TABLE `quote_rejections` DISABLE KEYS */;
INSERT INTO `quote_rejections` VALUES (4,14,'Rubbish','2017-05-10 11:12:34','2017-05-10 11:12:34'),(6,15,'Really?','2017-05-10 11:14:01','2017-05-10 11:14:01'),(7,54,'It\'s a little bit expensive','2017-05-17 07:53:27','2017-05-17 07:53:27'),(8,46,'Wasn\'t really what I asked for','2017-05-17 07:53:42','2017-05-17 07:53:42');
/*!40000 ALTER TABLE `quote_rejections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (2,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(3,1,'2017-05-22 11:10:04','2017-05-22 11:10:04'),(3,4,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(4,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(5,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(6,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(7,4,'2017-05-10 16:28:49','2017-05-10 16:28:49'),(8,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(9,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(10,3,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(11,1,'2017-05-08 12:30:02','2017-05-08 12:30:02'),(11,4,'2017-05-10 17:33:01','2017-05-10 17:33:01'),(12,3,'2017-05-09 12:07:28','2017-05-09 12:07:28'),(13,3,'2017-05-17 07:07:56','2017-05-17 07:07:56');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrators',NULL,'2017-05-08 12:30:02',NULL),(2,'accounts','Accounts',NULL,'2017-05-08 12:30:02',NULL),(3,'customer','Customers',NULL,'2017-05-08 12:30:02',NULL),(4,'staff','Staff',NULL,'2017-05-10 17:26:25',NULL),(5,'artwork','Artworkers',NULL,'2017-05-17 10:00:09',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sizes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'A0',1188,840,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(2,'A1',840,594,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(3,'A2',594,420,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(4,'A3',420,297,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(5,'A4',297,210,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(6,'A5',210,148,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(7,'A6',148,105,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(8,'A7',105,74,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(9,'Business Card (85 x 55)',85,55,'2017-03-21 07:41:47','2017-03-21 07:41:47'),(10,'Business Card (90 x 55)',90,55,'2017-03-21 07:41:47','2017-03-21 07:41:47');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'quote','2017-03-21 09:43:18','2017-03-21 09:43:18'),(2,'order','2017-03-21 09:43:18','2017-03-21 09:43:18'),(3,'invoice','2017-03-21 09:43:18','2017-03-21 09:43:18'),(4,'cancelled','2017-05-10 12:02:52','2017-05-10 12:02:52');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'justice.beer@example.org','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-17 10:31:08','Davon','Rice','2017-05-08 12:30:02','2017-05-17 10:31:08'),(2,'qabaket@duck2.club','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-22 12:26:01','Adolph','Will','2017-05-08 12:30:02','2017-05-22 12:26:01'),(3,'athena.vandervort@example.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-09 10:07:26','Amara','Ratke','2017-05-08 12:30:02','2017-05-09 10:07:26'),(4,'xgrady@example.net','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,NULL,'Miles','Abbott','2017-05-08 12:30:02','2017-05-08 12:30:02'),(5,'xtreutel@example.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,NULL,'Bryce','Lakin','2017-05-08 12:30:02','2017-05-08 12:30:02'),(6,'aditya05@example.net','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-17 07:31:13','Kamren','Goodwin','2017-05-08 12:30:02','2017-05-17 07:31:13'),(7,'pearline85@example.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-17 06:53:04','Nels','Langworth','2017-05-08 12:30:02','2017-05-17 06:53:04'),(8,'rtreutel@example.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,NULL,'Doyle','Schneider','2017-05-08 12:30:02','2017-05-08 12:30:02'),(9,'kshlerin.vallie@example.org','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,NULL,'Ottilie','Grimes','2017-05-08 12:30:02','2017-05-08 12:30:02'),(10,'igerhold@example.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-08 12:39:20','Keagan','Medhurst','2017-05-08 12:30:02','2017-05-08 12:39:20'),(11,'chris@connor.com','$2y$10$23uaDbGuBFagfNunnYNzPuY9TQnUAP62n.1gCjS5N66TNdATLw7LW',NULL,NULL,'2017-05-22 12:15:07','Chris','Connor','2017-05-08 12:30:02','2017-05-22 12:15:07'),(12,'muzu@nada.ltd','$2y$10$TlCenaMA2oVadE2XJpSlVez/FnZ0qvbTIuovu3eHnjxSHgaEiHNwG',NULL,NULL,'2017-05-09 12:08:21','Peter','Parker','2017-05-09 12:07:28','2017-05-09 12:08:21'),(13,'bob@bobbybrown.com','$2y$10$SAqj9o0ynvFZIHqTR2LszugMOYlLzwOhbTlAG3IfN1.5Y.Sqp9viC',NULL,NULL,'2017-05-17 07:10:16','Bobby','Brown','2017-05-17 07:07:56','2017-05-17 07:10:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-22 15:04:19
