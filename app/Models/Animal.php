<?php

namespace App\Models;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'age',
        'chip',
        'description',
        'status',
        'avatar',
        'pictures',
        'user_id',
        'race_id',
        'species_id',
        'coat_id',
    ];

    protected $casts = [
        'pictures' => 'array',
        'gender' => Gender::class,
        'status' => AnimalStatus::class,
    ];

    public function race():BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function species():BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }

    public function coat():BelongsTo
    {
        return $this->belongsTo(Coat::class);
    }

    public function notes():HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function vaccines():BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class);
    }

    public function adoptions():HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
