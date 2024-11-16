<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'buyer_id', 
        'buyer_name', 
        'buyer_address', 
        'buyer_telephone', 
        'payment_method', 
        'status'
    ];

    /**
     * Relationship to the user who placed the order (buyer).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to the product being ordered.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function buyer()
{
    return $this->belongsTo(User::class, 'buyer_id');
}



}

