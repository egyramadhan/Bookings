/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.8-MariaDB : Database - bookings
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bookings` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bookings`;

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(11) NOT NULL,
  `client_name` varchar(191) DEFAULT NULL,
  `client_email` varchar(191) DEFAULT NULL,
  `client_phone` varchar(191) DEFAULT NULL,
  `code_booking` varchar(8) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time_start` time DEFAULT NULL,
  `booking_time_end` time DEFAULT NULL,
  `booking_description` text DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `review_title` varchar(191) DEFAULT NULL,
  `review_description` text DEFAULT NULL,
  `review_provider_answer` text DEFAULT NULL,
  `review_created_at` datetime DEFAULT NULL,
  `status_id` int(1) DEFAULT NULL,
  `is_discount` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`code_booking`),
  KEY `fk_services_2` (`service_id`),
  KEY `fk_status_2` (`status_id`),
  KEY `fk_provider_2` (`provider_id`),
  KEY `fk_location_1` (`location_id`),
  CONSTRAINT `fk_location_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `fk_provider_2` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`),
  CONSTRAINT `fk_services_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  CONSTRAINT `fk_status_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bookings` */

insert  into `bookings`(`id`,`client_id`,`client_name`,`client_email`,`client_phone`,`code_booking`,`booking_date`,`booking_time_start`,`booking_time_end`,`booking_description`,`service_id`,`provider_id`,`location_id`,`review_title`,`review_description`,`review_provider_answer`,`review_created_at`,`status_id`,`is_discount`,`created_at`,`updated_at`,`deleted_at`) values 
(2,'CPJ717','Tes','Rizalfrm3@gmail.com','0898989881','HW9092',NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,1,1,'2019-10-22 08:08:06','2019-10-22 08:08:06',NULL),
(3,'CPP800','testing','izal@izal.com','0878367223','LC1729',NULL,NULL,NULL,NULL,10,1,3,'test review','wdwadwa wafawgfwageaweh','efehfeafhea',NULL,2,1,'2019-10-25 10:56:33',NULL,NULL),
(4,'CTH123','bobo','a@a.com','0877281919','HTDSK2',NULL,NULL,NULL,NULL,1,1,1,'afeagfeg','agesagaesg','waffwaf',NULL,3,1,'2019-10-25 16:01:51',NULL,NULL);

/*Table structure for table `days` */

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days` varchar(191) NOT NULL,
  `is_working_days` int(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_days_1` FOREIGN KEY (`id`) REFERENCES `provider_has_days` (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `days` */

insert  into `days`(`id`,`days`,`is_working_days`,`created_at`,`updated_at`) values 
(1,'10',1,'2019-10-23 14:14:08','2019-10-24 09:33:41');

/*Table structure for table `days_has_times` */

DROP TABLE IF EXISTS `days_has_times`;

CREATE TABLE `days_has_times` (
  `day_id` int(11) NOT NULL,
  `times_id` int(11) NOT NULL,
  `enable_day_times` int(1) DEFAULT 0,
  PRIMARY KEY (`day_id`,`times_id`),
  KEY `fk_times` (`times_id`),
  CONSTRAINT `fk_days` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`),
  CONSTRAINT `fk_times` FOREIGN KEY (`times_id`) REFERENCES `times` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `days_has_times` */

insert  into `days_has_times`(`day_id`,`times_id`,`enable_day_times`) values 
(1,1,0);

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `invoice_number` varchar(191) NOT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `payment_status_id` int(1) NOT NULL,
  `payment_start_date` datetime DEFAULT NULL,
  `payment_due_date` datetime DEFAULT NULL,
  `payment_accept_time` datetime DEFAULT NULL,
  `payment_processor_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`invoice_number`),
  KEY `fk_booking_2` (`booking_id`),
  KEY `fk_payment_processors` (`payment_processor_id`),
  KEY `fk_payment_status` (`payment_status_id`),
  CONSTRAINT `fk_booking_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_payment_processors` FOREIGN KEY (`payment_processor_id`) REFERENCES `payment_processors` (`id`),
  CONSTRAINT `fk_payment_status` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`booking_id`,`invoice_number`,`amount`,`payment_status_id`,`payment_start_date`,`payment_due_date`,`payment_accept_time`,`payment_processor_id`,`description`,`created_at`,`updated_at`) values 
(2,2,'5353535',600000.00,1,'2019-10-24 10:25:40','2019-10-24 13:25:42','2019-10-24 10:25:47',1,'afwaf wa','2019-10-24 10:26:00',NULL),
(5,4,'4643643',70000.00,2,'2019-10-25 14:10:35','2019-10-25 14:10:38','2019-10-25 14:10:46',2,'dawdwafwa','2019-10-25 16:20:35',NULL),
(6,3,'235436432',700000.00,3,'2019-10-25 16:26:36','2019-10-25 16:26:38','2019-10-25 16:26:39',1,'fwefeawgfeaw','2019-10-25 16:35:51',NULL);

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(191) NOT NULL,
  `location_address` varchar(191) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`id`,`location_name`,`location_address`,`longitude`,`latitude`,`image_path`,`description`,`created_at`,`updated_at`) values 
(1,'Jakarta','Cilandak',-6.29131300,106.79980100,NULL,'Citos','2019-10-27 14:12:56',NULL),
(3,'Bandung','bandung',-6.29131300,106.79980100,NULL,'test','2019-10-28 14:12:54',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payment_processors` */

DROP TABLE IF EXISTS `payment_processors`;

CREATE TABLE `payment_processors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(191) NOT NULL,
  `payment_description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `payment_processors` */

insert  into `payment_processors`(`id`,`payment_name`,`payment_description`,`created_at`,`updated_at`) values 
(1,'booking','booking meeting','2019-10-24 10:22:18','2019-10-24 10:22:09'),
(2,'pembayaran','move on','2019-10-25 03:51:14','2019-10-25 03:53:23');

/*Table structure for table `payment_status` */

DROP TABLE IF EXISTS `payment_status`;

CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_status_name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `payment_status` */

insert  into `payment_status`(`id`,`payment_status_name`,`description`,`created_at`,`updated_at`) values 
(1,'paid','dwadkwadddf','2019-10-25 16:11:07','2019-10-25 03:19:15'),
(2,'unpaid','dwadkwad','2019-10-25 16:11:39','2019-10-25 03:17:47'),
(3,'cancelled','wafwagwag','2019-10-25 16:12:01','2019-10-25 16:12:03');

/*Table structure for table `provider_has_days` */

DROP TABLE IF EXISTS `provider_has_days`;

CREATE TABLE `provider_has_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `enable_provider_days` int(1) DEFAULT 0,
  PRIMARY KEY (`id`,`provider_id`),
  KEY `fk_days_2` (`day_id`),
  KEY `fk_provider_4` (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `provider_has_days` */

insert  into `provider_has_days`(`id`,`provider_id`,`day_id`,`enable_provider_days`) values 
(1,1,1,1);

/*Table structure for table `providers` */

DROP TABLE IF EXISTS `providers`;

CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` varchar(191) NOT NULL,
  `provider_email` varchar(191) NOT NULL,
  `provider_phone` varchar(191) DEFAULT NULL,
  `provider_status` int(1) DEFAULT 0,
  `is_visible_booking` int(1) DEFAULT 0,
  `client_at_same_time` int(11) DEFAULT 1,
  `provider_image_path` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_providers_2` FOREIGN KEY (`id`) REFERENCES `provider_has_days` (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `providers` */

insert  into `providers`(`id`,`provider_name`,`provider_email`,`provider_phone`,`provider_status`,`is_visible_booking`,`client_at_same_time`,`provider_image_path`,`description`,`created_at`,`updated_at`) values 
(1,'testi','b@b.com','087766292727',1,1,1,'tesstte','wfaw bawnahrawjn','2019-10-23 13:46:30','2019-10-24 08:44:08');

/*Table structure for table `service_has_providers` */

DROP TABLE IF EXISTS `service_has_providers`;

CREATE TABLE `service_has_providers` (
  `service_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  PRIMARY KEY (`service_id`,`provider_id`),
  KEY `fk_provider` (`provider_id`),
  CONSTRAINT `fk_provider` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_servicess` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `service_has_providers` */

insert  into `service_has_providers`(`service_id`,`provider_id`) values 
(1,1);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(191) NOT NULL,
  `service_price` double(10,2) DEFAULT NULL,
  `booking_time_interval` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_locations` (`location_id`),
  CONSTRAINT `fk_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `services` */

insert  into `services`(`id`,`service_name`,`service_price`,`booking_time_interval`,`location_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Konsultasid',900.00,2,1,'testestes','2019-10-23 04:39:46','2019-10-23 07:05:21',NULL),
(10,'tess',1000.00,1,3,'wefawfwa','2019-10-28 14:23:25',NULL,NULL);

/*Table structure for table `special_day_rules` */

DROP TABLE IF EXISTS `special_day_rules`;

CREATE TABLE `special_day_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days` varchar(191) NOT NULL,
  `special_days` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `special_day_rules` */

insert  into `special_day_rules`(`id`,`days`,`special_days`,`created_at`,`updated_at`) values 
(1,'15','2019-10-23','2019-10-24 17:14:38','2019-10-24 10:17:51'),
(2,'10','2019-10-23','2019-10-24 10:15:49','2019-10-24 10:15:49');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `status` */

insert  into `status`(`id`,`status`,`created_at`,`updated_at`) values 
(1,'paid','2019-10-23 14:20:30','2019-10-23 18:40:00'),
(2,'unpaid','2019-10-25 15:49:50',NULL),
(3,'paid','2019-10-25 15:56:00','2019-10-25 15:57:37'),
(4,'unpaid','2019-10-25 15:56:09',NULL);

/*Table structure for table `times` */

DROP TABLE IF EXISTS `times`;

CREATE TABLE `times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `times` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `times` */

insert  into `times`(`id`,`times`,`created_at`,`updated_at`) values 
(1,'00:01:01','2019-10-23 14:13:06','2019-10-24 09:16:30');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`client_id`,`personal_phone`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(4,'CPJ717','0898989881','Tes','Rizalfrm3@gmail.com',NULL,NULL,NULL,'2019-10-22 02:54:46','2019-10-22 02:54:46');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
