document.addEventListener("DOMContentLoaded", function () {
    // Get the stored access token
    const token = localStorage.getItem('access_token');
    
    if (token) {
        // Fetch user profile data using the Bearer token
        fetch('http://localhost:8000/api/me', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,  // Send the token in the Authorization header
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {

                // Get the stored user id
                localStorage.setItem('id', data.id);

                // Use the profile data (e.g., displaying it on the page)
                console.log('User Profile:', data.id);

                // Display the user profile data
                document.getElementById('profile-name').textContent = data.name;
                document.getElementById('profile-email').textContent = data.email;

            } else {
                console.log('No profile data found');
                alert('Failed to load profile data');
            }
        })
        .catch(error => {
            console.error('Error fetching profile data:', error);
            alert('Error fetching profile data');
        });
    } else {
        // If there's no token, redirect the user to the login page
        window.location.href = '/login';
    }

    // Handle the logout process
    const logoutButton = document.getElementById('logout-btn');
    if (logoutButton) {
        logoutButton.addEventListener('click', function (event) {
            // Remove the access token from localStorage
            localStorage.removeItem('access_token');

            // Redirect to the login page
            window.location.href = '';
        });
    }
});