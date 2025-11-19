<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cab Booking System</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Page styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
            background-color: #2d333b; /* Dark background color */
            color: #ffffff; /* White text for main content */
        }

        /* Header styling */
        header {
            position: fixed;
            top: 0;
            right: 0; /* Position header at top-right */
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ffffff; /* White background for header */
            color: #000000; /* Black text color */
            align-items: center;
        }

        /* Home page title */
        .title {
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #000000; /* Black color for title text */
        }

        /* Profile button container */
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Circular profile button */
        .profile-button {
            width: 40px;
            height: 40px;
            background-color: #859F3D; /* Yellow button color */
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d333b; /* Dark color for icon */
            font-size: 18px;
            cursor: pointer;
            position: relative;
        }

        /* Profile button text */
        .profile-text {
            margin-top: 5px;
            font-size: 14px;
            color: #000000;
        }

        /* Main content styling */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%; /* Full height to center content */
        }

        /* Main phrase above the button */
        .main-phrase {
            font-size: 36px; /* Larger font size for emphasis */
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Book a cab button */
        .book-button {
            background-color: #859F3D; /* Yellow button color */
            color: #2d333b; /* Dark color for text */
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        .book-button:hover {
            background-color: #859F3D; /* Darker yellow on hover */
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <header>
        <div class="title">
            &#8962; <!-- Unicode for a simple house icon -->
            Home Page
        </div>
        <div class="profile-container">
            <button class="profile-button" onclick="goToProfile()">
                &#128100; <!-- Person icon using Unicode character -->
            </button>
            <div class="profile-text">My Profile</div>
        </div>
    </header>

    <!-- Main content -->
    <main>
        <p class="main-phrase">Travel made easy – Book your ride now!</p>
        <button class="book-button" onclick="bookCab()">BOOK A CAB</button>
    </main>

    <script>
        // Function to redirect to booking page
        function bookCab() {
            window.location.href = "location.html"; // Ensure this matches your booking page filename
        }

        // Function to redirect to profile details page
        function goToProfile() {
            window.location.href = "profile.php"; // Updated to PHP for session management
        }
    </script>
</body>
</html>
