<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import your Product model

class UserDashboardController extends Controller
{
    public function index()
    {
        // 1) Fetch "Hot Products" from the database
        //    e.g., the 4 latest approved products
        $hotProducts = Product::where('status', 'approved')
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->get();

        // 2) Return your "user-dashboard" view and pass $hotProducts
        return view('user-dashboard', compact('hotProducts'));
    }
}

