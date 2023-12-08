<?php
// save_pal.php

require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pal']) && !empty($_POST['pal'])) {
        $newDBW = floatval($_POST['pal']);

        if ($newDBW !== 0) {
            // Include the database connection file.
            require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

            $username = $_SESSION['username'];
            $updateQuery = "UPDATE users SET pal = $newDBW WHERE username = '$username'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                // Display a success message using JavaScript alert
                echo '<script>alert("data successfully updated in the database.");</script>';
                // Reload the current page
                echo '<script>window.location.href = document.referrer;</script>';
            } else {
                echo '<script>alert("Error updating data in the database: ' . mysqli_error($conn) . '");</script>';
                // Reload the current page
                echo '<script>window.location.href = document.referrer;</script>';
            }
        } else {
            echo '<script>alert("Invalid data value provided.");</script>';
            // Reload the current page
            echo '<script>window.location.href = document.referrer;</script>';
        }
    } else {
        echo '<script>alert("Data value not provided.");</script>';
        // Reload the current page
        echo '<script>window.location.href = document.referrer;</script>';
    }
}
?>
