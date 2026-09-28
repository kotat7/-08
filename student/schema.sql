-- Схема базы данных coffee_suppliers
CREATE DATABASE IF NOT EXISTS coffee_suppliers CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE coffee_suppliers;

-- Таблица пользователей
CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,          -- password_hash() из PHP
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Таблица поставщиков
CREATE TABLE IF NOT EXISTS suppliers (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(150) NOT NULL,         -- обязательное поле
    contact_person VARCHAR(120) DEFAULT NULL,
    phone          VARCHAR(30)  DEFAULT NULL,
    user_id        INT UNSIGNED NOT NULL,         -- кто создал запись
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_suppliers_user FOREIGN KEY (user_id)
        REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
