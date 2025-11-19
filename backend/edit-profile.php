<!-- edit-profile.php -->
<?php
session_start();
include('db_connection.php'); // Adjust to your database connection file

// Check if the user is logged in and session is set
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to access this page'); window.location.href='login.php';</script>";
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch current user data from database
$query = "SELECT username, email, mobile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data as associative array
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found'); window.location.href='profile.php';</script>";
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
    <title>Edit Profile</title>
    <style>
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
        .form-container {
            text-align: left;
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #444c56;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 18px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        .action-button {
            background-color: #859F3D;
            color: #2d333b;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 100%;
        }
        .action-button:hover {
            background-color: #6b7c29;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="update-profile.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['mobile']); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter new password if changing">
        </div>
        <button type="submit" class="action-button">Save Changes</button>
    </form>
</div>

</body>
</html>
