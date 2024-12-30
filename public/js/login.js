document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById('login-form');
    
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Send login request to backend
        fetch('http://localhost:8000/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.access_token) {
                // Store the token in localStorage
                localStorage.setItem('access_token', data.access_token);

                // Log the access token to the console for debugging
                console.log('Access Token:', data.access_token);

                // Show success message
                showAlert('Login successful!', 'success');

                // After login, fetch user data to determine role
                fetch('http://localhost:8000/api/me', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${data.access_token}`,
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(userData => {
                    if (userData.role === 'admin') {
                        // Redirect to admin dashboard
                        setTimeout(() => {
                            window.location.href = '/api/auth/admin-dashboard';
                        }, 2000);
                    } else {
                        // Redirect to normal user dashboard
                        setTimeout(() => {
                            window.location.href = '/api/auth/dashboard';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error fetching user role:', error);
                    showAlert('An error occurred while fetching user data.', 'error');
                });

            } else {
                // Show failure message
                showAlert('Login failed. Please check your credentials.', 'error');
                console.log('Login failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred during login. Please try again.', 'error');
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
