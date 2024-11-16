<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'condition',
        'location',
        'description',
        'images',
        'price',
        'contact_info',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'images' => 'array', // Cast images as an array for easy access
    ];

    /**
     * Relationship to link each product to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
{
    return $this->hasMany(Order::class);
}

}
