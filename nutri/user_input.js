document.addEventListener('DOMContentLoaded', function () {
    const nextButton = document.getElementById('next-button');
    const userInformationContainer = document.querySelector('.user-info-container');
    const calculationContainer = document.querySelector('.calculation-container');
    const containerPAL = document.querySelector('.container-pal');
    const proceedButton = document.getElementById('proceed-button');

    const userInfoForm = document.getElementById('user-info-form');
    const calculationForm = document.getElementById('calculate-weight-form');
    const chooseFormula = document.getElementById('choose-formula');
    const resultElement = document.getElementById('result');

    let dbwResult; // Variable to store the DBW result

    // Initially, only the user information container is visible
    userInformationContainer.style.display = 'block';
    calculationContainer.style.display = 'none'; // Hide calculation container initially
    containerPAL.style.display = 'none'; // Hide container-pal initially

    if (userInfoForm && calculationForm && chooseFormula && resultElement){

        calculationForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Fetch user information
            const gender = document.getElementById('gender').value;
            const age = document.getElementById('age').value;
            const heightFeet = parseInt(document.getElementById('height-feet').value);
            const heightInches = parseInt(document.getElementById('height-inches').value);
            const weight = document.getElementById('weight').value;

            // Get the selected formula
            const selectedFormula = chooseFormula.value;

            if (selectedFormula === 'hamwi') {
                // Implement your Hamwi formula calculation here
                dbwResult = calculateHamwi(gender, age, heightFeet, heightInches);
            } else if (selectedFormula === 'bmi') {
                // Implement your BMI formula calculation here
                dbwResult = calculateBMI(heightFeet, heightInches, weight, gender, age);
            } else if (selectedFormula === 'tanhauser') {
                // Implement your Tanhauser formula calculation here
                dbwResult = calculateTanhauser(heightFeet, heightInches, gender);
            }

            // Display the result
            resultElement.innerHTML = `Desirable Body Weight: ${dbwResult}`;

            // Show the calculation container and hide the others
            calculationContainer.style.display = 'block';
            containerPAL.style.display = 'none';
        });
    }

    // Add a click event listener to the Proceed button for TER calculation
    if (proceedButton && containerPAL) {
        proceedButton.addEventListener('click', function () {
            // Show all three containers: user information, calculation, and container-pal
            userInformationContainer.style.display = 'block';
            calculationContainer.style.display = 'block';
            containerPAL.style.display = 'block';
            // Pass the dbwResult to the TER calculation
            calculateTER(dbwResult);
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', function () {
            // Show the user information and calculation containers
            userInformationContainer.style.display = 'block';
            calculationContainer.style.display = 'block';
        });
    }

    function calculateHamwi(gender, age, heightFeet, heightInches) {
        const heightInInches = heightFeet * 12 + heightInches;
        let baseWeight;
    
        if (gender === 'male') {
            baseWeight = 106; // Base weight for males
            return baseWeight + (heightInInches - 60) * 6;
        } else if (gender === 'female') {
            baseWeight = 100; // Base weight for females
            return baseWeight + (heightInInches - 60) * 5;
        } else {
            return 0; // Handle invalid gender input
        }
    }

    function calculateBMI(heightFeet, heightInches, weight, gender, age) {
        const heightInInches = heightFeet * 12 + heightInches;
        const heightInMeters = heightInInches * 0.0254;
        const bmi = Math.round((heightInMeters * heightInMeters) * 22);
        return bmi;
    }
    

    function calculateTanhauser(heightFeet, heightInches, gender) {
        const heightInInches = heightFeet * 12 + heightInches;
        const heightInCentimeters = heightInInches * 2.54;
        let dbw = heightInCentimeters - 100;
        dbw -= 0.10 * dbw;
        return Math.round(dbw);
    }
    
    
});
