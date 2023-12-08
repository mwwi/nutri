
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;

            // $_SESSION['u_fn'] = $firstName;
            // $_SESSION['u_ln'] = $lastName;
            // Redirect to user dashboard page
            header("Location: user_main_page.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
   <div class="container">
    <h1>Login</h1>
    <form class="form" method="post" name="login">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="login-input" name="username" id="username" autofocus="true">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="login-input" name="password" id="password">
        </div>
        <button type="submit" class="login-button" name="submit">Login</button>
        <p class="link"><a href="registration.php">New Registration</a></p>
    </form>
</div>

<?php
    }
?>
</body>
</html>