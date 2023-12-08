<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'test';
$db_name = 'nutri';

// Create a new MySQLi object for database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// If the script reaches this point, the database connection is successful.
// You can continue with your database queries and operations.
?>
