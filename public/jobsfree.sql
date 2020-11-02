# Host: localhost  (Version 5.5.5-10.4.11-MariaDB)
# Date: 2020-11-02 18:46:30
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categories"
#

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "categories"
#

INSERT INTO `categories` VALUES (1,'LOGO'),(2,'GAME CHARACTER'),(3,'MOCKUP DESIGN'),(4,'ILLUSTRATION');

#
# Structure for table "roles"
#

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "roles"
#

INSERT INTO `roles` VALUES (1,'BUYYER'),(2,'SELLER');

#
# Structure for table "users"
#

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(16) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  `phone_no` varchar(16) DEFAULT NULL,
  `idcard_no` varchar(16) DEFAULT NULL,
  `phone_with_card` varchar(255) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `update_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,1,'garox','garox@gamil.com','123','garox.png','098765','1','08216950020',NULL,NULL),(2,2,'budi setiawan','budi@gmail.com','123','budi.png','082169506727','1','082169506727',NULL,NULL);

#
# Structure for table "lapak"
#

CREATE TABLE `lapak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `requirement` text DEFAULT NULL,
  `price_tag` int(2) DEFAULT NULL,
  `working_hours` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_fk` (`category_id`),
  CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "lapak"
#

INSERT INTO `lapak` VALUES (3,2,1,'desain',NULL,NULL,20000,NULL,NULL,NULL),(4,2,2,'desain2',NULL,NULL,NULL,NULL,NULL,NULL),(6,2,2,'desain','none','none',20000,20,'ok',NULL),(7,2,2,'desain','none','none',20000,20,'ok',NULL);

#
# Structure for table "transactions"
#

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lapak_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) NOT NULL DEFAULT 0,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `payment_date` int(11) DEFAULT NULL,
  `payment_via` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lapak_id` (`lapak_id`),
  KEY `client_fk` (`client_id`),
  KEY `freelancer_fk` (`freelancer_id`),
  CONSTRAINT `client_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  CONSTRAINT `freelancer_fk` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lapak_fk` FOREIGN KEY (`lapak_id`) REFERENCES `lapak` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "transactions"
#

