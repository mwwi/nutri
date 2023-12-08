<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vital Statistics</title>
    <link rel="stylesheet" type="text/css" href="css/user_input.css">
</head>
<body>


<?php
include("sessions/auth_session.php");
require('db.php');

// Check if the user is authenticated and a username is in the session
if (isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Form is submitted
       $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $height_feet = mysqli_real_escape_string($conn, $_POST['height-feet']);
        $height_inches = mysqli_real_escape_string($conn, $_POST['height-inches']);
        $weight = mysqli_real_escape_string($conn, $_POST['weight']);
        $username = $_SESSION['username'];

        // Convert height to meters and centimeters
        $totalInches = ($height_feet * 12) + $height_inches;
        $height_meters = $totalInches * 0.0254;
        $height_cm = $totalInches * 2.54;

        // Check if the user's information already exists in the database
        $check_query = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // User information exists, perform an UPDATE operation
            $update_query = "UPDATE `users` 
            SET age = '$age', 
                height_feet = '$height_feet', 
                height_inches = '$height_inches', 
                height_in_m = '$height_meters', 
                height_in_cm = '$height_cm', 
                weight = '$weight'
            WHERE username = '$username'";

            if (mysqli_query($conn, $update_query)) {
                $resultMessage = "Your information has been updated successfully.";
            } else {
                $resultMessage = "Error: " . mysqli_error($conn);
            }
        } else {
            // User information doesn't exist, perform an INSERT operation
            $insert_query = "INSERT INTO `users` (username, gender, age, height_feet, height_inches, 
                            height_meters, height_cm, weight) 
                            VALUES ('$username', '$gender', '$age', '$height_feet', '$height_inches', 
                            '$height_meters', '$height_cm', '$weight')";
            if (mysqli_query($conn, $insert_query)) {
                $resultMessage = "Your information has been saved successfully.";
            } else {
                $resultMessage = "Error: " . mysqli_error($conn);
            }
        }

        // Display the result message
        echo "<div class='form'>
              <h3>$resultMessage</h3><br/>
              </div>";
    }
}
?>


<div class="user-info-container">
    <div class="container">
        <h1>Vital Statistics</h1>
        <form id="user-info-form" method="post">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="age">Age (years):</label>
            <input type="number" id="age" name="age" min="0" required>

            <label for="height-feet">Height (feet):</label>
            <input type="number" id="height-feet" name="height-feet" min="0" required>

            <label for="height-inches">Height (inches):</label>
            <input type="number" id="height-inches" name="height-inches" min="0" required>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" min="0" step="0.01" required>

            <button type="submit" id="save-button">Save</button>
            <button type="submit" id="edit-button">Edit</button>
            <button type="button" id="back-button">Back to Dashboard</button>
        </form>
    </div>
</div>

<script>
    // Button event handler for going back to the dashboard
    document.getElementById('back-button').addEventListener('click', function () {
        // Redirect the user to the dashboard page
        window.location.href = 'user_main_page.php'; // Replace with the actual URL of the dashboard
    });
</script>
</body>
</html>
