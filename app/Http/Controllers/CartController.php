<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // showAllCart
    public function showUserCart(Request $request)
    {
        return view('auth.user-cart');  // Ensure this view exists
    }

    /**
     * Display all items in the cart.
     */
    public function viewCart()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized access. Only user can view cart.'], 403);
        }

        $userId = auth()->id();
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

        return response()->json(['cart' => $cartItems]);
    }

    /**
     * Add a new item to the cart.
     */
    public function addToCart(Request $request)
    {
        if (Auth::user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized access. Only user can add to cart.'], 403);
        }
    
        $userId = $request->input('user_id');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $unitPrice = $request->input('unit_price', 1);
    
        $product = Product::where('product_id', $productId)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->unit_price = $unitPrice;
            $cartItem->save();  // total_price will be calculated automatically by the database
        } else {
            $cartItem = CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice
            ]);
        }
    
        // Fetch the product details from the cart unique to the product ID
        $cartItemDetails = CartItem::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

        return response()->json([
            'message' => 'Product added to cart',
            'cartItem' => $cartItemDetails
        ]);
    }
    
    
     
    

    /**
     * Remove an item in the cart.
     */
    public function removeFromCart(Request $request)
    {
        // Check if the authenticated user is a user
        if (Auth::user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized access. Only users can remove items from the cart.'], 403);
        }
    
        $userId = $request->input('user_id'); // Using authenticated user's ID for security
        $productId = $request->input('product_id');
    
        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if (!$cartItem) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }
    
        // Decrement the quantity or delete if it hits zero
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }
    
        return response()->json(['message' => 'Product quantity updated or removed from cart', 'cartItem' => $cartItem]);
    }
    

    /**
     * Remove an item from the cart.
     */
    public function deleteCart($id)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized access. Only user can delete from cart.'], 403);
        }

        $userId = auth()->id();
        $cartItem = CartItem::where('user_id', $userId)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Item removed from cart']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    /**
     * Retrieve all cart items for a specific user.
     */
    public function getCartItems()
    {
        // Assuming 'auth:api' middleware is used in the route or controller constructor
        if (Auth::user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized access. Only user can view cart.'], 403);
        }

        // Use Auth::id() to ensure the authenticated user is querying their own cart
        $userId = auth()->id();// Ensures that the user can only access their own cart data

        $cartItems = CartItem::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'No items in the cart'], 404);
        }

        return response()->json([
            'message' => 'Cart items retrieved successfully',
            'cartItems' => $cartItems
        ]);
    }


}
