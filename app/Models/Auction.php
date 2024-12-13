<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auctions'; // Optional if the table name matches the plural of the model name.

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
        'end_time', // Added to ensure it is mass assignable.
        'images',
        'contact_info',
        'status', // e.g., 'pending', 'approved', or 'rejected'
        'rejection_reason',
        'auction_state', // State of the auction: pending, active, completed
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array', // Automatically converts JSON to an array and vice versa.
        'end_time' => 'datetime', // Ensures that `end_time` is treated as a Carbon instance.
    ];

    /**
     * Get the user who created the auction.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bids associated with the auction.
     *
     * @return HasMany
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Scope for active auctions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('auction_state', 'active');
    }

    /**
     * Scope for completed auctions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('auction_state', 'completed');
    }

    /**
     * Check if the auction is completed.
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->auction_state === 'completed';
    }

    /**
     * Check if the auction is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->auction_state === 'active';
    }
}
