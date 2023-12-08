document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');

    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // Get the form data
            const formData = new FormData(loginForm);

            // Send the form data to the server
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to 'main_page.html' on successful login
                    window.location.href = 'user_main_page.html';
                } else {
                    // Display an error message for unsuccessful login
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
