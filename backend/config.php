<?php
// config.php
$host = 'localhost'; // Database host
$username = 'root';  // Database username (default for XAMPP)
$password = '';      // Database password (default is empty for XAMPP)
$dbname = 'c_booking_db'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>