/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 8.0.31 : Database - petrol_bunk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`petrol_bunk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `petrol_bunk`;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2024_02_09_130049_create_product_types_table',1),
(6,'2024_02_09_130110_create_petrol_pumbs_table',1),
(7,'2024_02_09_132256_create_product_purchases_table',1),
(8,'2024_02_09_132325_create_pumb_product_types_table',1),
(10,'2024_02_14_142452_create_product_by_prices_table',2),
(11,'2024_02_09_132348_create_product_per_unit_prices_table',3),
(16,'2024_02_16_025818_create_sales_table',4);

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

/*Table structure for table `petrol_pumbs` */

DROP TABLE IF EXISTS `petrol_pumbs`;

CREATE TABLE `petrol_pumbs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pumb_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `petrol_pumbs` */

insert  into `petrol_pumbs`(`id`,`pumb_name`,`created_at`,`updated_at`) values 
(1,'Petrol',NULL,'2024-02-14 17:16:59'),
(3,'Diesel','2024-02-13 10:39:28','2024-02-14 17:17:10'),
(4,'Gasoline','2024-02-14 17:17:21','2024-02-14 17:17:21');

/*Table structure for table `product_by_prices` */

DROP TABLE IF EXISTS `product_by_prices`;

CREATE TABLE `product_by_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` bigint unsigned DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_by_prices_product_type_id_index` (`product_type_id`),
  CONSTRAINT `product_by_prices_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_by_prices` */

/*Table structure for table `product_per_unit_prices` */

DROP TABLE IF EXISTS `product_per_unit_prices`;

CREATE TABLE `product_per_unit_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` bigint unsigned DEFAULT NULL,
  `unit_id` bigint unsigned DEFAULT NULL,
  `pump_id` bigint unsigned DEFAULT NULL,
  `purchase_amount_id` bigint unsigned DEFAULT NULL,
  `price_for_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mrp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_per_unit_prices_product_type_id_index` (`product_type_id`),
  KEY `product_per_unit_prices_unit_id_index` (`unit_id`),
  KEY `product_per_unit_prices_purchase_amount_id_index` (`purchase_amount_id`),
  KEY `pump_id` (`pump_id`),
  CONSTRAINT `product_per_unit_prices_ibfk_1` FOREIGN KEY (`pump_id`) REFERENCES `petrol_pumbs` (`id`),
  CONSTRAINT `product_per_unit_prices_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_per_unit_prices_purchase_amount_id_foreign` FOREIGN KEY (`purchase_amount_id`) REFERENCES `product_purchases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_per_unit_prices_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `product_purchases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_per_unit_prices` */

insert  into `product_per_unit_prices`(`id`,`product_type_id`,`unit_id`,`pump_id`,`purchase_amount_id`,`price_for_unit`,`mrp`,`created_at`,`updated_at`) values 
(22,55,6,1,6,'100.00','1000','2024-02-18 10:02:21','2024-02-19 05:32:47'),
(23,57,6,1,7,'100.00','150','2024-02-19 05:33:10','2024-02-19 05:33:10'),
(24,58,6,3,6,'100.00','200','2024-02-19 05:33:29','2024-02-19 05:33:29'),
(25,59,7,4,6,'100.00','120','2024-02-19 05:33:50','2024-02-19 05:33:50');

/*Table structure for table `product_purchases` */

DROP TABLE IF EXISTS `product_purchases`;

CREATE TABLE `product_purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` bigint unsigned DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_purchases_product_type_id_index` (`product_type_id`),
  CONSTRAINT `product_purchases_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_purchases` */

insert  into `product_purchases`(`id`,`product_type_id`,`qty`,`purchase_amount`,`supplier_name`,`created_at`,`updated_at`) values 
(6,55,'1000','100000','Nisharu','2024-02-14 17:15:59','2024-02-14 17:15:59'),
(7,57,'1000','100000','Kajan','2024-02-14 17:16:18','2024-02-14 17:16:18'),
(8,58,'200','100000','test','2024-02-14 17:16:35','2024-02-14 17:16:35');

/*Table structure for table `product_types` */

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_types` */

insert  into `product_types`(`id`,`product_type_name`,`created_at`,`updated_at`) values 
(55,'Petrol 92',NULL,'2024-02-13 05:57:40'),
(57,'Petrol 95','2024-02-13 05:57:13','2024-02-13 05:57:29'),
(58,'Diesel','2024-02-13 10:08:50','2024-02-13 10:08:50'),
(59,'Gasoline',NULL,NULL);

/*Table structure for table `pumb_product_types` */

DROP TABLE IF EXISTS `pumb_product_types`;

CREATE TABLE `pumb_product_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` bigint unsigned DEFAULT NULL,
  `pumb_id` bigint unsigned DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pumb_product_types_product_type_id_index` (`product_type_id`),
  KEY `pumb_product_types_pumb_id_index` (`pumb_id`),
  CONSTRAINT `pumb_product_types_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pumb_product_types_pumb_id_foreign` FOREIGN KEY (`pumb_id`) REFERENCES `petrol_pumbs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pumb_product_types` */

insert  into `pumb_product_types`(`id`,`product_type_id`,`pumb_id`,`price`,`created_at`,`updated_at`) values 
(42,58,3,NULL,'2024-02-13 17:34:19','2024-02-13 17:34:19'),
(46,55,1,NULL,'2024-02-13 17:45:13','2024-02-13 17:45:13'),
(60,57,1,NULL,'2024-02-14 16:53:06','2024-02-14 16:53:06'),
(61,59,4,NULL,'2024-02-18 12:17:30','2024-02-18 12:17:30');

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_type_id` bigint unsigned DEFAULT NULL,
  `pump_id` bigint unsigned DEFAULT NULL,
  `available_unit` bigint unsigned DEFAULT NULL,
  `sales_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_type_id` (`product_type_id`),
  KEY `pump_id` (`pump_id`),
  KEY `available_unit` (`available_unit`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `pumb_product_types` (`id`),
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`pump_id`) REFERENCES `petrol_pumbs` (`id`),
  CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`available_unit`) REFERENCES `product_purchases` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sales` */

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
