<?php
session_start();
include 'config.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_name = $_SESSION['user_name'];
$data = json_decode(file_get_contents("php://input"), true);

// Get pickup and dropoff locations from the data
$pickup_location = $data['pickupLocation'];
$dropoff_location = $data['dropoffLocation'];

// Prepare SQL statement to insert the booking
$sql = "INSERT INTO booking (user_name, pickup_location, drop_location) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sss", $user_name, $pickup_location, $dropoff_location);  // Correcting bind type to 'sss' for strings

// Execute the query
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to book cab: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
