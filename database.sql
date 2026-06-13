-- Hotel Booking System Database

CREATE DATABASE IF NOT EXISTS hotel_booking;
USE hotel_booking;

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Rooms Table
CREATE TABLE rooms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    capacity INT NOT NULL,
    description TEXT,
    amenities TEXT,
    image VARCHAR(255),
    status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bookings Table
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- Reviews Table
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- Insert Admin User
INSERT INTO users (name, email, password, phone, role) VALUES 
('Admin', 'admin@hotel.com', '$2y$10$kJ2J7g9Zg8hB3cK5jF2mPuL4qR5sT6uV7wX8yZ9aB0cD1eF2gH3iJ4kL', '0501234567', 'admin');

-- Insert Sample Rooms
INSERT INTO rooms (name, type, price, capacity, description, amenities, image, status) VALUES 
('غرفة فردية فاخرة', 'فردية', 250, 1, 'غرفة مريحة للمسافرين وحدهم', 'Wi-Fi، تلفاز', 'default.jpg', 'available'),
('غرفة مزد��جة ديلوكس', 'مزدوجة', 400, 2, 'غرفة واسعة وفاخرة', 'Wi-Fi، تلفاز، حمام جاكوزي', 'default.jpg', 'available'),
('غرفة عائلية', 'عائلية', 600, 4, 'غرفة كبيرة مناسبة للعائلات', 'Wi-Fi، تلفاز، مطبخ صغير', 'default.jpg', 'available'),
('جناح ملكي', 'ملكية', 1000, 3, 'أفخم أجنحة الفندق', 'Wi-Fi، تلفاز، جاكوزي، ساونا', 'default.jpg', 'available');

-- Create Indexes
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_booking_user ON bookings(user_id);
CREATE INDEX idx_booking_room ON bookings(room_id);
CREATE INDEX idx_review_room ON reviews(room_id);
CREATE INDEX idx_review_user ON reviews(user_id);