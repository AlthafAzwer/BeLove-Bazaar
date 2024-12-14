<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'buyer_id',
        'buyer_name',
        'buyer_address',
        'buyer_phone',
        'status',
    ];

    // Relationship with Auction
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    // Relationship with User (Buyer)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    
}

