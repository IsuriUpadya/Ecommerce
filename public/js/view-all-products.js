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
        const tableBody = document.getElementById('products-table').getElementsByTagName('tbody')[0];
        data.products.forEach(product => {
            let row = tableBody.insertRow();
            row.insertCell(0).textContent = product.product_id;
            row.insertCell(1).textContent = product.product_name;
            row.insertCell(2).textContent = product.qty;
            row.insertCell(3).textContent = product.unitprice;

            let imgCell = row.insertCell(4);
            if (product.image) {
                let img = document.createElement('img');
                img.src = `/storage/${product.image}`;
                img.style.width = '50px';
                imgCell.appendChild(img);
            } else {
                imgCell.textContent = 'No image';
            }

            let actionCell = row.insertCell(5);
            actionCell.className = 'actions'; // Set class for alignment
            let updateButton = document.createElement('button');
            updateButton.textContent = 'Update';
            updateButton.className = 'btn update-btn';
            updateButton.onclick = function() { updateProduct(product.product_id); }; // Changed from product.id to product.product_id
            actionCell.appendChild(updateButton);

            let deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.className = 'btn delete-btn';
            deleteButton.onclick = function() { deleteProduct(product.product_id); }; // Changed from product.id to product.product_id
            actionCell.appendChild(deleteButton);
        });
    })
    .catch(error => console.error('Error loading the products:', error));
});

function updateProduct(product_id) {
    console.log('Update product ID:', product_id);
    //const baseUrl = 'http://localhost:8000/api/auth/update-products'; // Ensure this attribute is set in the HTML body tag
    // const editUrl = `${baseUrl}${product_id}`; // Correctly append the product ID to the URL
    //const editUrl = `${baseUrl}`; // Correctly append the product ID to the URL
    window.location.href = `/api/auth/details-show/${product_id}` // Redirect the user to the update page
}

function deleteProduct(product_id) {
    // Ask user for delete confirmation
    if (confirm('Are you sure you want to delete this product?')) {
        console.log('Delete product ID:', product_id);
        fetch(`http://localhost:8000/api/auth/delete/${product_id}`, {
            method: 'DELETE', // Assuming the server is expecting a DELETE request
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`, // Include the authorization header if needed
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to delete the product');
            }
            return response.json();
        })
        .then(data => {
            console.log('Product deleted successfully:', data);
            alert('Product has been deleted successfully.');
            // Redirect to the view all products page after successful deletion
            window.location.href = '/api/auth/all-products'; // Update this URL to your actual view all products page URL
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting product: ' + error.message);
        });
    } else {
        console.log('Deletion canceled by the user.');
    }
}
