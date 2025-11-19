<?php
session_start();
include('config.php'); // Include your database connection file

// Query to fetch available vehicles with model and type only
$query = "SELECT vehicle_model, vehicle_type FROM vehicles WHERE status = 'available'";
$result = mysqli_query($conn, $query);

// Fetch all available vehicles into an array
$vehicles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $vehicles[] = $row;
}

// Check if there are any vehicles available
$selectedVehicles = [];
if (!empty($vehicles)) {
    // Randomly choose 2 or 3 vehicles
    $randomKeys = array_rand($vehicles, min(3, count($vehicles))); // Get either 2 or 3, depending on available count
    $selectedVehicles = is_array($randomKeys) ? $randomKeys : [$randomKeys];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Vehicle</title>
    <style>
        /* Full-screen container */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #31511E;
        }

        /* Top half styling */
        .top-half {
            background-color: #31511E;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F6FCDF;
        }

        .top-half h1 {
            font-size: 2.5em;
        }

        /* Bottom half styling */
        .bottom-half {
            background-color: #3b3b3b;
            flex: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            color: #F6FCDF;
        }

        /* Container for Vehicle Options */
        #vehicles-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        /* Styling for each vehicle option */
        .vehicle-card {
            background: #F6FCDF;
            color: #31511E;
            padding: 20px;
            border-radius: 8px;
            width: 220px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .vehicle-card:hover {
            transform: scale(1.05);
        }

        .vehicle-card img {
            width: 120px; /* Increased image size */
            height: auto;
            margin-bottom: 10px;
        }

        /* Button styling for vehicle selection */
        .vehicle-btn {
            background-color: #859F3D;
            color: #F6FCDF;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .vehicle-btn:hover {
            background-color: #31511E;
        }

        /* Book Ride Button */
        #book-ride {
            background-color: #31511E;
            color: #F6FCDF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
            max-width: 200px;
        }

        #book-ride:disabled {
            background-color: #859F3D;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="top-half">
    <h1>Choose Your Ride</h1>
</div>

<div class="bottom-half">
    <div id="vehicles-container">
        <?php
        // Display the selected vehicles as cards with images and buttons if there are any
        if (!empty($selectedVehicles)) {
            foreach ($selectedVehicles as $index) {
                $vehicle = $vehicles[$index];
                echo "<div class='vehicle-card'>";

                // Display different images based on vehicle type
                if (strtolower($vehicle['vehicle_type']) == 'sedan') {
                    echo "<img src='sedan.png' alt='Sedan'>";
                } elseif (strtolower($vehicle['vehicle_type']) == 'suv') {
                    echo "<img src='suv.png' alt='SUV'>";
                } elseif (strtolower($vehicle['vehicle_type']) == 'hatchback') {
                    echo "<img src='hatchback.png' alt='Hatchback'>";
                } else {
                    echo "<img src='default.png' alt='Vehicle'>";
                }

                echo "<p>Type: " . $vehicle['vehicle_type'] . "</p>";
                echo "<p>Model: " . $vehicle['vehicle_model'] . "</p>";
                echo "<button class='vehicle-btn' onclick='selectVehicle(this)'>" . $vehicle['vehicle_model'] . " - " . $vehicle['vehicle_type'] . "</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No available vehicles at the moment.</p>";
        }
        ?>
    </div>

    <button id="book-ride" disabled onclick="redirectToDetails()">Book Ride</button>
</div>

<script>
    // Function to handle vehicle selection
    function selectVehicle(button) {
        const buttons = document.querySelectorAll('.vehicle-btn');
        buttons.forEach(btn => btn.style.outline = ''); // Remove outline from all buttons
        button.style.outline = '2px solid blue'; // Add outline to the selected vehicle

        // Store the selected vehicle in the localStorage (you can also pass it via URL params)
        localStorage.setItem('selectedVehicle', button.textContent);

        // Enable the Book Ride button
        document.getElementById('book-ride').disabled = false;
    }

    // Function to redirect to details.html
    function redirectToDetails() {
        // You can also pass the selected vehicle through URL if needed
        window.location.href = "details.html?vehicle=" + encodeURIComponent(localStorage.getItem('selectedVehicle'));
    }
</script>

</body>
</html>


