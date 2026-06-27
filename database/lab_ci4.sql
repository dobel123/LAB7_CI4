CREATE DATABASE IF NOT EXISTS lab_ci4;
USE lab_ci4;

CREATE TABLE IF NOT EXISTS kategori (
  id_kategori INT(11) AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(100) NOT NULL,
  slug_kategori VARCHAR(120) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS artikel (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200) NOT NULL,
  isi TEXT,
  gambar VARCHAR(200),
  status TINYINT(1) DEFAULT 0,
  slug VARCHAR(200),
  id_kategori INT(11),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

CREATE TABLE IF NOT EXISTS user (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(200) NOT NULL,
  useremail VARCHAR(200) NOT NULL UNIQUE,
  userpassword VARCHAR(255) NOT NULL,
  token VARCHAR(255) DEFAULT NULL
);

INSERT INTO kategori (nama_kategori, slug_kategori) VALUES
('Pemrograman', 'pemrograman'),
('Web', 'web'),
('Database', 'database')
ON DUPLICATE KEY UPDATE nama_kategori = VALUES(nama_kategori);

INSERT INTO artikel (judul, isi, gambar, status, slug, id_kategori) VALUES
('Belajar CodeIgniter 4', 'Artikel contoh untuk praktikum CodeIgniter 4.', 'default.jpg', 1, 'belajar-codeigniter-4', 1),
('REST API dengan CI4', 'Artikel contoh untuk endpoint REST API.', 'default.jpg', 1, 'rest-api-dengan-ci4', 2);

INSERT INTO user (username, useremail, userpassword) VALUES
('Administrator', 'admin@example.com', 'admin123');
