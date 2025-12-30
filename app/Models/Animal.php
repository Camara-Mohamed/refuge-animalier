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
        'gender',
        'birth_date',
        'chip',
        'description',
        'status',
        'avatar',
        'animal_picture_id',
        'user_id',
        'race_id',
        'specie_id',
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

    public function specie():BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }

    public function coats():BelongsTo
    {
        return $this->belongsTo(Coat::class);
    }

    public function notes():HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function vaccine():BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class);
    }

    public function adoption():HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function picture()
    {
        return $this->hasMany(AnimalPicture::class);
    }


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
