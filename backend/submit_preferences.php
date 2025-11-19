<?php
session_start(); // Start the session to access the logged-in user's session data

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit;
}

// Get the logged-in user's username from session
$user_name = $_SESSION['user_name'];

// Get the submitted preferences from the form
$ac_temp = $_POST['ac-temp'] ?? 'off'; // Default value 'off' if not provided
$silence = $_POST['silence'] ?? 'silence'; // Default value 'silence' if not provided
$wifi = isset($_POST['wifi']) ? 1 : 0; // Convert checkbox to 1 or 0
$bluetooth_music = isset($_POST['bluetooth-music']) ? 1 : 0; // Convert checkbox to 1 or 0
$additional = $_POST['additional'] ?? ''; // Default empty if not provided

// Connect to the database (replace with your database details)
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "c_booking_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to update the preferences in the booking table
$sql = "UPDATE booking 
        SET AC = ?, chat = ?, wifi = ?, music = ?
        WHERE user_name = ?";

$stmt = $conn->prepare($sql);

// Check if the prepare statement was successful
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssiis", $ac_temp, $silence, $wifi, $bluetooth_music,$user_name);

// Execute the update query
if ($stmt->execute()) {
    // Preferences updated successfully, redirect to vehicle.php
    header("Location: vehicle.php");
    exit(); // Always call exit after header to stop script execution
} else {
    // Error occurred while updating preferences
    echo "Error updating preferences: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
