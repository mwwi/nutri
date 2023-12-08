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
    <title>Harris-Benedict Equation Calculator</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Harris-Benedict Equation Calculator</h1>
    <p> The Harris Equations were some of the widely used equations to estimate resting energy expenditure (REE)
        among normal and ill and injured individuals. The Harris-Benedict formulas
        have been found to overestimate (REE) in normal and obese individuals by 7% and 27% (Frankenfield et al., 2003 c.f. Krause, 14th)
    <p><strong>Gender:</strong> <?php echo $gender; ?></p>

    <p><strong>Age:</strong> <?php echo $age; ?></p>

    <p><strong>Weight (kg):</strong> <?php echo $userWeight; ?></p>
    <p><strong>Height (cm):</strong> <?php echo $userHeightInCM; ?></p>
</div>

<p id="harris-result">Result:  </p>

<form id="harrisForm" method="post" action="save_harris.php">
    <input type="hidden" name="harris" id="harrisInput" value="">
    <button type="button" id="calculate">Calculate</button>
    <button type="button" id="save">Save</button>
    <button type="button" id="back">Back to Dashboard</button>
</form>

<script>
document.getElementById('calculate').addEventListener('click', function () {
    const age = <?php echo $age; ?>;
    const gender = '<?php echo strtolower($gender); ?>';
    const weight = <?php echo $userWeight; ?>;
    const height = <?php echo $userHeightInCM; ?>;
    let bmr;

    if (gender === 'male') {
        bmr = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
    } else if (gender === 'female') {
        bmr = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
    }

    const bmrInput = document.getElementById('harrisInput');
    bmrInput.value = bmr;

    const roundedBMR = Math.round(bmr / 50) * 50;
document.getElementById('harris-result').innerText = `Result: Basal Metabolic Rate (BMR): ${roundedBMR} kcal/day`;




});


//save button function
document.getElementById('save').addEventListener('click', function () {
    // Check if BMR is calculated before submitting
    const bmrInput = document.getElementById('harrisInput');
    if (bmrInput.value !== '') {
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
