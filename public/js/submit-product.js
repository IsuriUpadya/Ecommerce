document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form fields
        const productName = document.getElementById('product_name').value;
        const unitprice = document.getElementById('unitprice').value;
        const qty = document.getElementById('qty').value;
        const imageFile = document.getElementById('image').files[0];

        // Prepare form data
        const formData = new FormData();
        formData.append('product_name', productName);
        formData.append('qty', qty);
        formData.append('unitprice', unitprice);
        if (imageFile) {
            formData.append('image', imageFile);
        }

        // Get the stored access token
        const token = localStorage.getItem('access_token');

        fetch('http://localhost:8000/api/product/store', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                // Handle 422 status code (validation error)
                if (response.status === 422) {
                    return response.json().then(data => {
                        // Show the exact error message from the response
                        const errMsg = data && data.message ? data.message : 'Validation error occurred (422).';
                        showAlert(errMsg, 'error');
                        // Reject to skip the success .then block
                        return Promise.reject(errMsg);
                    }).catch(() => {
                        // If parsing JSON fails, try text
                        return response.text().then(text => {
                            const errMsg = text || 'Validation error occurred (422).';
                            showAlert(errMsg, 'error');
                            return Promise.reject(errMsg);
                        });
                    });
                } else {
                    // Handle other non-OK responses
                    return response.json().then(data => {
                        const errMsg = data && data.message ? data.message : 'An error occurred while adding the product.';
                        showAlert(errMsg, 'error');
                        return Promise.reject(errMsg);
                    }).catch(() => {
                        return response.text().then(text => {
                            const errMsg = text || 'An unknown error occurred while adding the product.';
                            showAlert(errMsg, 'error');
                            return Promise.reject(errMsg);
                        });
                    });
                }
            }
            // If response is okay, parse the JSON
            return response.json();
        })
        .then(data => {
            // On success, show success message
            if (data && data.message) {
                showAlert(data.message, 'success');
                setTimeout(() => {
                    window.location.href = '/api/auth/all-products';
                }, 2000);
            } else {
                showAlert("Product added successfully!", 'success');
                setTimeout(() => {
                    window.location.href = '/api/auth/all-products';
                }, 2000);
            }
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
            // Since we've already shown the alert in the error sections above, 
            // we do not need to show another alert here.
        });
    });
});

// Function to show alert messages (success or error)
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
