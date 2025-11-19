<?php
session_start();



// Ensure that preferences are stored in the session as an array
if (isset($_SESSION['preferences']) && isset($_SESSION['preferences']['bluetooth_music'])) {
    $bluetooth_music = $_SESSION['preferences']['bluetooth_music'];
} else {
    $bluetooth_music = 'off'; // Default if no preferences are set
}


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ride is On the Way</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #3b3b3b;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #F6FCDF;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 3em;
            color: #F6FCDF;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #F6FCDF;
        }

        .highlight {
            color: #859F3D;
            font-weight: bold;
        }

        /* Slight fade effect for text */
        h1, p {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* Spotify button */
        .spotify-button {
            background-color: #859F3D;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .spotify-button:hover {
            background-color: #31511E;
        }
    </style>
</head>
<body>

    <h1>Your ride is on the way!</h1>
    <p><span class="highlight">Thank you</span> for choosing our service.</p>
    
    


    <?php if ($bluetooth_music == 'on'): ?>
        <!-- Display Spotify Button only if Bluetooth music is enabled -->
        <a href="https://open.spotify.com/" target="_blank" class="spotify-button">Listen to Your Playlist</a>
    <?php endif; ?>

</body>
</html>
