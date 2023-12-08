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
<html>
<head>
    <title>Mifflin-St Jeor Equation</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Mifflin-St Jeor Equation (round off error)</h1>
    <p> Description: The equation of Mifflin-St Jeor is used to estimate BMR for normal, overweight, and obese people in the United States. BMR using Mifflin-St Jeor was close to the value obtained from indirect calorimetry among selected young Filipino adults (Orense, et al., 2013).

    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
    <p><strong>Age:</strong> <?php echo $age; ?></p>
    <p><strong>Weight (kg):</strong> <?php echo $userWeight; ?></p>
    <p><strong>Height (cm):</strong> <?php echo $userHeightInCM; ?></p>
</div>

<p id="mifflin-result">Basal Metabolic Rate (BMR):  </p>

<form id="mifflinForm" method="post" action="save_mifflin.php">
    <input type="hidden" name="mifflin" id="mifflinInput" value="">
    <button type="button" onclick="calculateMetabolicRates()">Calculate Rates</button><br><br>
    <button type="button" id="save">Save</button>
    <button type="button" id="back">Back to Dashboard</button>
</form>

<div id="result"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const gender = '<?php echo strtolower($gender); ?>';
    const age = <?php echo $age; ?>;
    const weight = <?php echo $userWeight; ?>;
    const height = <?php echo $userHeightInCM; ?>;

    function calculateMetabolicRates() {
     //   let bmr;
        let bmr;

        if (gender === 'male') {
       //     bmr = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
            bmr = 9.99 * weight + 6.25 * height - 4.92 * age + 5;
        } else if (gender === 'female') {
         //   bmr = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
            bmr = 9.99 * weight + 6.25 * height - 4.92 * age - 161;
        }

        const resultElement = document.getElementById('mifflin-result');
        resultElement.innerHTML = `Basal Metabolic Rate (BMR): ${parseInt(bmr)} kcal/day`;

        const bmrInput = document.getElementById('mifflinInput');
        bmrInput.value = bmr;

        const roundedBMR = Math.round(bmr / 50) * 50;
        
        // Assign the calculated BMR to the form input for submission
        document.getElementById('mifflinInput').value = parseInt(roundedBMR);
    }

    const calculateButton = document.querySelector('button[onclick="calculateMetabolicRates()"]');
    calculateButton.addEventListener('click', calculateMetabolicRates);

    document.getElementById('save').addEventListener('click', function () {
        const bmrInput = document.getElementById('mifflinInput');
        if (bmrInput.value !== '') {
            document.getElementById('mifflinForm').submit();
        } else {
            alert('Please calculate BMR before saving.');
        }
    });

    document.getElementById('back').addEventListener('click', function () {
        window.location.href = '../../TER/main_TER.php';
    });
});
</script>

</body>
</html>
