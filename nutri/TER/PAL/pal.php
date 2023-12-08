<?php
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/sessions/auth_session.php';
require_once realpath($_SERVER['DOCUMENT_ROOT']) . '/nutri/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$username = mysqli_real_escape_string($conn, $username);

// Fetch necessary user information from the database
$query = "SELECT age, weight, dbw_bmi, dbw_hamwi, dbw_tann FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $age = $row['age'];
        $userWeight = $row['weight'];

        // Determine which DBW value to display based on the selected option
        $selectedDBW = isset($_POST['pal']) ? $_POST['pal'] : '';
        switch ($selectedDBW) {
            case 'bmi':
                $dbw = $row['dbw_bmi'];
                break;
            case 'hamwi':
                $dbw = $row['dbw_hamwi'];
                break;
            case 'tann':
                $dbw = $row['dbw_tann'];
                break;
            default:
                $dbw = ''; // Set a default value or handle as needed
        }
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
    <link rel="stylesheet" href="pal.css">
    <title>PAL X DBW</title>
</head>
<body>
    <div class="container">
        
    <h1>PAL X DBW</h1>
    <table>
    <tr>
        <th>Activity Level Category/Work Intensity</th>
        <th>Sample Occupational Activities</th>
        <th>kcal/kg body weight<span>&#178;</span> </th>
    </tr>

    <tr>
        <td>Bed rest but mobile</td>
        <td></td>
        <td>27.5</td>
    </tr>

    <tr>
        <td>Sedentary</td>
        <td>MOSTLY SITTING ACTIVITIES: cashier, secretary using computers, clerk,
            typist, bank teller, computer programmer, administrator, cooking,
            ironing
        </td>
        <td>30</td>
    </tr>
    <tr>
        <td>Light</td>
        <td>Student, teacher, technician, engineer, wife with maids, nurse, doctor,
            house cleaning,golf and table tennis
        </td>
        <td>35</td>
    </tr>
    <tr>
        <td>Moderate</td>
        <td>Wife without maids, vendor running on streets, jeepney drivers,
carpenters, dancing, tennis, cycling.</td>
        <td>40</td>
    </tr>
    <tr>
        <td>Very Active or Virgorous</td>
        <td>Walking activities carrying load uphill, heavy manual activities
“cargador”, coal miners, heavy equipment operator, heavy manual
digging</td>
        <td>45</td>
    </tr>

</table>

        <label for="dbw">Choose DBW:</label>
        <select name="dbw" id="dbw">
        <option value="empty"></option>

        <option value="" <?php if ($dbw === '') echo 'selected'; ?>>Choose DBW</option>
        <option value="bmi" <?php if ($dbw === 'dbw_bmi') echo 'selected'; ?>>Body Mass Index (BMI)</option>
        <option value="hamwi" <?php if ($dbw === 'dbw_hamwi') echo 'selected'; ?>>Hamwi</option>
        <option value="tann" <?php if ($dbw === 'dbw_tann') echo 'selected'; ?>>Tannhauser</option>

        </select>


        <p><strong>DBW:</strong> <span id="selectedDBW"><?php echo $dbw; ?></span></p>
        <p><strong>Your Age:</strong> <?php echo $age; ?></p>
        <p><strong>Your Weight (kg):</strong> <?php echo $userWeight; ?></p>
        <p><strong>Enter your PAL Value:</strong></p>
        <input type="text" id="userPAL" placeholder="Enter PAL Value">
        <br>

        <p id="pal-result">Result: </p>
        <div id="pal-result"></div>


        
        <form id="palForm" method="post" action="save_pal.php">
        <input type="hidden" name="pal" id="palInput" value=""> 
        <button type="button" id="calculate" onclick="calculateTER()">Calculate</button>
        <button type="button" id="save">Save</button>
        <button type="button" id="back">Back to Dashboard</button>
        </form>
  

    <script>

//calculate button function
function calculateTER() {
    const selectedDBW = document.getElementById('dbw').value;
        const userPALInput = document.getElementById('userPAL');
        const userPALValue = userPALInput.value.trim();

        if (userPALValue === "") {
            userPALInput.setCustomValidity("Please enter a value for PAL.");
            userPALInput.reportValidity();
        } else {
            userPALInput.setCustomValidity("");
            const userPAL = parseFloat(userPALValue);

            let dbwValue;

            switch (selectedDBW) {
                case 'bmi':
                    dbwValue = <?php echo $row['dbw_bmi']; ?>;
                    break;
                case 'hamwi':
                    dbwValue = <?php echo $row['dbw_hamwi']; ?>;
                    break;
                case 'tann':
                    dbwValue = <?php echo $row['dbw_tann']; ?>;
                    break;
                default:
                    dbwValue = 0; // Set a default value or handle as needed
            }

            if (!isNaN(userPAL) && dbwValue !== 0) {
                const ter = dbwValue * userPAL;
                document.getElementById('palInput').value = ter;

                const roundedTER = Math.round(ter / 50) * 50;
                document.getElementById('pal-result').innerText = `Result: TER = ${roundedTER} kcal/day`;


            }
        }
    }

//save function
    document.getElementById('save').addEventListener('click', function () {
        const terValue = document.getElementById('palInput').value;
        if (terValue !== '' && terValue !== '0') {
            document.getElementById('palForm').submit();
        } else {
            alert('Please calculate a valid TER value.');
        }
    });

//back button function
        document.getElementById('back').addEventListener('click', function () {
            window.location.href = '../../TER/main_TER.php'; // Adjust the path as needed
        });

//dropdown function
        document.getElementById('dbw').addEventListener('change', function() {
                const selectedDBW = this.value;

                let dbwValue = 0; // Default value, in case the selection doesn't match any known DBW

                // Determine the DBW value based on the selected option
                switch (selectedDBW) {
                    case 'bmi':
                        dbwValue = <?php echo $row['dbw_bmi']; ?>;
                        break;
                    case 'hamwi':
                        dbwValue = <?php echo $row['dbw_hamwi']; ?>;
                        break;
                    case 'tann':
                        dbwValue = <?php echo $row['dbw_tann']; ?>;
                        break;
                    // Add more cases if needed for other DBW options
                }

                // Display the selected DBW value in the designated span
                document.getElementById('selectedDBW').innerText = dbwValue;
            });

            // Optionally, call this function on page load to set the initial value
            // This is to ensure that the initial DBW value is displayed
            document.addEventListener('DOMContentLoaded', function() {
                const selectedDBW = document.getElementById('dbw').value;

                let dbwValue = 0; // Default value, in case the selection doesn't match any known DBW

                // Determine the initial DBW value based on the selected option
                switch (selectedDBW) {
                    case 'bmi':
                        dbwValue = <?php echo $row['dbw_bmi']; ?>;
                        break;
                    case 'hamwi':
                        dbwValue = <?php echo $row['dbw_hamwi']; ?>;
                        break;
                    case 'tann':
                        dbwValue = <?php echo $row['dbw_tann']; ?>;
                        break;
                    // Add more cases if needed for other DBW options
                }

                // Display the initial DBW value in the designated span
                document.getElementById('selectedDBW').innerText = dbwValue;
            });
        </script>
    </div>
</body>
</html>
