document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("dbwForm");
    const resultDiv = document.getElementById("result");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
    });

    const calculateButton = document.getElementById("calculateButton");
    calculateButton.addEventListener("click", function () {
        const heightFeet = parseFloat(document.getElementById("heightFeet").value);
        const heightInches = parseFloat(document.getElementById("heightInches").value);

        if (isNaN(heightFeet) || isNaN(heightInches)) {
            alert("Please enter valid height values.");
            return;
        }

        // Convert height to centimeters
        const totalInches = heightFeet * 12 + heightInches;
        const heightCm = totalInches * 2.54;

        // Deduct 100 from height in centimeters
        const dbwInKg = heightCm - 100;

        // Adjust for Filipinos (deduct an additional 10%)
        const adjustedDbwInKg = dbwInKg - (0.1 * dbwInKg);

        resultDiv.textContent = `Desirable Body Weight (DBW): ${adjustedDbwInKg.toFixed(2)} kg`;
    });

 
});