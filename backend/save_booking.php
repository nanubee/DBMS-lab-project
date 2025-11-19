<?php
session_start();
include 'db_connection.php'; // Include your database connection script

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['pickup']) && isset($data['dropoff'])) {
    $_SESSION['pickup'] = $data['pickup'];
    $_SESSION['dropoff'] = $data['dropoff'];

    // Insert or update booking in the database
    $pickup = $data['pickup'];
    $dropoff = $data['dropoff'];
    $user_id = $_SESSION['user_id']; // Assumes you have the user's ID in session

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, pickup_location, drop_location, status, created_at) VALUES (?, ?, ?, 'pending', NOW())");
    $stmt->bind_param("iss", $user_id, $pickup, $dropoff);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Missing parameters.']);
}
?>
