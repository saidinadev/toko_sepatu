CREATE DATABASE IF NOT EXISTS toko_sepatu CHARACTER SET utf8mb4;
USE toko_sepatu;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(100) NOT NULL,email VARCHAR(100) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,role ENUM('user','admin') DEFAULT 'user',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE categories(id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(50) NOT NULL);
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,category_id INT,nama VARCHAR(150) NOT NULL,deskripsi TEXT,harga INT NOT NULL,stok INT NOT NULL DEFAULT 0,gambar VARCHAR(255),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE SET NULL);
CREATE TABLE orders(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,total INT NOT NULL,alamat TEXT NOT NULL,status ENUM('pending','dibayar','dikirim','selesai','batal') DEFAULT 'pending',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id));
CREATE TABLE order_items(id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,product_id INT NOT NULL,ukuran TINYINT NOT NULL,qty INT NOT NULL,harga INT NOT NULL,FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id));
INSERT INTO users(nama,email,password,role) VALUES('Admin','admin@toko.test','$2y$10$yfCkmMHfSPw61EpWfsyHbu9PtN18THcx8lK8oMpKCEAKQCJbTDpCi','admin');
INSERT INTO categories(nama) VALUES('Sneakers'),('Formal'),('Olahraga'),('Sandal');
INSERT INTO products(category_id,nama,deskripsi,harga,stok) VALUES
(1,'Urban Walk Putih','Sneakers putih ringan untuk harian, sol karet anti selip.',450000,25),
(1,'Street Runner Hitam','Sneakers hitam dengan bantalan empuk.',520000,18),
(2,'Oxford Kulit Coklat','Sepatu formal kulit asli, cocok untuk kantor.',890000,10),
(3,'Sprint Pro','Sepatu lari ringan dengan sirkulasi udara baik.',640000,30),
(4,'Slide Santai','Sandal slide empuk untuk santai dan di rumah.',150000,50);
