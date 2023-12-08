<?php
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

$username = $_SESSION['username'];

$query = "SELECT gender, age, height_in_m, weight FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $gender = $row['gender'];
    $age = $row['age'];
    $userHeightInMeters = $row['height_in_m'];
    $userWeight = $row['weight'];
}

if (isset($_POST['calculate'])) {
    // Retrieve user data from PHP variables
    $weight = $userWeight;
    $height = $userHeightInMeters;
    $bmiResultElement = 'Your BMI is: ';
    $bmiDescElement = 'BMI Range: ';

    $bmi = $weight / ($height * $height);

    if (isNaN($weight) || isNaN($height) || $weight <= 0 || $height <= 0) {
        $bmiResultElement .= 'Invalid input. Please enter valid weight and height values.';
        $bmiDescElement .= 'BMI Range: N/A';
    } else {
        $bmiResultElement .= 'Your BMI is: ' . number_format($bmi, 2);

        // Determine the BMI range
        $bmiRange = '';
        if ($bmi < 15) {
            $bmiRange = 'Very severely underweight';
        } else if ($bmi >= 15 && $bmi < 16) {
            $bmiRange = 'Severely underweight';
        } else if ($bmi >= 16 && $bmi < 18.5) {
            $bmiRange = 'Underweight';
        } else if ($bmi >= 18.5 && $bmi < 25) {
            $bmiRange = 'Healthy weight';
        } else if ($bmi >= 25 && $bmi < 30) {
            $bmiRange = 'Overweight';
        } else if ($bmi >= 30 && $bmi < 35) {
            $bmiRange = 'Moderately obese';
        } else if ($bmi >= 35 && $bmi < 40) {
            $bmiRange = 'Severely obese';
        } else {
            $bmiRange = 'Very severely or morbidly obese';
        }

        // Display the BMI range
        $bmiDescElement .= 'BMI Range: ' . $bmiRange;

        // Save the calculated BMI to the database
        $newBMI = $bmi; // You can modify this to use a different value if needed
        $updateQuery = "UPDATE users SET dbw_bmi = $newBMI WHERE username = '$username'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo 'BMI successfully updated in the database.';
        } else {
            echo 'Error updating BMI in the database: ' . mysqli_error($conn);
        }
    }

    // Display the calculated BMI and BMI range
    echo "<p id='bmi-result'>$bmiResultElement</p>";
    echo "<p id='bmi-desc'>$bmiDescElement</p>";
}
?>
