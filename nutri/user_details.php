<?php
// Connect to your MySQL database (You should replace with your actual database credentials)
$conn = mysqli_connect('localhost', 'root', 'test', 'nutri_sys');

// Check the connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Retrieve user details from the database (You should replace with your actual query)
$sql = "SELECT * FROM users WHERE user_id = 123"; // Change the WHERE condition as needed
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p><strong>First Name:</strong> " . $row['u_first_name'] . "</p>";
    echo "<p><strong>Last Name:</strong> " . $row['u_last_name'] . "</p>";
    echo "<p><strong>Username:</strong> " . $row['username'] . "</p>";
    echo "<p><strong>Age:</strong> " . $row['age'] . "</p>";
    echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
    echo "<p><strong>Height:</strong> " . $row['height'] . "</p>";
    echo "<p><strong>Weight:</strong> " . $row['weight'] . "</p>";
} else {
    echo "User not found.";
}

// Close the database connection
mysqli_close($conn);
?>
