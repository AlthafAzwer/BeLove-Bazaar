<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharityRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'logo',
        'certification',
        'description',
        'quantity',
        'status',
        'rejection_reason',
    ];

    // Suppose your 'charities' table has: id, user_id, name, ...
// Then in your Charity model:

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}

