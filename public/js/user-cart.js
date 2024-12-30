document.addEventListener('DOMContentLoaded', function() {
    // Get the token from localStorage
    const token = localStorage.getItem('access_token');

    if (!token) {
        alert('You are not logged in!');
        window.location.href = '/login'; // Redirect to login if there's no token
        return;
    }

    // Fetch the user's cart using the Bearer token
    fetch('http://localhost:8000/api/all-cart', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}` // Pass the token as Bearer
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.cartItems && data.cartItems.length > 0) {
            const tableBody = document.getElementById('cart-table').getElementsByTagName('tbody')[0];
            data.cartItems.forEach(cartItem => {
                let row = tableBody.insertRow();
                row.insertCell(0).textContent = cartItem.product_id;
                row.insertCell(1).textContent = cartItem.quantity;
                row.insertCell(2).textContent = cartItem.unit_price;
                row.insertCell(3).textContent = cartItem.total_price;

                let createdAtCell = row.insertCell(4);
                createdAtCell.textContent = new Date(cartItem.created_at).toLocaleString();

                let updatedAtCell = row.insertCell(5);
                updatedAtCell.textContent = new Date(cartItem.updated_at).toLocaleString();

                let actionCell = row.insertCell(6);
                actionCell.className = 'actions'; // Set class for styling
                let removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.className = 'btn remove-btn';
                removeButton.onclick = function() { removeFromCart(cartItem.product_id); };
                actionCell.appendChild(removeButton);
            });
        } else {
            alert('No items found in the cart.');
        }
    })
    .catch(error => console.error('Error loading cart items:', error));
});

// Function to remove item from cart
function removeFromCart(productId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        const token = localStorage.getItem('access_token');

        if (!token) {
            alert('You are not logged in!');
            window.location.href = '/login'; // Redirect to login if no token is present
            return;
        }

        const userId = localStorage.getItem('id');

        console.log("user-id: ", productId)
        
        const requestBody = {
            user_id: userId,
            product_id: productId
        };

        fetch('http://localhost:8000/api/remove', {
            method: 'POST', // Assuming post request to remove an item
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestBody) // Send the request body with user_id and product_id
        })
        .then(response => response.json())
        .then(data => {
            console.log('Item removed successfully:', data);
            alert('Item has been removed from the cart.');
            window.location.reload(); // Reload to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing item from cart: ' + error.message);
        });
    } else {
        console.log('Removal canceled by the user.');
    }
}
