<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show the order creation form for a specific product.
     */
    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    /**
     * Store a new order in the database.
     */
    public function store(Request $request, Product $product)
{
    $request->validate([
        'buyer_name' => 'required|string',
        'buyer_address' => 'required|string',
        'buyer_telephone' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    Order::create([
        'product_id' => $product->id,
        'buyer_id' => Auth::id(), // Capture the buyer's user ID
        'buyer_name' => $request->buyer_name,
        'buyer_address' => $request->buyer_address,
        'buyer_telephone' => $request->buyer_telephone,
        'payment_method' => $request->payment_method,
        'status' => 'Pending',
    ]);

    return redirect()->route('buyer.orders')->with('success', 'Order placed successfully.');
}


    /**
     * Show the seller's orders where the product belongs to the authenticated seller.
     */
    public function sellerOrders()
{
    // Fetch orders where the product's owner is the logged-in user (seller)
    $orders = Order::whereHas('product', function ($query) {
        $query->where('user_id', Auth::id());
    })->get();

    return view('orders.seller_orders', compact('orders'));
}

public function update(Request $request, Order $order)
{
    // Ensure the authenticated user is the seller of the product
    if ($order->product->user_id !== Auth::id()) {
        return redirect()->route('seller.orders')->with('error', 'Unauthorized action.');
    }

    $request->validate([
        'status' => 'required|string|in:Pending,Shipped,Completed'
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('seller.orders')->with('success', 'Order status updated.');
}


    public function buyerOrders()
{
    // Fetch all orders placed by the authenticated buyer
    $orders = Order::where('buyer_id', Auth::id())->get();

    return view('orders.buyer_orders', compact('orders'));
}

}
