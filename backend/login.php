<?php
session_start(); // Start the session

include 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Secure user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Store user data in session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_email'] = $user['email'];

        // Initialize booking session variables
        $_SESSION['pickup_location'] = '';
        $_SESSION['drop_location'] = '';
        $_SESSION['preferences'] = '';
        $_SESSION['vehicle_selected'] = '';
        $_SESSION['fare'] = 0;
        $_SESSION['status'] = 'pending';

        // Redirect to the booking page
        header("Location: booking.php");
        exit();
    } else {
        // Redirect back to login with an error message
        echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

