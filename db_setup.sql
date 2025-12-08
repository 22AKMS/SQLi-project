-- Create Database
CREATE DATABASE IF NOT EXISTS demo_site;
USE demo_site;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    full_name VARCHAR(100),
    role VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table for Search
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    price DECIMAL(10, 2),
    description TEXT,
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Users
INSERT INTO users (username, password, full_name, role) VALUES
('admin', 'admin123', 'Administrator', 'admin'),
('abdulla', 'abdulla123', 'Abdulla Alsaadi', 'manager'),
('user1', 'user123', 'John Smith', 'user');

-- Insert Sample Products
INSERT INTO products (name, category, price, description, stock) VALUES
('Wireless Mouse', 'Electronics', 29.99, 'Ergonomic wireless mouse with USB receiver', 50),
('Mechanical Keyboard', 'Electronics', 89.99, 'RGB backlit mechanical gaming keyboard', 30),
('USB-C Hub', 'Electronics', 45.50, '7-in-1 USB-C hub with HDMI and card reader', 25),
('Laptop Stand', 'Accessories', 39.99, 'Adjustable aluminum laptop stand', 40),
('Webcam HD', 'Electronics', 69.99, '1080p HD webcam with built-in microphone', 20),
('Desk Lamp', 'Accessories', 34.99, 'LED desk lamp with touch control', 35),
('Phone Case', 'Accessories', 19.99, 'Protective silicone phone case', 100),
('Bluetooth Speaker', 'Electronics', 79.99, 'Portable waterproof Bluetooth speaker', 15),
('Monitor 24inch', 'Electronics', 199.99, 'Full HD 24-inch IPS monitor', 10),
('Office Chair', 'Furniture', 249.99, 'Ergonomic mesh office chair', 8),
('Standing Desk', 'Furniture', 399.99, 'Electric height-adjustable standing desk', 5),
('Notebook Set', 'Stationery', 12.99, 'Pack of 3 premium notebooks', 60),
('Pen Set', 'Stationery', 15.99, 'Professional ballpoint pen set', 45),
('Water Bottle', 'Accessories', 24.99, 'Insulated stainless steel water bottle', 70),
('Backpack', 'Accessories', 59.99, 'Laptop backpack with USB charging port', 22);
