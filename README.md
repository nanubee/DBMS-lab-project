# 🚖 QuickCab – Cab Booking System

A simple database-driven cab booking platform built using PHP, MySQL, HTML, CSS, and JavaScript.
Users can register, log in, choose pickup/drop locations, set ride preferences, select vehicles, and confirm bookings.

## 📌 Features
1. User Authentication (Register, Login, Profile Update)
2. Vehicle Selection (Sedan, Hatchback, SUV)
3. Ride Preferences (WiFi, Bluetooth, Temperature, etc.)
4. Location Input + Route Display
5. Fare Calculation & Booking Confirmation
6. MySQL Database Integration

## 🗄️ Database Structure

Tables:
1. users
2. vehicles
3. preferences
4. bookings

### SQL Schema:
/database/schema.sql

## 📁 Project Structure

frontend/      → HTML, CSS, images
backend/       → All PHP backend logic
database/      → schema.sql
documents/     → Project report

## ▶️ How to Run

1. Import schema.sql into MySQL (c_booking_db)
2. Update DB credentials in config.php
3. Place project in XAMPP/WAMP htdocs/
4. Visit in browser:
http://localhost/cab-booking-platform/frontend/login.html

## 🧑‍💻 Tech Stack

1. Frontend: HTML, CSS, JavaScript
2. Backend: PHP
3. Database: MySQL

## 📄 Notes

This project was created as part of a DBMS mini project focusing on relational database design and backend integration.
