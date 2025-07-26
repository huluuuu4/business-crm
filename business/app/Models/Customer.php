<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'status',
    ];

    /**
     * Get all of the deals for the Customer.
     */
    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }
}