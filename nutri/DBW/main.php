<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>DBW</title>
</head>
<body>
    <header>
        <h1>DBW</h1>
    </header>
    <!-- 
    <nav>
        <ul>
            <li><a href="Tanhauser/index.html">Tanhauser</a></li>
            <li><a href="BMI/index.html">BMI</a></li>
            <li><a href="Hamwi/index.html">Hamwi</a></li>
        </ul>
    </nav>
--> 
    <main class=">
    <div class="container">
        <div class="buttons">

            <button class="button" onclick="location.href='bmi/bmi.php'">BMI Method </button>
            <button class="button" onclick="location.href='hamwi/hamwi.php'">Hamwi Method</button>
            <button class="button" onclick="location.href='Tanhauser/tannhauser.php'">Tannhauser Method </button>
            <button type="button" class="button button-back" id="back">Back to Dashboard</button>

        </div>
    </div>
    </main>
    <footer>
        <!-- Footer content goes here -->
    </footer>
    <script>
       // Button event handler for going back to the dashboard
       document.getElementById('back').addEventListener('click', function () {
           // Redirect the user to the dashboard page
           window.location.href = '../user_main_page.php'; // Adjust the path as needed
       });
    </script>
</body>
</html>
