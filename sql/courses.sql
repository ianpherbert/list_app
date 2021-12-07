DROP DATABASE IF EXISTS `courses`;
CREATE DATABASE `courses`;
USE `courses`;
SET NAMES utf8;
SET character_set_client = utf8mb4;
CREATE TABLE `lists`(
    `list_id` int(6) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(15) NOT NULL,
    `date` DATETIME NOT NULL,
    PRIMARY KEY (`list_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1;
CREATE TABLE `items`(
    `item_id` int(6) NOT NULL AUTO_INCREMENT,
    `item` varchar(50) NOT NULL,
    `quantity` INT(3) NOT NULL,
    `list_id` int(6) NOT NULL,
    PRIMARY KEY (`item_id`),
    KEY `FK_list_id` (`list_id`),
    CONSTRAINT `FK_list_id` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1;