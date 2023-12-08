<?php
// Retrieve user information
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

$username = $_SESSION['username'];

$query = "SELECT gender, height_feet, height_inches, weight FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $gender = $row['gender'];
    $userHeightFeet = $row['height_feet'];
    $userHeightInches = $row['height_inches'];
    $weight = $row['weight'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBW by Hamwi Method</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>DBW by Hamwi Method (ERROR) </h1>
        <div class="data-display">
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Height (feet):</strong> <?php echo $userHeightFeet; ?></p>
            <p><strong>Height (inches):</strong> <?php echo $userHeightInches; ?></p>
            <p><strong>Weight (kg):</strong> <?php echo $weight; ?></p>

        </div>

        <p id="result">Your DBW by Hamwi Method is: </p>

        <form id="hamwiForm" method="post" action="save_hamwi.php">
            <input type="hidden" name="hamwi_weight" id="hamwiWeightInput" value="">
            <button type="button" id="calculate">Calculate</button>
            <button type="button" id="save">Save</button>
            <button type="button" id="back">Back to Dashboard</button>

        </form>

    </div>
    <script>
   document.getElementById('calculate').addEventListener('click', function () {
            const userGender = "<?php echo $gender; ?>";
            const userFeet = <?php echo $userHeightFeet; ?>;
            const userInches = <?php echo $userHeightInches; ?>;
            const weightInKg = <?php echo $weight; ?>;
            const resultElement = document.getElementById('result');

            if (userGender !== 'Male' && userGender !== 'Female') {
                resultElement.textContent = "Invalid gender. Please choose 'Male' or 'Female'.";
            } else if (isNaN(userFeet) || isNaN(userInches) || userFeet < 0 || userInches < 0) {
                resultElement.textContent = "Invalid height values. Please check your height inputs.";
            } else {
                const idealWeightInLbs = calculateHamwiWeight(userGender, userFeet, userInches);
                const idealWeightInKg = convertLbsToKg(idealWeightInLbs);

                resultElement.innerHTML = `Your DBW by Hamwi Method is: ${idealWeightInLbs.toFixed(2)} lbs (${idealWeightInKg.toFixed(2)} kg)`;

                // Set the calculated Hamwi weight to the hidden input
                document.getElementById('hamwiWeightInput').value = idealWeightInLbs;
            }
        });

        document.getElementById('save').addEventListener('click', function () {
            // Submit the form to save Hamwi data to the database
            document.getElementById('hamwiForm').submit();
        });

        document.getElementById('back').addEventListener('click', function () {
            window.location.href = '../../DBW/main.php'; // Adjust the path as needed
        });

        // Separate definition of the calculation and conversion functions
        function calculateHamwiWeight(gender, feet, inches) {
            const baseWeightMale = 106;
            const baseWeightFemale = 100;
            const weightPerInchMale = 6; // Updated to 6 lbs
            const weightPerInchFemale = 5; // Updated to 5 lbs
            const minHeightInFeet = 5;

            // If height is below 5 feet, set it to the minimum height
            const adjustedFeet = Math.max(feet, minHeightInFeet);

            // Calculate Hamwi weight based on gender, feet, and inches
            if (gender === 'Male' && ) {
                return baseWeightMale + (userInches * weightPerInchMale);
            } else if (gender == 'Female') {
                return  baseWeightFemale + (userInches * weightPerInchFemale);
                
            } else {

            }
        }

        function convertLbsToKg(lbs) {
            return lbs * 0.453592;
        }
    </script>
</body>
</html>
