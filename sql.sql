/*
SQLyog Community v13.1.1 (32 bit)
MySQL - 10.1.38-MariaDB : Database - computer_store
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`computer_store` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `computer_store`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `level` int(11) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`fullname`,`address`,`email`,`mobile`,`birthday`,`gender`,`image`,`level`,`last_login_time`,`created_at`,`updated_at`) values
(1,'admin','$2y$10$FolXMf1nawPzhAySqk4EHuh1uF/fdtptoZCtNe4pOQFeVEaxnaqmG','tungvodoi','123 xuan dinh','admin@gmail.com','0345220249','2019-05-04 00:00:00',2,'/files/image/76838844_image.png',1,1559035007,NULL,'2019-05-28 09:16:47'),
(3,'tungvodoi','$2y$10$1IR5IM.9wZacePTuD3rq1e1fboDf9a4s6r1CWu90kd6FILyqKWy9a','Sơn Tùng Kiều','123 xuan dinh','test@gmail.com','0345220249','2019-05-28 00:00:00',1,'/files/image/3_image.png',2,1559037624,'2019-05-28 09:29:43','2019-05-28 10:03:12'),
(4,'test@gmail.com','$2y$10$zq06yCZ6nB.NxdUobHYp3u5SiT.yjJrvwNExv6EaG6gmIQ0Z6pUVS',NULL,NULL,'test@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,'2019-05-28 09:39:52','2019-05-28 09:39:52'),
(5,'hoangthangdt2@yahoo.com','$2y$10$y.I5yt8VqJju0NAd2m5NNOfEtaAxWeAn/k/lq3150OeFyk0vylgee',NULL,NULL,'test@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,'2019-05-28 09:42:02','2019-05-28 09:42:02');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `cat_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL COMMENT 'bao hanh',
  `start_date` date DEFAULT NULL,
  `RAM` text COLLATE utf8_unicode_ci,
  `HDD` text COLLATE utf8_unicode_ci,
  `is_new` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


CREATE TABLE `khuyenmai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `sale` float DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `khuyenmai_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci