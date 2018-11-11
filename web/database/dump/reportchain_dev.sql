/*
Navicat MySQL Data Transfer

Source Server         : localhost_3307
Source Server Version : 50722
Source Host           : localhost:3307
Source Database       : reportchain

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-11-09 21:20:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '0', '1', 'Tổng quan', 'fa-bar-chart', '/', null, '2018-10-29 21:13:50');
INSERT INTO `admin_menu` VALUES ('2', '0', '2', 'Admin', 'fa-tasks', '', null, null);
INSERT INTO `admin_menu` VALUES ('3', '2', '3', 'Users', 'fa-users', 'auth/users', null, null);
INSERT INTO `admin_menu` VALUES ('4', '2', '4', 'Roles', 'fa-user', 'auth/roles', null, null);
INSERT INTO `admin_menu` VALUES ('5', '2', '5', 'Permission', 'fa-ban', 'auth/permissions', null, null);
INSERT INTO `admin_menu` VALUES ('6', '2', '6', 'Menu', 'fa-bars', 'auth/menu', null, null);
INSERT INTO `admin_menu` VALUES ('8', '0', '8', 'Danh sách đã xử lý', 'fa-check', '/reports/completed', '2018-10-08 02:33:23', '2018-10-29 20:12:09');
INSERT INTO `admin_menu` VALUES ('9', '0', '7', 'Danh sách phản ánh', 'fa-file-text', '/reports', '2018-10-08 02:34:26', '2018-10-29 20:12:09');
INSERT INTO `admin_menu` VALUES ('10', '0', '9', 'Gửi phản ánh', 'fa-file-o', '/reports/create', '2018-10-08 02:35:42', '2018-10-29 20:12:09');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('1', 'All permission', '*', '', '*', null, null);
INSERT INTO `admin_permissions` VALUES ('2', 'Dashboard', 'dashboard', 'GET', '/', null, '2018-10-18 02:16:54');
INSERT INTO `admin_permissions` VALUES ('3', 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', null, null);
INSERT INTO `admin_permissions` VALUES ('4', 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', null, null);
INSERT INTO `admin_permissions` VALUES ('5', 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', null, null);
INSERT INTO `admin_permissions` VALUES ('6', 'Report', 'report', '', 'reports\r\nreports/*', '2018-10-16 01:07:44', '2018-10-18 09:05:41');
INSERT INTO `admin_permissions` VALUES ('7', 'Create Issue', 'create-issue', '', null, '2018-10-18 09:06:24', '2018-10-18 09:06:24');
INSERT INTO `admin_permissions` VALUES ('8', 'View My Issue', 'view-my-issue', '', null, '2018-10-18 09:06:51', '2018-10-18 09:06:51');
INSERT INTO `admin_permissions` VALUES ('9', 'View Agent Issue', 'view-agent-issue', '', null, '2018-10-18 09:07:16', '2018-10-18 09:07:16');
INSERT INTO `admin_permissions` VALUES ('10', 'View All Issue', 'view-all-issue', '', null, '2018-10-18 09:07:44', '2018-10-18 09:07:44');
INSERT INTO `admin_permissions` VALUES ('11', 'Update Issue', 'update-issue', '', null, '2018-10-18 09:08:00', '2018-10-18 09:08:00');

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES ('1', 'Administrator', 'administrator', '2018-10-08 09:18:03', '2018-10-08 09:18:03');
INSERT INTO `admin_roles` VALUES ('2', 'User', 'user', '2018-10-08 09:30:35', '2018-10-08 09:30:35');
INSERT INTO `admin_roles` VALUES ('3', 'Agent', 'agent', '2018-10-08 09:30:48', '2018-10-08 09:30:48');
INSERT INTO `admin_roles` VALUES ('4', 'Ministry', 'ministry', '2018-10-18 08:52:50', '2018-10-18 08:52:50');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES ('1', '2', null, null);
INSERT INTO `admin_role_menu` VALUES ('2', '8', null, null);
INSERT INTO `admin_role_menu` VALUES ('2', '9', null, null);
INSERT INTO `admin_role_menu` VALUES ('3', '9', null, null);
INSERT INTO `admin_role_menu` VALUES ('2', '10', null, null);
INSERT INTO `admin_role_menu` VALUES ('4', '9', null, null);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES ('1', '1', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '2', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '3', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '4', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '2', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '3', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '4', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '6', null, null);
INSERT INTO `admin_role_permissions` VALUES ('4', '2', null, null);
INSERT INTO `admin_role_permissions` VALUES ('4', '3', null, null);
INSERT INTO `admin_role_permissions` VALUES ('4', '4', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '6', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '9', null, null);
INSERT INTO `admin_role_permissions` VALUES ('3', '11', null, null);
INSERT INTO `admin_role_permissions` VALUES ('4', '6', null, null);
INSERT INTO `admin_role_permissions` VALUES ('4', '10', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '7', null, null);
INSERT INTO `admin_role_permissions` VALUES ('2', '8', null, null);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES ('1', '1', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '3', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '4', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '5', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '6', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '7', null, null);
INSERT INTO `admin_role_users` VALUES ('3', '10', null, null);
INSERT INTO `admin_role_users` VALUES ('4', '11', null, null);
INSERT INTO `admin_role_users` VALUES ('0', '11', null, null);
INSERT INTO `admin_role_users` VALUES ('2', '2', null, null);
INSERT INTO `admin_role_users` VALUES ('0', '2', null, null);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefecture_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'admin', '$2y$10$l6E./eyX1xPRr4K.ZWFypu1M8c20NCHVilTuVlPVtgOoDhPjgUwAe', 'Administrator', null, 'X1OSJeQ6X9fSZdJTu7B28dnim92DXH4M4PouA7Q1Pu2caJklLwK0tC1lRSQJ', '2018-10-08 09:18:02', '2018-10-08 09:18:02', null, null);
INSERT INTO `admin_users` VALUES ('2', 'user1', '$2y$10$ls.dgcbtwgumtergYiZ9zOngNXTqZyWbt4wFQwhR173njiUaL0Xxi', 'user1', null, 'TBho91dYbxou2vyp5DflcqcMwKhtPtNrt5mS7w3uk4ZXZZdITUZWaInyzXYl', '2018-10-16 01:06:14', '2018-11-06 01:36:19', null, null);
INSERT INTO `admin_users` VALUES ('3', 'user2', '$2y$10$ln5iKKiYfnX/p68Gvhakxuqg.KR5Mg90KEFCViln.5JUBAVh5F9BG', 'user2', null, null, '2018-10-17 03:44:38', '2018-10-17 03:44:38', 'test@mail.com', null);
INSERT INTO `admin_users` VALUES ('4', 'user3', '$2y$10$bnNiDu1xnlED0Ch6nfmyjOjt3Qk7T09sEnn7R2.op0ZrqrhISOCJe', 'user3', null, null, '2018-10-17 03:52:09', '2018-10-17 03:52:09', 'test3@mail.com', null);
INSERT INTO `admin_users` VALUES ('5', 'test5', '$2y$10$P5XyRtx6srP2B8l.zZ/vIOJSdUxvG5lB/enDtqEN6yRnTvM22kK3u', 'test5', null, null, '2018-10-17 03:52:59', '2018-10-17 03:52:59', 'test5@mail.com', null);
INSERT INTO `admin_users` VALUES ('6', 'user6', '$2y$10$qTUlrHBXr0K7srw6Nat/aOy7zjtqEof5WxJx9WOhITWpa4MZCjpCO', 'user6', null, 'EDavl8IygkjDCiXIDhDzk56YeyY16ufxu9O48syEwpIIX1JDkt2t8enJrtQE', '2018-10-17 03:53:59', '2018-10-17 03:53:59', 'test6@mail.com', null);
INSERT INTO `admin_users` VALUES ('7', 'user7', '$2y$10$7Wg1H5HF7mXY612BhU1.lOAiznw9SJh90JP761pgb0Rb/cMiXrv1O', 'user7', null, null, '2018-10-17 03:54:53', '2018-10-17 03:54:53', 'test7@mail.com', null);
INSERT INTO `admin_users` VALUES ('10', 'agent1', '$2y$10$NyCba87ahM4YvNZd0iy7F.vz9GybLCSOAZiDrTsI8HoVtJ4tGCiWC', 'agent1', null, 'kpUyOEQBCQfpXErkLLkxvySOBX1cpNBE0BxitjkUOvRBPAbRApgPSJ9AM3Fl', '2018-10-19 06:41:43', '2018-11-09 13:26:17', null, '1');
INSERT INTO `admin_users` VALUES ('11', 'ministry1', '$2y$10$HxERJTBekXzckJJMw6gBH.gjyrcHYU9ja9eHB9pTruAdncsotYxpa', 'Ministry1', null, 'IIaReWuE0TGQ5FND97Um8CScboUYeCVw4130Wioeweh19QTg4VrEP9UpPVdF', '2018-10-31 03:50:15', '2018-10-31 03:50:15', null, null);

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for issues
-- ----------------------------
DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `prefecture_id` tinyint(4) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `image_hash` varchar(100) DEFAULT NULL,
  `processor_id` int(11) DEFAULT NULL,
  `issuer_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: In process, 2: Resolved, 3: Reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of issues
-- ----------------------------
INSERT INTO `issues` VALUES ('1', 'a', 'a', '1', 'a', null, null, null, '2', '3', '2018-10-16 02:37:11', '2018-10-30 07:25:57');
INSERT INTO `issues` VALUES ('2', 'a', 'a', '2', 'test address', 'images/1.jpg', 'b41afa103ab4d9cd366c7c257e7430fd', null, '2', '2', '2018-10-16 04:34:11', '2018-10-16 04:34:11');
INSERT INTO `issues` VALUES ('3', 'a', 'a', '6', 'a', 'images/maket.jpg', '08bffbe839d3af3613faa20de41d7e58', null, '2', '0', '2018-10-16 07:06:02', '2018-10-16 07:06:02');
INSERT INTO `issues` VALUES ('4', 'a', 'a', '8', 'a', 'images/7b73aa0018e7654f32cf61424a4d861e.jpg', '17d5929ca152e92dab18ff5cc1ee0f02', null, '2', '0', '2018-10-16 07:19:31', '2018-10-16 07:19:31');
INSERT INTO `issues` VALUES ('5', '124', 'a', '4', 'a', 'images/0906294d2c3cc0c9201f6c7470a3c187.jpg', '17d5929ca152e92dab18ff5cc1ee0f02', null, '2', '0', '2018-10-31 02:38:48', '2018-10-31 02:38:48');
INSERT INTO `issues` VALUES ('6', 'test', '1', '1', '1', null, null, null, '3', '0', '2018-10-31 03:18:40', '2018-10-31 03:18:40');
INSERT INTO `issues` VALUES ('7', 'test', 'a', '1', '1', null, null, null, '2', '0', '2018-11-05 07:15:48', '2018-11-05 07:15:48');
INSERT INTO `issues` VALUES ('8', 'test', 'a', '1', '1', null, null, null, '2', '0', '2018-11-05 07:15:48', '2018-11-05 07:15:48');
INSERT INTO `issues` VALUES ('9', 'test', 'a', '1', '1', null, null, null, '2', '0', '2018-11-05 07:15:49', '2018-11-05 07:15:49');
INSERT INTO `issues` VALUES ('10', 'test', 'a', '1', '1', null, null, null, '2', '0', '2018-11-05 07:15:49', '2018-11-05 07:15:49');
INSERT INTO `issues` VALUES ('11', 'a', 'aaa', '1', 'a', null, null, null, '2', '0', '2018-11-09 02:59:16', '2018-11-09 02:59:16');
INSERT INTO `issues` VALUES ('12', 'test1', 'a', '2', 'a', null, null, null, '2', '0', '2018-11-09 02:59:36', '2018-11-09 02:59:36');
INSERT INTO `issues` VALUES ('13', 'test1', 'a', '2', 'a', null, null, null, '2', '0', '2018-11-09 02:59:36', '2018-11-09 02:59:36');
INSERT INTO `issues` VALUES ('14', 'test 3', 'aaa', '4', '1', null, null, null, '2', '0', '2018-11-09 03:00:03', '2018-11-09 03:00:03');
INSERT INTO `issues` VALUES ('15', 'test 3', 'aaa', '4', '1', null, null, null, '2', '0', '2018-11-09 03:00:03', '2018-11-09 03:00:03');
INSERT INTO `issues` VALUES ('16', 'a', 'a', '1', '1', null, null, null, '2', '0', '2018-11-09 03:00:32', '2018-11-09 03:00:32');
INSERT INTO `issues` VALUES ('17', 'a', 's', '6', 'a', null, null, null, '2', '0', '2018-11-09 03:00:49', '2018-11-09 03:00:49');
INSERT INTO `issues` VALUES ('18', 'a', 's', '6', 'a', null, null, null, '2', '0', '2018-11-09 03:00:49', '2018-11-09 03:00:49');
INSERT INTO `issues` VALUES ('19', 'a', 'test', '6', '1', null, null, null, '2', '0', '2018-11-09 03:01:16', '2018-11-09 03:01:16');
INSERT INTO `issues` VALUES ('20', 'a', 'a', '10', 'a', null, null, null, '2', '0', '2018-11-09 03:05:34', '2018-11-09 03:05:34');
INSERT INTO `issues` VALUES ('21', 'test', 'a', '2', '1', null, null, null, '2', '0', '2018-11-09 03:08:25', '2018-11-09 03:08:25');
INSERT INTO `issues` VALUES ('22', 'a', 'sfs', '8', 'a', null, null, null, '2', '0', '2018-11-09 03:08:37', '2018-11-09 03:08:37');
INSERT INTO `issues` VALUES ('23', 'a', 'a', '1', 'a', null, null, null, '2', '0', '2018-11-09 03:12:50', '2018-11-09 03:12:50');
INSERT INTO `issues` VALUES ('24', 'v', 'v', '26', 'v', null, null, null, '2', '0', '2018-11-09 03:12:59', '2018-11-09 03:12:59');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_01_04_173148_create_admin_tables', '1');
INSERT INTO `migrations` VALUES ('4', '2018_10_16_090025_add_email_to_admin_users', '2');
INSERT INTO `migrations` VALUES ('5', '2018_10_18_092312_modify_admin_users', '3');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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

-- ----------------------------
-- Records of users
-- ----------------------------
