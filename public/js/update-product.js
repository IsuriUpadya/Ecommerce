document.addEventListener('DOMContentLoaded', function() {
    const productId = document.getElementById('product_id').value;
    console.log('Product ID : ', productId);

    // Fetch product details to populate the form
    fetch(`http://localhost:8000/api/auth/details/${productId}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('access_token')}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.product) {
            document.getElementById('product_name').value = data.product.product_name;
            document.getElementById('qty').value = data.product.qty;
            document.getElementById('unitprice').value = data.product.unitprice;
            // Update image preview if available
            if (data.product.image) {
                document.getElementById('image-preview').src = `/storage/${data.product.image}`;
            }
        }
    })
    .catch(error => console.error('Error loading the product:', error));

    // Handle form submission
    const form = document.getElementById('update-product-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(form);
        formData.append('product_name', document.getElementById('product_name').value);
        formData.append('qty', document.getElementById('qty').value);
        formData.append('unitprice', document.getElementById('unitprice').value);
        
        // Append image file if selected
        const imageFile = document.getElementById('product_image').files[0];
        if (imageFile) {
            formData.append('image', imageFile);
        }

        fetch(`http://localhost:8000/api/auth/update/${productId}`, {
            method: 'POST', // Use POST for FormData with file upload
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                // 'Content-Type': 'multipart/form-data' will be set automatically by the browser
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data.message);
            showAlert('Product updated successfully!', 'success');
            // Redirect to login page after a short delay
            setTimeout(() => {
                window.location.href = '/api/auth/all-products';
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Product update failed. Please try again.', 'error');
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



