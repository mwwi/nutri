document.addEventListener("DOMContentLoaded", function () {
    const genderSelect = document.getElementById("gender");
    const feetInput = document.getElementById("feet");
    const inchesInput = document.getElementById("inches");
    const calculateButton = document.getElementById("calculate");
    const resultElement = document.getElementById("result");

    calculateButton.addEventListener("click", function () {
        const userGender = genderSelect.value.toLowerCase();
        const feet = parseInt(feetInput.value);
        const inches = parseInt(inchesInput.value);

        if (userGender !== 'male' && userGender !== 'female') {
            resultElement.textContent = "Invalid gender selection. Please choose 'Male' or 'Female'.";
        } else if (isNaN(feet) || isNaN(inches)) {
            resultElement.textContent = "Invalid input. Please check your height values.";
        } else {
            const idealWeightInLbs = calculateHamwiWeight(userGender, feet, inches);
            const idealWeightInKg = lbsToKg(idealWeightInLbs);
            resultElement.textContent = `The ideal body weight for a ${userGender} with a height of ${feet} feet ${inches} inches is ${idealWeightInLbs} pounds (${idealWeightInKg.toFixed(2)} kilograms).`;
        }
    });
});
