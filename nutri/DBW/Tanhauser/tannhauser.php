<?php
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

$username = $_SESSION['username'];

$query = "SELECT height_in_cm FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userHeightCM = $row['height_in_cm'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBW by Tannhauser Method</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <h1>DBW by Tannhauser Method</h1>
        <div class="data-display">
            <p><strong>Height (cm):</strong> <?php echo $userHeightCM; ?></p>

        </div>

        <p id="result">Your DBW by Tannhauser Method is: </p>
        <form id="tannForm" method="post" action="save_tann.php">
            <input type="hidden" name="tann" id="tannInput" value="">
            <button type="button" id="calculate">Calculate</button>
            <button type="button" id="save">Save</button>
            <button type="button" id="back">Back to Dashboard</button>

        </form>

    </div>


    <script>

document.getElementById('calculate').addEventListener('click', function () {
            const userHeightCM = <?php echo $userHeightCM; ?>;
            const resultElement = document.getElementById('result');

            if (isNaN(userHeightCM) || userHeightCM <= 0) {
                resultElement.textContent = "Invalid height value. Please check your height input.";
            } else {
                const dbw = calculateTannhauserDBW(userHeightCM);
                resultElement.textContent = `Your DBW by Tannhauser Method is: ${parseInt(dbw)}kg`;

                // Set the calculated Tannhauser weight to the hidden input
                document.getElementById('tannInput').value = parseInt(dbw);
            }
        });


        document.getElementById('save').addEventListener('click', function () {
            document.getElementById('tannForm').submit();
        });

        function calculateTannhauserDBW(heightInCM) {
            const dbw = (heightInCM - 100) - 0.1 * (heightInCM - 100);
            return dbw;
        }

        document.getElementById('back').addEventListener('click', function () {
            window.location.href = '../../DBW/main.php'; // Adjust the path as needed
        });


    </script>
</body>
</html>