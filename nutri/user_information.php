<?php
// Include necessary files and establish a database connection

// Replace this with your database connection code
include("sessions/auth_session.php");
require('db.php');


// Initialize user data
$userData = array(
    'u_firstName' => '',
    'u_lastName' => '',
    'username' => '',
    'gender' => '',
    'age' => '',
    'height_feet' => '',
    'height_inches' => '',
    'height_in_m' => '',
    'height_in_cm' => '',
    'dbw_bmi' => '',
    'dbw_hamwi' => '',
    'dbw_tann' => '',
    'pal' => '',
    'harris' => '',
    'oxford' => '',
    'mifflin' => ''
);

// Check if the user is authenticated and has a username in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Replace 'your_db_connection' with your actual database connection code
    // and execute a SELECT query to fetch the user's data
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main_page.css">
    <title>User Information</title>
</head>
<body>
    <header>
        <h1>User Information</h1>
    </header>
    
    <h3>First Name: <?php echo $userData['u_firstName']; ?></h3>
    <h3>Last Name: <?php echo $userData['u_lastName']; ?></h3>
    <p>Username: <?php echo $userData['username']; ?></p>
    <p>Gender: <?php echo $userData['gender']; ?></p>
    <p>Age: <?php echo $userData['age']; ?></p>
    <p>Height (feet inches): <?php echo $userData['height_feet'] . " feet " . $userData['height_inches'] . " inches"; ?></p>
    <p>Height (m): <?php echo $userData['height_in_m']; ?></p>
    <p>Height (cm): <?php echo $userData['height_in_cm']; ?></p>
    <p>Weight (kg): <?php echo $userData['weight']; ?></p>

    <br> 
    <p>DBW by BMI: <?php echo $userData['dbw_bmi']; ?> </p>
    <p>DBW by Hamwi: <?php echo $userData['dbw_hamwi']; ?></p>
    <p>DBW by Tannhauser: <?php echo $userData['dbw_tann']; ?></p>

    <br> 
    <p>TER by PAL: <?php echo $userData['pal']; ?></p>

    <p>TER by Mifflin: <?php echo $userData['mifflin']; ?></p>
    <p>TER by Harris: <?php echo $userData['harris']; ?></p>    
    <p>TER by Oxford: <?php echo $userData['oxford']; ?></p>

    <div class="container">
        <div class="buttons">
            <button class="button" onclick="location.href='user_main_page.php'">Back to Dashboard</button>
        </div>
    </div>
</body>
</html>
