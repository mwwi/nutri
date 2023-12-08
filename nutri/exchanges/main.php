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
        $selectedTER = $_POST['ter']; // Assuming the form is submitted using POST
        switch ($selectedTER) {
            case 'pal':
                $ter = $row['pal'];
                break;
            case 'harris':
                $ter = $row['harris'];
                break;
            case 'mifflin':
                $ter = $row['mifflin'];
                break;
            case 'oxford':
                $ter = $row['oxford'];
                break;
            default:
                $ter = ''; // Set a default value or handle as needed
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
    <link rel="stylesheet" href="main.css"/>

    <title>Distribution of Exchanges</title>
</head>
<body>
    
    <label for="ter">Choose TER (kcal):</label>
    <select name="ter" id="ter">
        <option value="empty"></option>
        <option value="pal" <?php if ($selectedTER === 'pal') echo 'selected'; ?>>PAL</option>
        <option value="harris" <?php if ($selectedTER === 'harris') echo 'selected'; ?>>Harris</option>
        <option value="mifflin" <?php if ($selectedTER === 'mifflin') echo 'selected'; ?>>Mifflin</option>
        <option value="oxford" <?php if ($selectedTER === 'oxford') echo 'selected'; ?>>Oxford</option>
    </select>

    <p> Dietary Prescription</p>
    <p> Fat: </p>
    <p> Protein: </p>
    <p> Dietary Prescription</p>

    <p> Distribution of Exchanges </p>
    
    <table>
        <tr>
            <th>Macronutrient</th>
            <th>Amount (g)</th>
        </tr>
        <tr>
            <td>Carbs</td>
            <td id="carbsOutput"></td>
        </tr>
        <tr>
            <td>Protein</td>
            <td id="proteinOutput"></td>
        </tr>
        <tr>
            <td>Fat</td>
            <td id="fatOutput"></td>
        </tr>
    </table>

    <form id="diet-presc" method="post" action="save_main.php">
        <input type="hidden" name="diet-desc" id="diet-descInput" value=""> 
        <button type="button" id="calculate" onclick="calculateTER()">Calculate</button>
        <button type="button" id="save">Save</button>
        <button type="button" id="back">Back to Dashboard</button>
    </form>

    <script>
        function calculateTER() {
            // Get the selected TER value from the dropdown
            var selectedTER = document.getElementById("ter").value;

            // Get the total caloric intake from the server-side code (assumed to be stored in the 'ter' variable)
            var kcal = parseFloat(<?php echo json_encode($ter); ?>);

            // Calculate macronutrient amounts based on caloric distribution
            var carbs = (kcal * 0.65) / 4;
            var protein = (kcal * 0.15) / 4;
            var fat = (kcal * 0.20) / 9;

            // Display or use the calculated values as needed
            document.getElementById("diet-descInput").value = "Carbs: " + carbs + ", Protein: " + protein + ", Fat: " + fat;
            
            // Update the table cells with the calculated values
            document.getElementById("carbsOutput").textContent = carbs.toFixed(2);
            document.getElementById("proteinOutput").textContent = protein.toFixed(2);
            document.getElementById("fatOutput").textContent = fat.toFixed(2);
        }
    </script>
    
</body>
</html>