CREATE DATABASE IF NOT EXISTS db_quan_nhau
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_quan_nhau;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE,
  phone VARCHAR(50),
  password VARCHAR(255),
  role ENUM('ADMIN','STAFF','CUSTOMER') DEFAULT 'CUSTOMER',
  status ENUM('ACTIVE','INACTIVE','BANNED') DEFAULT 'ACTIVE',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL
);

INSERT INTO users (name,email,phone,password,role)
VALUES
('Admin Vỹ','admin@example.com','0909000000','123456','ADMIN'),
('Nhân viên A','staff@example.com','0909111111','123456','STAFF'),
('Khách Nguyễn Văn B','customer@example.com','0911222333','123456','CUSTOMER');

CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  address VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO customers (user_id, address)
VALUES 
(3, '123 Đường ABC, Quận 1');

CREATE TABLE tables_quan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  table_name VARCHAR(100) NOT NULL,
  seats INT DEFAULT 4,
  status ENUM('EMPTY','OCCUPIED','RESERVED','WAITING_PAYMENT') DEFAULT 'EMPTY'
);

INSERT INTO tables_quan (table_name,seats,status)
VALUES 
('Bàn 1',4,'EMPTY'),
('Bàn 2',6,'RESERVED'),
('Bàn 3',4,'OCCUPIED');

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

INSERT INTO categories (name)
VALUES ('Món nướng'),('Món lẩu'),('Đồ uống');

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  image VARCHAR(255),
  is_active TINYINT(1) DEFAULT 1,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO products (category_id,name,description,price,image)
VALUES
(1,'Ba chỉ nướng','Ba chỉ heo nướng than hoa',120000,'ba_chi.jpg'),
(2,'Lẩu thái hải sản','Lẩu thái cay chua',250000,'lau_thai.jpg'),
(3,'Bia Tiger','Chai 330ml',20000,'tiger.jpg');

CREATE TABLE reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  table_id INT NOT NULL,
  reservation_time DATETIME NOT NULL,
  people INT DEFAULT 1,
  status ENUM('PENDING','CONFIRMED','CANCELLED') DEFAULT 'PENDING',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (table_id) REFERENCES tables_quan(id)
);

INSERT INTO reservations (user_id,table_id,reservation_time,people,status)
VALUES (3,2,'2025-12-05 19:00:00',4,'CONFIRMED');

CREATE TABLE carts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE cart_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cart_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT DEFAULT 1,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO carts (user_id) VALUES (3);

INSERT INTO cart_items (cart_id,product_id,quantity,price)
VALUES
(1,1,2,120000),
(1,3,5,20000);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  table_id INT,
  total DECIMAL(12,2) DEFAULT 0,
  status ENUM('OPEN','PAID','CANCELLED') DEFAULT 'OPEN',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (table_id) REFERENCES tables_quan(id)
);

INSERT INTO orders (user_id, table_id, total, status)
VALUES (3, 3, 350000, 'OPEN');

CREATE TABLE order_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT DEFAULT 1,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO order_details (order_id,product_id,quantity,price)
VALUES
(1,1,2,120000),
(1,3,5,20000);

CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  method ENUM('CASH','BANKING','MOMO','ZALO') DEFAULT 'CASH',
  payment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (order_id) REFERENCES orders(id)
);

INSERT INTO payments (order_id,amount,method)
VALUES (1,350000,'CASH');
