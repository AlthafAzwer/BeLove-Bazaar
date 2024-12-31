<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentView extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getRecommendations($price, $range = 2000)
{
    return Product::where('status', 'approved')
        ->whereBetween('price', [$price - $range, $price + $range])
        ->inRandomOrder()
        ->limit(5)
        ->get();
}

}
