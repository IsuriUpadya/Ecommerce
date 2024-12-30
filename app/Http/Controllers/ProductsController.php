<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use Illuminate\Support\Facades\Auth; // User authentication

class ProductsController extends Controller
{

    // Show the registration form
    public function showAdminProducts()
    {
        return view('auth.admin-products');  // Ensure this view exists
    }

    // showAddProducts
    public function showAddProducts()
    {
        return view('auth.add-products');  // Ensure this view exists
    }

    // showAllProducts
    public function showAllProducts()
    {
        return view('auth.view-all-products');  // Ensure this view exists
    }

    // showAllProductsUser
    public function showAllProductsUser()
    {
        return view('auth.view-all-products-user');  // Ensure this view exists
    }

    // showUpdateProduct
    public function showUpdateProduct($product_id)
    {
        $product = Product::where('product_id', $product_id)->first(); // Retrieve the product by its ID
    
        if (!$product) {
            // Handle the case where no product is found
            return redirect()->route('some-route-name')->with('error', 'Product not found.');
        }
    
        return view('auth.update-product', compact('product')); // Pass the product to the view
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Make sure to handle the case where the product does not exist
        return view('auth.update-product', compact('product'));
    }

    /**
     * Retrieve and display the details of a specific product by product_id.
     *
     * @param  string  $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductDetails($product_id)
    {
        // Attempt to find the product using the provided ID
        $product = Product::where('product_id', $product_id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404); // Return a 404 Not Found response if no product is found
        }

        // If the product is found, return the product details
        return response()->json([
            'message' => 'Product retrieved successfully.',
            'product' => $product,
        ]);
    }

    // Add Product
    public function add(AddProductRequest $request)
    {

        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized access. Only admins can add products.'], 403);
        }

        // Generate a unique product ID
        $productId = 'PROD-' . strtoupper(Str::random(8));

        // Validate the request and store the result in $validated
        $validated = $request->validate(            [
            'product_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'image' => 'sometimes|file|image|max:1024',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('product_images', 'public') : null;

        // Create product
        $product = Product::create([
            'product_id' =>  $productId,
            'product_name' => $request->input('product_name'),
            'qty' => $request->input('qty'),
            'unitprice' => $request->input('unitprice'),
            'image' => $path,
        ]);

        
        return response()->json([
            'message' => 'Product added successfully.',
            'product' => $product,
        ]);

    }

    // View All products
    public function viewAllProducts()
    {

            // Manually check if the user is authenticated
    if (!auth()->check()) {
        return response()->json([
            'message' => 'Invalid or missing token. Authorization is required.'
        ], 401); // HTTP 401 Unauthorized
    }


        // Fetch all products from the database
        $products = Product::all();

        // Return products as a JSON response
        return response()->json([
            'message' => 'Products retrieved successfully.',
            'products' => $products,
        ]);
    }

    /**
     * Update the specified product by product_id.
     *
     * @param  Request  $request
     * @param  string  $product_id
     * @return JsonResponse
     */
    public function update(Request $request, string $product_id)
    {
        // Validate the incoming request including the image as optional
        $request->validate([
            'product_name' => 'sometimes|string|max:255',
            'qty' => 'sometimes|integer|min:1',
            'unitprice' => 'sometimes|numeric|min:0',
            'image' => 'sometimes|image|max:10240', // Validate the image
        ]);

        // Find the product by product_id
        $product = Product::where('product_id', $product_id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }

        // Update the product with validated data
        $product->update($request->only(['product_name', 'qty', 'unitprice']));

        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            // Handle the image upload
            $path = $request->file('image')->store('product_images', 'public');

            // Update the product record with the new image path
            $product->image = $path;
            $product->save(); // Save the updated product
        }

        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $product,
        ]);
    }


    // Delete product
    /**
     * Delete a product by its product_id.
     *
     * @param string $product_id
     * @return JsonResponse
     */
    public function delete(string $product_id)
    {
        // Find the product by product_id
        $product = Product::where('product_id', $product_id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404); // HTTP 404 Not Found
        }

        // Delete the product
        $product->delete();

        return response()->json([
            'message' => "Product with ID {$product_id} deleted successfully.",
        ]);
    }
}
