document.addEventListener('DOMContentLoaded', function () {
    const calculateButton = document.getElementById('calculateButton');
    const resultElement = document.getElementById('result');

    calculateButton.addEventListener('click', function () {
        const gender = document.getElementById('gender').value;
        const weight = parseFloat(document.getElementById('weight').value);
        const age = parseFloat(document.getElementById('age').value);

        if (isNaN(weight) || isNaN(age)) {
            resultElement.innerHTML = 'Please enter valid values.';
            return;
        }

        let bmr;
        if (gender === 'male') {
            if (age >= 18 && age < 30) {
                bmr = (weight * 16.0) + 545;
            } else if (age >= 30 && age < 60) {
                bmr = (weight * 14.2) + 593;
            } else if (age >= 60 && age < 70) {
                bmr = (weight * 13.0) + 567;
            } else if (age >= 70) {
                bmr = (weight * 13.7) + 481;
            }
        } else if (gender === 'female') {
            if (age >= 18 && age < 30) {
                bmr = (weight * 13.1) + 558;
            } else if (age >= 30 && age < 60) {
                bmr = (weight * 9.74) + 694;
            } else if (age >= 60 && age < 70) {
                bmr = (weight * 10.2) + 572;
            } else if (age >= 70) {
                bmr = (weight * 13.7) + 577;
            }
        }

        resultElement.innerHTML = `Your BMR is approximately ${bmr.toFixed(2)} calories per day.`;
    });
});