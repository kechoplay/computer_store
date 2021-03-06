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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tintuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sort_description` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `chitiethoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT 'id hóa đơn',
  `product_id` int(11) DEFAULT NULL COMMENT 'id sản phẩm',
  `quantity` int(11) DEFAULT NULL COMMENT 'số lượng mua',
  `price` float DEFAULT NULL COMMENT 'đơn giá',
  `sale` int(11) DEFAULT NULL COMMENT 'giảm giá',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `hoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_buy` datetime DEFAULT NULL COMMENT 'thời gian mua',
  `customer_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên khách hàng',
  `phone` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'số điện thoại',
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'email',
  `address` text COLLATE utf8_unicode_ci COMMENT 'địa chỉ giao hàng',
  `note` text COLLATE utf8_unicode_ci COMMENT 'ghi chú',
  `payment_method` int(11) DEFAULT NULL COMMENT '1: COD; 2: online',
  `status` int(11) DEFAULT NULL COMMENT 'trạng thái giao dịch. 1: Chưa xử lý; 2: Đã xử lý; 3: Đã giao; 4: Đã hủy',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `phieubaohanh` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `order_id` int(11) DEFAULT NULL COMMENT 'id hóa đơn',
    `user_id` int(11) DEFAULT NULL COMMENT 'id khách hàng',
    `product_id` int(11) DEFAULT NULL COMMENT 'id sản phẩm',
    `customer_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'tên khách hàng',
    `phone` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'số điện thoại',
    `buy_date` datetime DEFAULT NULL COMMENT 'ngày mua',
    `warranty` int(11) DEFAULT NULL COMMENT 'thời hạn bảo hành',
    `created_at` datetime NOT NULL,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `phanhoi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `nhacungcap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supply_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supply_address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supply_mail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supply_phone` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `hinhthucthanhtoan` (
                                     `id` int(11) NOT NULL AUTO_INCREMENT,
                                     `payment_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
                                     `created_at` datetime DEFAULT NULL,
                                     `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;