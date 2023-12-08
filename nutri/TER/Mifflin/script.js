function calculateMetabolicRates() {
    const gender = document.getElementById('gender').value;
    const age = parseFloat(document.getElementById('age').value);
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);
  
    let bmr;
    let rmr;
  
    if (gender === 'male') {
      // Harris-Benedict Equation for BMR
      bmr = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
      
      // Mifflin-St Jeor Equation for RMR
      rmr = 9.99 * weight + 6.25 * height - 4.92 * age + 5;
    } else if (gender === 'female') {
      // Harris-Benedict Equation for BMR
      bmr = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
      
      // Mifflin-St Jeor Equation for RMR
      rmr = 9.99 * weight + 6.25 * height - 4.92 * age - 161;
    }
  
    document.getElementById('result').innerHTML = `
      Basal Metabolic Rate (BMR): ${bmr.toFixed(2)} calories/day<br>
      Resting Metabolic Rate (RMR): ${rmr.toFixed(2)} calories/day`;
  }
  