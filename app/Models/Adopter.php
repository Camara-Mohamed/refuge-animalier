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
        'house',
        'garden',
    ];

    protected $casts = [
        'garden' => 'boolean',
        'house' => House::class,
    ];

    public function adoptions():HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}
