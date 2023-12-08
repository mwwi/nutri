<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_TER.css">
    <title>TER and BMR Calculation</title>
</head>
<body>
    <header>
        <h1>TER and BMR Calculation</h1>
    </header>
 <!--
    <nav>
        <ul>
            <li><a href="">PAL</a></li>
            <li><a href="">Harris</a></li>
            <li><a href="">Mifflin</a></li>
            <li><a href="">Oxford</a></li>

        </ul>
    </nav>
-->
    <main class=">
    <div class="container">
        <div class="buttons">

        <button class="button" onclick="location.href='PAL/pal.php'">PAL</button>
            <button class="button" onclick="location.href='Harris/harris.php'">Harris</button>
            <button class="button" onclick="location.href='Mifflin/mifflin.php'">Mifflin</button>
            <button class="button" onclick="location.href='Henry/henry.php'">Oxford</button>
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
