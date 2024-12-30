document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById('register-form');
    
    registerForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(registerForm);
        
        // Create an object from the form data
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            password: formData.get('password'),
            password_confirmation: formData.get('password_confirmation'),
        };

        // Send the registration request to the backend API
        fetch('http://localhost:8000/api/auth/admin-register', {
            method: 'POST',
            headers: {
                // 'Authorization': `Bearer ${token}`,  // Send the token in the Authorization header
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: data.name,
                email: data.email,
                password: data.password,
                password_confirmation: data.password_confirmation,
                role: "admin",
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.access_token) {
                // Show success message
                showAlert('Registration successful!', 'success');
                // Redirect to login page after a short delay
                setTimeout(() => {
                    window.location.href = '/api/auth/login'; // Redirect to login
                }, 2000);
            } else {
                // Show error message
                showAlert(data.message || 'Registration failed. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error during registration:', error);
            showAlert('An error occurred during registration. Please try again.', 'error');
        });
    });
});

// Function to show alert messages
function showAlert(message, type) {
    const alertBox = document.createElement('div');
    alertBox.classList.add('alert', type);  // Add 'alert' and the 'type' (success or error)
    alertBox.textContent = message;
    
    // Append the alert box to the body
    document.body.appendChild(alertBox);
    
    // Automatically remove the alert after 4 seconds
    setTimeout(() => {
        alertBox.remove();
    }, 4000);
}
