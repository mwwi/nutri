<?php
// This block is for retrieving user information, you can keep it as is.
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBW by BMI Method</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>DBW by BMI Method </h1>
        <div class="data-display">
            <p><strong>Weight (kg):</strong> <?php echo $userWeight; ?></p>
            <p><strong>Height (m):</strong> <?php echo $userHeightInMeters; ?></p>
        </div>

        <p id="bmi-dbw">Desirable Body Weight (DBW): </p>
        <p id="bmi-result">Your BMI is: </p>
        <p id="bmi-desc">BMI Classifciation: </p>


        <form id="bmiForm" method="post" action="save_bmi.php">
            <input type="hidden" name="bmi" id="bmiInput" value="">
            <input type="hidden" name="dbw" id="dbwInput" value=""> 
            <button type="button" id="calculate">Calculate</button>
            <button type="button" id="save">Save</button>
            <button type="button" id="back">Back to Dashboard</button>
        </form>

    
    </div>
    <script>
document.getElementById('calculate').addEventListener('click', function () {
    const weight = <?php echo $userWeight; ?>;
    const height = <?php echo $userHeightInMeters; ?>;
    const bmiResultElement = document.getElementById('bmi-result');
    const bmiDescElement = document.getElementById('bmi-desc');
    const dbwResultElement = document.getElementById('bmi-dbw'); // Reference the correct DBW element


    const bmi = Math.floor(weight / (height * height));

    if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
        bmiResultElement.textContent = 'Invalid input. Please enter valid weight and height values.';
        bmiDescElement.textContent = 'BMI Classifciation: N/A';
        dbwResultElement.textContent = 'Desirable Body Weight (DBW): N/A'; // Set the error message for DBW

    } else {
        bmiResultElement.textContent = `Your BMI is: ${parseInt(bmi)}`;

        // Determine the BMI range
        let bmiRange = '';
        if (bmi < 15) {
            bmiRange = 'Very severely underweight';
        } else if (bmi >= 15 && bmi < 16) {
            bmiRange = 'Severely underweight';
        } else if (bmi >= 16 && bmi < 18.5) {
            bmiRange = 'Underweight';
        } else if (bmi >= 18.5 && bmi < 25) {
            bmiRange = 'Healthy/Normal weight';
        } else if (bmi >= 25 && bmi < 30) {
            bmiRange = 'Overweight';
        } else if (bmi >= 30 && bmi < 35) {
            bmiRange = 'Moderately obese';
        } else if (bmi >= 35 && bmi < 40) {
            bmiRange = 'Severely obese';
        } else {
            bmiRange = 'Very severely or morbidly obese';
        }

        bmiDescElement.textContent = `BMI Classifciation: ${bmiRange}`;



// Set the calculated BMI value to the hidden input
bmiInput.value = parseInt(bmi);

// Calculate DBW based on BMI (height squared * 22)
const dbw = Math.floor((height * height) * 22);
dbwResultElement.textContent = `Desirable Body Weight (DBW): ${parseInt(dbw)}kg`;


// Set the calculated DBW value to the hidden input
dbwInput.value = parseInt(dbw);

    }
});

//saeve button function
document.getElementById('save').addEventListener('click', function () {
    // Submit the form to save BMI to the database
    document.getElementById('bmiForm').submit();
});

document.getElementById('back').addEventListener('click', function () {
    window.location.href = '../../DBW/main.php'; // Adjust the path as needed
});

    </script>
</body>
</html>
