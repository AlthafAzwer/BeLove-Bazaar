<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AuctionOrderController;



// Welcome page
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Registration and Login Routes (accessible without authentication)
Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Email Verification Routes (for regular users only)
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth', 'unverified', RoleMiddleware::class . ':buyer,seller,charity'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login')->with('status', 'Your email has been verified. Please log in.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Redirect for home route after login
Route::get('/home', function () {
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('home');

// Redirect route for 'dashboard' to avoid RouteNotFoundException error
Route::get('/dashboard', function () {
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Interface Routes (specific to non-admin users)
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':buyer,seller,charity'])->group(function () {
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/products', [HomeController::class, 'showProducts'])->name('products'); // Display products
    Route::get('/donations', [HomeController::class, 'donations'])->name('donations');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/my-ads', [ProductController::class, 'myAds'])->name('my.ads')->middleware(['auth', 'verified']);
    Route::get('/products/{id}', [HomeController::class, 'showProductDetails'])->name('products.show');
    Route::get('/orders/create/{product}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/{product}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])->name('seller.orders');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/buyer/orders', [OrderController::class, 'buyerOrders'])->name('buyer.orders');
    Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])->name('seller.orders');
    Route::patch('/orders/{order}/update-status', [OrderController::class, 'update'])->name('orders.update-status');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/admin/orders/{id}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
    Route::get('/charity/request', [CharityController::class, 'create'])->name('charity.request');
    Route::post('/charity/request', [CharityController::class, 'store'])->name('charity.request.store');
    Route::get('/charity/my-requests', [CharityController::class, 'myRequests'])->name('charity.myRequests');
    Route::get('/donation-list', [CharityController::class, 'donationList'])->name('donation.list');
    Route::get('/my-charities', [CharityController::class, 'myCharities'])->name('charities.index');
    Route::get('/my-charities/delete/{id}', [CharityController::class, 'deleteCharity'])->name('charities.delete');
    Route::get('/donations/search', [CharityController::class, 'search'])->name('donations.search');
    Route::get('/orders/{order}/review', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews', [ReviewController::class, 'userReviews'])->name('user.reviews');
    
    Route::delete('/user/reviews/{review}', [ReviewController::class, 'destroyUser'])->name('user.reviews.destroy');
    Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/auctions/my', [AuctionController::class, 'myAuctions'])->name('auctions.my');
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions/store', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
    Route::delete('/auctions/{id}', [AuctionController::class, 'destroy'])->name('auctions.destroy');
    // Route to display the auction bidding page
Route::get('/auctions/{id}/bid', [AuctionController::class, 'showBidPage'])->name('auctions.placeBid');

// Route to handle the bidding process
Route::post('/auctions/{id}/bid', [AuctionController::class, 'placeBid'])->name('auctions.placeBid.submit');
Route::get('/bids/{bid}/purchase', [BidController::class, 'showPurchaseForm'])->name('bids.purchase');
Route::post('/bids/{bid}/purchase', [BidController::class, 'submitPurchaseForm'])->name('bids.purchase.submit');
Route::get('/my-bids', [BidController::class, 'myBids'])->name('bids.myBids');

Route::post('/auction-orders/{auction}', [AuctionOrderController::class, 'store'])->name('auction_orders.store');

// Seller's auction orders
Route::get('/auction-orders', [AuctionOrderController::class, 'index'])->name('auction_orders.index');








   

    


    






    

    
    





   

    

    
    

    // Product Creation Routes for Sellers
    Route::get('/user/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/user/products', [ProductController::class, 'store'])->name('products.store');

    // Profile Routes - Only for non-admin users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - Only accessible to users with the 'admin' role
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/ads', [AdminController::class, 'manageAds'])->name('admin.ads.index');
    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.categories.index');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/orders', [AdminController::class, 'manageOrders'])->name('admin.orders.index');
    Route::put('/admin/orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    Route::delete('/admin/orders/{id}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
    Route::get('/admin/charities', [AdminController::class, 'manageCharities'])->name('admin.charities');
    Route::post('/admin/charities/{id}/approve', [AdminController::class, 'approveCharity'])->name('admin.charities.approve');
    Route::post('/admin/charities/{id}/reject', [AdminController::class, 'rejectCharity'])->name('admin.charities.reject');
    Route::get('/admin/manage-charities', [CharityController::class, 'manageCharities'])->name('admin.manage-charities');
    Route::delete('/admin/charity/{id}', [CharityController::class, 'deleteCharity'])->name('admin.charity.delete');
    Route::get('/admin/donations', [AdminController::class, 'manageDonations'])->name('admin.donations');
Route::delete('/admin/donations/{id}', [AdminController::class, 'deleteDonation'])->name('admin.delete-donation');
Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
Route::get('/admin/auctions', [AdminController::class, 'manageAuctions'])->name('admin.auctions.index');

// Route for approving an auction
Route::post('/admin/auctions/{id}/approve', [AdminController::class, 'approveAuction'])->name('admin.auctions.approve');

// Route for rejecting an auction
Route::post('/admin/auctions/{id}/reject', [AdminController::class, 'rejectAuction'])->name('admin.auctions.reject');
Route::get('/admin/manage-auctions', [AdminController::class, 'showLiveAuctions'])->name('admin.manageAuctions');
Route::delete('/admin/manage-auctions/{id}', [AdminController::class, 'deleteAuction'])->name('admin.deleteAuction');

// Route to view and manage bids
Route::get('/admin/manage-bids', [AdminController::class, 'showBids'])->name('admin.manageBids');
Route::delete('/admin/manage-bids/{id}', [AdminController::class, 'deleteBid'])->name('admin.deleteBid');

Route::get('/admin/auction-orders', [AdminController::class, 'manageAuctionOrders'])->name('admin.auction_orders');
Route::delete('/admin/auction-orders/{id}', [AdminController::class, 'deleteAuctionOrder'])->name('admin.auction_orders.delete');






// Reviews Page Route








    





    Route::get('/admin/products', [AdminController::class, 'manageProducts'])->name('admin.products.index');

    // Routes for approving or rejecting ads
    Route::post('/admin/ads/{id}/approve', [AdminController::class, 'approveAd'])->name('admin.ads.approve');
    Route::post('/admin/ads/{id}/reject', [AdminController::class, 'rejectAd'])->name('admin.ads.reject');

});

// Admin Login Routes (Separate interface for admin login)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Default Authentication Routes
require __DIR__.'/auth.php';
