/*
 Navicat Premium Data Transfer

 Source Server         : OS
 Source Server Type    : MySQL
 Source Server Version : 100426 (10.4.26-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : sancdiweb

 Target Server Type    : MySQL
 Target Server Version : 100426 (10.4.26-MariaDB)
 File Encoding         : 65001

 Date: 03/05/2023 10:37:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(20, 0) NOT NULL,
  `weight` decimal(20, 0) NULL DEFAULT NULL,
  `size` int NULL DEFAULT NULL,
  `dimensions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sku`(`sku` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (15, '1245df', 'asd', 44, NULL, 700, NULL);
INSERT INTO `products` VALUES (16, 'book34', 'book23', 45, 2, NULL, NULL);
INSERT INTO `products` VALUES (17, 'fr234', 'fr', 789, NULL, NULL, '234,44,67');

SET FOREIGN_KEY_CHECKS = 1;
