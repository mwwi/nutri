function calculateTER() {
    // Get the selected TER value from the dropdown
    var selectedTER = document.getElementById("ter").value;

    // Get the total caloric intake from the server-side code (assumed to be stored in the 'ter' variable)
    var kcal = parseFloat(<?php echo json_encode($ter); ?>);

    // Calculate macronutrient amounts based on caloric distribution
    var carbs = (kcal * 0.65) / 4;
    var protein = (kcal * 0.15) / 4;
    var fat = (kcal * 0.20) / 9;

    // Adjust macronutrient amounts based on physiological fuel values
    var adjustedCarbs = carbs * 1;  // Replace '1' with the actual carbohydrate fuel value
    var adjustedProtein = protein * 1;  // Replace '1' with the actual protein fuel value
    var adjustedFat = fat * 1;  // Replace '1' with the actual fat fuel value

    // Display or use the calculated values as needed
    document.getElementById("diet-descInput").value = "Carbs: " + adjustedCarbs + ", Protein: " + adjustedProtein + ", Fat: " + adjustedFat;