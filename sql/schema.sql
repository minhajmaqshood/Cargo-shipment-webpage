CREATE DATABASE IF NOT EXISTS shipment_db;
USE shipment_db;

CREATE TABLE shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shipment_name VARCHAR(100),
    shipping_mark VARCHAR(100),
    product_name VARCHAR(100),
    length DECIMAL(10,2),
    width DECIMAL(10,2),
    height DECIMAL(10,2),
    weight DECIMAL(10,2),
    boxes INT,
    cbm DECIMAL(10,2),
    document VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
