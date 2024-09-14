-- Create database
CREATE DATABASE IF NOT EXISTS beauty;

-- Use the beauty database
USE beauty;

-- Create Users table (for customer, admin, and stylist)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'stylist', 'customer') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample users
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@beauty.com', '$2y$10$exampleHashedPassword', 'admin'), -- bcrypt hashed password for 'adminpassword'
('Stylist User', 'stylist@beauty.com', '$2y$10$exampleHashedPassword', 'stylist'), -- bcrypt hashed password for 'stylistpassword'
('Customer User', 'customer@beauty.com', '$2y$10$exampleHashedPassword', 'customer'); -- bcrypt hashed password for 'customerpassword'

-- Create Services table
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    duration INT NOT NULL, -- duration in minutes
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample services
INSERT INTO services (name, description, price, duration) VALUES
('Haircut', 'A stylish haircut by our expert stylists.', 30.00, 45),
('Facial', 'A rejuvenating facial treatment.', 50.00, 60),
('Manicure', 'A relaxing manicure session.', 20.00, 30);

-- Create Appointments table
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    service_id INT NOT NULL,
    stylist_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (stylist_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert some sample appointments
INSERT INTO appointments (customer_id, service_id, stylist_id, appointment_date, status) VALUES
(3, 1, 2, '2024-09-14 10:00:00', 'confirmed'),
(3, 2, 2, '2024-09-15 12:00:00', 'pending');

-- Create Employees table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    position VARCHAR(100),
    working_hours VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert some sample employees (stylist)
INSERT INTO employees (user_id, position, working_hours) VALUES
(2, 'Senior Stylist', '9 AM - 5 PM');

-- Create Inventory table
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    price_per_unit DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample inventory
INSERT INTO inventory (name, description, quantity, price_per_unit) VALUES
('Shampoo', 'A rejuvenating hair shampoo.', 50, 5.00),
('Conditioner', 'A nourishing hair conditioner.', 30, 6.00);

-- Create Sales (POS) table
CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    payment_method ENUM('cash', 'card') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert some sample sales
INSERT INTO sales (customer_id, total_amount, payment_method) VALUES
(3, 80.00, 'card');

-- Create Reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    service_id INT NOT NULL,
    review TEXT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Insert some sample reviews
INSERT INTO reviews (customer_id, service_id, review, rating) VALUES
(3, 1, 'Great haircut! The stylist was very professional.', 5),
(3, 2, 'The facial was relaxing but could have been better.', 4);


-- This code is not part of the database\beauty.sql file. It appears to be instructions for reviewing JavaScript files and their dependencies in a web application. This documentation is not relevant to the SQL code provided in the database\beauty.sql file.

-- Check the HTML files: Look for tags that reference these JS files. If they're being included, they may be necessary for the system's functionality.
--Review the JS files: Open each JavaScript file and examine its contents. Look for functions that are being called in your HTML or other JS files.

--Check for dependencies: Some JS files might be dependencies for others or for third-party libraries you're using.

--Consider the features: Think about the features of your beauty parlor system. If you have interactive elements, form validations, AJAX requests, or dynamic content, you likely need JavaScript.

--Test without JS: Temporarily comment out the JavaScript includes in your HTML and see if the system still functions as expected. This can help identify which features rely on JavaScript. 