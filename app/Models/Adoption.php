<?php

namespace App\Models;

use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'adoption_date',
        'message',
        'status',
        'adopter_id',
        'animal_id',
        'user_id',
    ];

    protected $casts = [
        'adoption_date' => 'date',
        'status' => AdoptionStatus::class,
    ];

    public function animal():BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function adopter():BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
