function calculateBMR() {
    const gender = document.getElementById('gender').value;
    const age = parseFloat(document.getElementById('age').value);
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);
  
    let bmr;
  
    if (gender === 'male' || 'Male') {
      bmr = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
    } else if (gender === 'female' || 'Female') {
      bmr = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
    }
  
    document.getElementById('result').innerText = `Basal Metabolic Rate (BMR): ${bmr.toFixed(2)} calories/day`;
  }
  