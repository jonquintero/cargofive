/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 8.0.30 : Database - cargofive
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cargofive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `cargofive`;

/*Table structure for table `calculation_types` */

DROP TABLE IF EXISTS `calculation_types`;

CREATE TABLE `calculation_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `calculation_types` */

insert  into `calculation_types`(`id`,`name`) values 
(1,'Per Container'),
(2,'Per BL');

/*Table structure for table `carriers` */

DROP TABLE IF EXISTS `carriers`;

CREATE TABLE `carriers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `carriers` */

insert  into `carriers`(`id`,`name`) values 
(1,'CMA CGM'),
(2,'MSC'),
(3,'COSCO'),
(4,'MAERSK'),
(5,'EVERGREEN'),
(6,'HAPAG LLOYD'),
(7,'ZIM'),
(8,'YML'),
(9,'SEALAND');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_07_14_140932_create_surcharges_table',2),
(6,'2023_07_14_141335_create_calculation_types_table',2),
(7,'2023_07_14_141355_create_carriers_table',2),
(8,'2023_07_14_141432_create_rates_table',2),
(10,'2023_07_15_192321_create_standard_surcharge_names_table',3),
(11,'2023_07_15_192322_add_standard_name_to_surcharges_table',4);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `rates` */

DROP TABLE IF EXISTS `rates`;

CREATE TABLE `rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `surcharge_id` bigint unsigned NOT NULL,
  `carrier_id` bigint unsigned NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surcharge_id_index` (`surcharge_id`),
  KEY `carrier_id_index` (`carrier_id`),
  CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`carrier_id`) REFERENCES `carriers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`surcharge_id`) REFERENCES `surcharges` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `rates` */

/*Table structure for table `standard_surcharge_names` */

DROP TABLE IF EXISTS `standard_surcharge_names`;

CREATE TABLE `standard_surcharge_names` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `standard_surcharge_names` */

/*Table structure for table `surcharges` */

DROP TABLE IF EXISTS `surcharges`;

CREATE TABLE `surcharges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `standard_surcharge_name_id` bigint unsigned DEFAULT NULL,
  `apply_to` enum('origin','freight','destination','') NOT NULL,
  `calculation_type_id` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calculation_type_id` (`calculation_type_id`),
  KEY `surcharges_standard_surcharge_name_id_foreign` (`standard_surcharge_name_id`),
  CONSTRAINT `surcharges_ibfk_1` FOREIGN KEY (`calculation_type_id`) REFERENCES `calculation_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surcharges_standard_surcharge_name_id_foreign` FOREIGN KEY (`standard_surcharge_name_id`) REFERENCES `standard_surcharge_names` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `surcharges` */

insert  into `surcharges`(`id`,`name`,`standard_surcharge_name_id`,`apply_to`,`calculation_type_id`,`created_at`,`updated_at`) values 
(1,'Winter Surcharge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(2,'Winter charge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(3,'BL',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(4,'BL Fee',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(5,'B/L fee',NULL,'origin',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(6,'Doc fee',NULL,'origin',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(7,'Doc fees',NULL,'origin',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(8,'Documentation Fee',NULL,'origin',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(9,'LOG FEE ',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(10,'LOGISTICS FEE ',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(11,'Arbitrary Charge Destination',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(12,'Arbitrary Charge Origin',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(13,'Arbitrary Charge O',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(14,'Arbitrary Charge D',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(15,'Bunker Adjustment Fee',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(16,'Bunker Adjustment Factor',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(17,'Bunker Adjustment Charge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(18,'BAF',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(19,'Basic Freight',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(20,'Basic Ocean Freight',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(21,'Ocean Freight Charge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:16'),
(22,'Ocean Freight',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(23,'Bill of Lading (BL)',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(24,'Booking fee',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(25,'Booking Service Charge',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(26,'Booking Charge',NULL,'freight',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(27,'Cesion transporte',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(28,'Cesion Tte',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(29,'Cesion',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(30,'VGM',NULL,'origin',1,'2023-06-06 16:01:49','2023-07-19 19:13:17'),
(31,'VGM Fee',NULL,'destination',1,'2023-06-06 16:01:49','2023-07-19 19:13:17'),
(32,'Terminal Handling',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(33,'Terminal Handling charge',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(34,'Terminal Handling Charge O',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(35,'Terminal Handling Charge Origin',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(36,'Terminal Handling Charge Destination',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(37,'Terminal Handling Charge (D)',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(38,'Terminal fees',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(39,'Tasa T3',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(40,'T-3',NULL,'origin',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(41,'T3',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(42,'T3 fee',NULL,'destination',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(43,'Peak Season Surcharge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(44,'PSS',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(45,'Peak Season Adjustment Factor ',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(46,'Port Charges Import',NULL,'destination',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(47,'Port Charges Export',NULL,'origin',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(48,'Port Charges Destination',NULL,'destination',2,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(49,'Overweight',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(50,'Overweight surcharge',NULL,'freight',1,'2023-06-05 16:30:00','2023-07-19 19:13:17'),
(51,'ISPS',NULL,'freight',1,'2023-06-06 16:01:49','2023-07-19 19:13:17'),
(52,'ISPS',NULL,'freight',1,'2023-06-06 16:01:49','2023-07-19 19:13:17');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
