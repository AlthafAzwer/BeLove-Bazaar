<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Bid;
use App\Models\CharityRequest;
use App\Models\Order;
use App\Models\Auction;
use App\Models\Review;
use App\Models\RecentView;

class PersonalizedDashboardController extends Controller
{
    

public function index()
{
    $userId = Auth::id();

    $totalProducts = Product::where('user_id', $userId)->count();
    $totalBids = Bid::where('user_id', $userId)->count();
    $activeCharities = CharityRequest::where('user_id', $userId)->where('status', 'approved')->count();
    $totalOrders = Order::where('buyer_id', $userId)->count();
    $totalAuctions = Auction::where('user_id', $userId)->count();
    $totalReviews = Review::where('user_id', $userId)->count();

    // Fetch recently viewed products
    $viewedProducts = RecentView::with('product') // Eager load the related product
    ->where('user_id', $userId)
    ->latest()
    ->limit(5)
    ->get();


    // Fetch recommendations
    $recentPrice = $viewedProducts->first()?->price ?? 0;

    // Fetch recommendations based on price range
    $recommendations = Product::where('status', 'approved')
        ->whereBetween('price', [$recentPrice - 2000, $recentPrice + 2000])
        ->inRandomOrder()
        ->limit(5)
        ->get();

    return view('personalized_dashboard.index', compact(
        'totalProducts', 'totalBids', 'activeCharities', 'totalOrders',
        'totalAuctions', 'totalReviews', 'viewedProducts', 'recommendations'
    ));
}

}
