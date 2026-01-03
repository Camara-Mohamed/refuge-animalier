<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'animal_id',
        'user_id',
    ];

    public function animal():BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
