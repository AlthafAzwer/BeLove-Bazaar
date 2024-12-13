<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auctions'; // This is optional if the table name matches the plural of the model name.

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category',
        'title',
        'condition',
        'location',
        'description',
        'start_bid',
        'max_bid',
        'duration',
        'images',
        'contact_info',
        'status', // e.g., 'pending', 'approved', or 'rejected'
        'rejection_reason',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array', // Automatically converts JSON to an array and vice versa
    ];

    /**
     * Get the user who created the auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bids associated with the auction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany(Bid::class); // Assuming you have a `Bid` model
    }
}
