document.addEventListener('DOMContentLoaded', function() {

    fetch('/api/view-all-products', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('access_token')}`
        }
    })
    .then(response => response.json())
    .then(data => {
        const productsContainer = document.getElementById('products-container');
        data.products.forEach(product => {
            const card = createProductCard(product);
            productsContainer.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading the products:', error));
});

function createProductCard(product) {
    const card = document.createElement('div');
    card.className = 'product-card';

    const img = document.createElement('div');
    img.className = 'product-image';
    img.style.backgroundImage = `url('/storage/${product.image || 'default-image.jpg'}')`;
    card.appendChild(img);

    const info = document.createElement('div');
    info.className = 'product-info';
    info.innerHTML = `
        <p><strong>${product.product_name}</strong></p>
        <p>Qty: ${product.qty}</p>
        <p>Price: $${product.unitprice}</p>
    `;
    card.appendChild(info);

    const addToCartButton = document.createElement('button');
    addToCartButton.className = 'btn cart-btn';
    addToCartButton.textContent = 'Add to Cart';
    addToCartButton.onclick = () => addToCart(product.product_id, product.product_name, product.unitprice);
    card.appendChild(addToCartButton);

    return card;
}

function addToCart(product_id, product_name, product_unitprice) {
    // console.log('Add to Cart product ID:', product_id);
    // alert(`Added ${product_name} to cart successfully!`); // Placeholder for actual cart functionality

            // Get the stored access token
            const token = localStorage.getItem('access_token');
            const id = localStorage.getItem('id');
    
            console.log("User ID : ", id)
            console.log("Access token : ", token)


    // Send the registration request to the backend API
    fetch('http://localhost:8000/api/cart', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,  // Send the token in the Authorization header
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            user_id: id,
            product_id: product_id,
            unit_price: product_unitprice
        }),
        })
        .then(response => response.json())
        .then(data => {
        if (data) {
            // Show success message
            showAlert(`Added ${product_name} to cart successfully!`, 'success');
            // Redirect to login page after a short delay
            setTimeout(() => {
                window.location.href = '/api/auth/user-all-products'; // Redirect to login
            }, 2000);
        } else {
            // Show error message
            showAlert(data.message || 'Product added failed. Please try again.', 'error');
        }
        })
        .catch(error => {
            console.error('Error during adding to cart:', error);
            showAlert('An error occurred during adding to cart. Please try again.', 'error');
        });
}

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
