<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="css/regis.css"/>
</head>
<body>
<?php
require('db.php');

// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // Remove backslashes
    $username = stripslashes($_REQUEST['username']);
    // Escape special characters in a string
    $username = mysqli_real_escape_string($conn, $username);
    
    $firstName = stripslashes($_REQUEST['firstName']);
    $firstName = mysqli_real_escape_string($conn, $firstName);

    $lastName = stripslashes($_REQUEST['lastName']);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $create_datetime = date("Y-m-d H:i:s");
    $query = "INSERT INTO users (username, u_firstName, u_lastName, password, email, create_datetime) 
              VALUES ('$username', '$firstName', '$lastName', '" . md5($password) . "', '$email', '$create_datetime')";

    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<div class='form'>
              <h3>You are registered successfully.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a></p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>Required fields are missing or the username is already taken.</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
              </div>";
    }
} else {
?>

    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="firstName" placeholder="First Name">
        <input type="text" class="login-input" name="lastName" placeholder="Last Name">
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>