CREATE DATABASE IF NOT EXISTS `horizon_resto`;

USE `horizon_resto`;

CREATE TABLE IF NOT EXISTS `level` (
    `id` TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` ENUM('Administrator', 'Owner', 'Cashier', 'Waiter', 'Guest') NOT NULL UNIQUE DEFAULT 'Guest',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE DEFAULT 'who',
    `e_mail` VARCHAR(50) NOT NULL DEFAULT 'who@gmail.com',
    `password` VARCHAR(50) NOT NULL DEFAULT 'what',
    `name` VARCHAR(50) NOT NULL DEFAULT 'No Name',
    `level_id` TINYINT(1) UNSIGNED NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`level_id`) REFERENCES `level`(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `order` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `table_number` TINYINT(2) UNSIGNED NOT NULL DEFAULT 1,
    `message` VARCHAR(255) NOT NULL DEFAULT 'No message given.',
    `status` ENUM('Plan', 'Cancelled', 'Done') NOT NULL DEFAULT 'Plan',
    `fee` INT(6) UNSIGNED NOT NULL DEFAULT 100000,
    `reservation_date` DATE NOT NULL DEFAULT '2018-01-01',
    `reservation_time` TIME NOT NULL DEFAULT '12:00',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `transaction` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `order_id` INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY(`order_id`) REFERENCES `order`(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cuisine` (
    `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT 'No Description',
    `preview` VARCHAR(12) NOT NULL DEFAULT 'menu-1.jpg',
    `price` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 10000,
    `status` ENUM('In Stock', 'Sold Out') NOT NULL DEFAULT 'In Stock',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `order_detail` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` INT(11) UNSIGNED NOT NULL,
    `cuisine_id` TINYINT(3) UNSIGNED NOT NULL,
    `number` TINYINT(2) UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`order_id`) REFERENCES `order`(`id`),
    FOREIGN KEY(`cuisine_id`) REFERENCES `cuisine`(`id`)
) ENGINE = InnoDB;

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\level.csv' IGNORE INTO TABLE `level`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\user.csv' IGNORE INTO TABLE `user`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\order.csv' IGNORE INTO TABLE `order`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\transaction.csv' IGNORE INTO TABLE `transaction`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\cuisine.csv' IGNORE INTO TABLE `cuisine`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';

LOAD DATA INFILE 'C:\\xampp\\htdocs\\horizon-resto\\database\\csv\\order_detail.csv' IGNORE INTO TABLE `order_detail`
    FIELDS TERMINATED BY ','
        ENCLOSED BY '\''
        ESCAPED BY '\\'
    LINES TERMINATED BY '\r\n';
