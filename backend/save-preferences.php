<?php
session_start();

// Capture form data from preferences.html
$ac_temp = $_POST['ac-temp'];
$silence = $_POST['silence'];
$wifi = isset($_POST['wifi']) ? 'on' : 'off';
$bluetooth_music = isset($_POST['bluetooth-music']) ? 'on' : 'off';
$additional = $_POST['additional'];

// Store preferences in session as an array
$_SESSION['preferences'] = [
    'ac_temp' => $ac_temp,
    'silence' => $silence,
    'wifi' => $wifi,
    'bluetooth_music' => $bluetooth_music,
    'additional' => $additional
];

// Redirect to vehicle.php to choose vehicle
header("Location: vehicle.php");
exit();
?>
