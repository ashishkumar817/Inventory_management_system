CREATE DATABASE inventory_database;
USE inventory_database;

-- Drop tables if they already exist (for resetting)
DROP TABLE IF EXISTS stock, order_details, `order_`, product, customer, supplier;

-- Customer Table
CREATE TABLE customers (
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  phone VARCHAR(20),
  address TEXT
);


-- Supplier Table
CREATE TABLE supplier (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    s_name VARCHAR(100) NOT NULL,
    s_contact_no VARCHAR(15),
    s_addr TEXT
);

-- Product Table
CREATE TABLE product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    p_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity_in_stock INT DEFAULT 0,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id) ON DELETE SET NULL
);

-- Order Table
CREATE TABLE order_ (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_date DATE NOT NULL,
    status ENUM('Completed', 'Processing', 'Cancelled') DEFAULT 'Processing',
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE SET NULL
);

-- Order Details Table
CREATE TABLE order_details (
    orderdetails_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES order_(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

-- Stock Table
CREATE TABLE stock (
    stock_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    quantity_added INT NOT NULL,
    date_added DATE NOT NULL,
    supplier_id INT,
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE,
    FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id) ON DELETE SET NULL
);

-- Customers
INSERT INTO customers (name, email, phone, address) VALUES
('Alice Johnson', 'alice@example.com', '9876543210', '123 Park Lane'),
('Bob Smith', 'bob@example.com', '9123456780', '456 Elm Street');


-- Suppliers
INSERT INTO supplier (s_name, s_contact_no, s_addr) VALUES
('AudioTech Ltd.', '9123456780', '42 Silicon Street, Tech City'),
('GadgetWorld Inc.', '9234567890', '101 Future Ave, Innovation Park'),
('Sound Systems Co.', '9345678901', '88 Echo Road, Acoustica');

-- Products
INSERT INTO product (p_name, description, price, quantity_in_stock, supplier_id) VALUES
('Premium Headphones', 'Noise-cancelling over-ear headphones', 129.99, 45, 1),
('Smart Watch Pro', 'Smart watch with health tracking', 249.99, 5, 2),
('Wireless Earbuds', 'Compact Bluetooth earbuds', 79.99, 0, 1),
('Bluetooth Speaker', 'Portable speaker with deep bass', 59.99, 32, 3);

-- Orders
INSERT INTO order_ (customer_id, order_date, status) VALUES
(1, CURDATE(), 'Processing'),
(2, CURDATE(), 'Completed');
-- Order Details
INSERT INTO order_details (order_id, product_id, quantity, total_price) VALUES
(1, 1, 1, 129.99),
(2, 2, 1, 249.99),
(3, 3, 1, 79.99),
(4, 4, 1, 59.99);

-- Stock (History)
INSERT INTO stock (product_id, quantity_added, date_added, supplier_id) VALUES
(1, 50, '2025-04-12', 1),
(2, 20, '2025-04-10', 2),
(4, 30, '2025-04-08', 3);
