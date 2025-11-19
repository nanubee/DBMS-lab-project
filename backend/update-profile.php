<?php
// update-profile.php

// Start session and include database connection file
session_start();
include('db_connection.php'); // Adjust to your actual database connection file

// Fetch user ID from session (assuming the user ID is stored in the session)
$user_id = $_SESSION['user_id'];

// Collect and validate the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// Prepare SQL query to update user data
$query = "UPDATE users SET username = ?, email = ?, mobile = ?" . (!empty($password) ? ", password = ?" : "") . " WHERE user_id = ?";
$stmt = $conn->prepare($query);

if (!empty($password)) {
    // Hash the password before updating it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("ssssi", $name, $email, $phone, $hashed_password, $user_id);
} else {
    $stmt->bind_param("sssi", $name, $email, $phone, $user_id);
}

// Execute the query
if ($stmt->execute()) {
    echo "<script>alert('Profile updated successfully'); window.location.href='profile.php';</script>";
} else {
    echo "<script>alert('Error updating profile'); window.location.href='edit-profile.php';</script>";
}

$stmt->close();
$conn->close();
?>
