
-- USERS TABLE
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    nid VARCHAR(30),
    phone VARCHAR(20),
    address VARCHAR(255),
    trust_score INT DEFAULT 50
);

-- ITEMS TABLE
CREATE TABLE items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100),
    description TEXT,
    available BOOLEAN DEFAULT TRUE,
    owner_id INT
);

-- BORROW REQUESTS TABLE
CREATE TABLE borrow_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item_id INT,
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    due_date DATE,
    return_date DATE,
    status ENUM('pending', 'approved', 'returned', 'overdue') DEFAULT 'pending'
);
