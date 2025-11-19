<?php
session_start();
include('db_connection.php'); // Include your DB connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to access this page'); window.location.href='login.php';</script>";
    exit();
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];



// Fetch the updated user details from the database
$query = "SELECT username, email, mobile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch the updated user data
    $user_name = $user['username'];  // Set the user name from the database
    $user_email = $user['email']; // Set the user email from the database
    $user_phone= $user['mobile']; 

    
} else {
    echo "<script>alert('User not found'); window.location.href='login.php';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
            background-color: #2d333b;
            color: #ffffff;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #000000;
            align-items: center;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #000000;
        }

        .profile-container {
            text-align: left;
            margin-top: 50px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        .profile-detail {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .action-button {
            background-color: #ffcc33;
            color: #2d333b;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            margin: 10px 5px;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #e6b800;
        }

        .button-container {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div class="title">
        &#128100; User Profile
    </div>
</header>

<div class="profile-container">
    <p class="profile-detail" id="user-name">Name: <?php echo $user_name; ?></p>
    <p class="profile-detail" id="user-email">Email: <?php echo $user_email; ?></p>
    <p class="profile-detail" id="user-phone">Phone: <?php echo $user_phone; ?></p>

    <div class="button-container">
        <button onclick="window.location.href='edit-profile.php'"class="action-button" onclick="editProfile()">Edit Profile</button>
        
    </div>
</div>


</body>
</html>
