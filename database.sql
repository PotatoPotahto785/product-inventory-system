-- Import this in phpMyAdmin (InfinityFree) after creating your database
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  quantity INT NOT NULL DEFAULT 0,
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, category, quantity, price) VALUES
('Ballpen (Blue)', 'Office Supplies', 200, 10.00),
('Notebook A5', 'School Supplies', 80, 45.50),
('Bottled Water 500ml', 'Beverages', 150, 15.00);
