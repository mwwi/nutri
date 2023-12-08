<?php
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$username = mysqli_real_escape_string($conn, $username);

$query = "SELECT gender, age, height_in_cm, weight FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gender = $row['gender'];
        $age = $row['age'];
        $userHeightInCM = $row['height_in_cm'];
        $userWeight = $row['weight'];
    }
} else {
    die("Error in query: " . mysqli_error($conn));
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="henry.css">
    <title>Henry Oxford</title>
</head>
<body>
    <div class="container">
    <h1>Henry Oxford</h1>
    <p id="desc"> Description: 
        <br>
        Oxford Equations were derived from a large database including persons from
        tropical areas (Henry, 2005). The equations were used in the calculation of BMR in the 
        2015 PDRI (DOST-FNRI,2017). </p>
    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
    <p><strong>Age:</strong> <?php echo $age; ?></p>
    <p><strong>Weight (kg):</strong> <?php echo $userWeight; ?></p>

</div>

<p id="henry-result">Result:  </p>

<form id="harrisForm" method="post" action="save_henry.php">
<input type="hidden" name="henry" id="henryInput" value="">
<button type="button" id="calculate" onclick="calculateBMR()">Calculate</button>
<button type="button" id="save">Save</button>
<button type="button" id="back">Back to Dashboard</button>
</form>

<div id="result"></div>

    
    <script>
    
//calculation 
document.addEventListener('DOMContentLoaded', function () {
    const calculateButton = document.getElementById('calculate');
    const resultElement = document.getElementById('henry-result');

    calculateButton.addEventListener('click', function () {
        const age = <?php echo $age; ?>;
        const gender = '<?php echo strtolower($gender); ?>';
        const weight = <?php echo $userWeight; ?>;

        if (isNaN(weight) || isNaN(age)) {
            resultElement.innerHTML = 'Please enter valid values.';
            return;
        }

        let bmr;
        if (gender === 'male') {
            if (age >= 18 && age < 30) {
                bmr = (weight * 16.0) + 545;
            } else if (age >= 30 && age < 60) {
                bmr = (weight * 14.2) + 593;
            } else if (age >= 60 && age < 70) {
                bmr = (weight * 13.0) + 567;
            } else if (age >= 70) {
                bmr = (weight * 13.7) + 481;
            }
        } else if (gender === 'female') {
            if (age >= 18 && age < 30) {
                bmr = (weight * 13.1) + 558;
            } else if (age >= 30 && age < 60) {
                bmr = (weight * 9.74) + 694;
            } else if (age >= 60 && age < 70) {
                bmr = (weight * 10.2) + 572;
            } else if (age >= 70) {
                bmr = (weight * 13.7) + 577;
            }
        }

        const bmrInput = document.getElementById('henryInput');
        bmrInput.value = bmr;

        const roundedBMR = Math.round(bmr / 50) * 50;
        resultElement.innerHTML = `Your BMR using Henry Oxford is approximately ${roundedBMR} kcal/day.`;

    });
});


//save button funcion
document.getElementById('save').addEventListener('click', function () {
    // Check if BMR is calculated before submitting
    const bmrInput = document.getElementById('henryInput');
    if (bmrInput.value !== '') {
        // Assign the calculated BMR to the form input
        bmrInput.value = Math.round(bmrInput.value / 50) * 50;

        // Submit the form
        document.getElementById('harrisForm').submit();
    } else {
        alert('Please calculate BMR before saving.');
    }
});


//back button function
document.getElementById('back').addEventListener('click', function () {
    window.location.href = '../../TER/main_TER.php'; // Adjust the path as needed
});

    </script>
</body>
</html>