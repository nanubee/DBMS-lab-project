CREATE DATABASE c_booking_db;
USE c_booking_db;

-- USERS TABLE
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- VEHICLES TABLE
CREATE TABLE vehicles (
    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(100),
    capacity INT,
    has_wifi TINYINT(1) DEFAULT 0,
    has_bluetooth TINYINT(1) DEFAULT 0,
    is_available TINYINT(1) DEFAULT 1
);

-- PREFERENCES TABLE
CREATE TABLE preferences (
    pref_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    temperature VARCHAR(20),
    ride_mode VARCHAR(20),
    wifi TINYINT(1),
    bluetooth TINYINT(1),
    charging TINYINT(1),
    smoking TINYINT(1),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- BOOKINGS TABLE
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    pickup VARCHAR(255),
    dropoff VARCHAR(255),
    distance FLOAT,
    fare DECIMAL(10,2),
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(vehicle_id)
);
