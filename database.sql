-- =============================================
-- DATABASE SETUP — undangan_wisuda
-- Jalankan di phpMyAdmin atau MySQL CLI
-- =============================================

CREATE DATABASE IF NOT EXISTS undangan_wisuda
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE undangan_wisuda;

CREATE TABLE IF NOT EXISTS guestbook (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100)  NOT NULL,
  message    TEXT          NOT NULL,
  created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
