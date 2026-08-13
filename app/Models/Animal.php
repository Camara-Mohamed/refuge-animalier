<?php

namespace App\Models;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'chip',
        'description',
        'status',
        'avatar',
        'user_id',
        'race_id',
        'specie_id',
        'coat_id',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'status' => AnimalStatus::class,
        'birth_date' => 'date',
    ];

    public function age(): ?int
    {
        return $this->birth_date?->age;
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }

    public function coat(): BelongsTo
    {
        return $this->belongsTo(Coat::class);
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function adoption(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(AnimalPicture::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
