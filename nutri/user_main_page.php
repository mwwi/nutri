<?php
include("sessions/auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="css/user_main_page.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>Welcome to your dashboard page.</p>

        <div class="container">
        <div class="buttons">

            <button class="button" onclick="location.href='user_information.php'">View User Information</button>
            <button class="button" onclick="location.href='user_input.php'">Add/Edit Vital Statistics</button>
            <button class="button" onclick="location.href='dbw/main.php'">Calculate Desirable Body Weight</button>
            <button class="button" onclick="location.href='TER/main_TER.php'">Calculate TER</button>
            <button class="button" onclick="location.href='exchanges/main.php'">Distribution of Exchanges</button>
            <button class="button" onclick="location.href='mealplan.php'">Meal Plan</button>
        </div>
    </div>

        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>