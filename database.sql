CREATE DATABASE IF NOT EXISTS php_crud_application
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

USE php_crud_application;

CREATE TABLE `employees` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `designation` VARCHAR(100),
  PRIMARY KEY (`id`),
  UNIQUE (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
