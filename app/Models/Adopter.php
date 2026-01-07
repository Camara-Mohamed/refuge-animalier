<?php

namespace App\Models;

use App\Enums\House;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adopter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'number',
        'city',
        'postal_code',
        'house_type',
        'have_garden',
        'message',
    ];

    protected $casts = [
        'have_garden' => 'boolean',
        'house_type' => House::class,
    ];

    public function adoption():HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}
