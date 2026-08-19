<?php

namespace App\Models;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Les animaux seedés ont un chemin d'asset public en dur
     * (ex: assets/img/public/animals/dogs/dog_1.webp), tandis que les
     * photos réellement uploadées via le formulaire passent par le
     * disque "public" (storage/app/public). On distingue les deux ici.
     *
     * Dans les deux cas, plusieurs tailles existent (320/640/1280) —
     * pour le seed en suffixe de fichier, pour les uploads via
     * ProcessUploadedImageJob dans animals/variants/{taille}/.
     * On sert la bonne taille selon le contexte au lieu de toujours
     * charger l'originale.
     */
    public function avatarUrl(?int $size = null): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        $isSeeded = str_starts_with($this->avatar, 'assets/');
        $wantsVariant = $size && in_array($size, [320, 640, 1280]);

        if ($isSeeded) {
            if ($wantsVariant) {
                $path = preg_replace('/\.webp$/', "_{$size}.webp", $this->avatar);

                return asset($path);
            }

            return asset($this->avatar);
        }

        if ($wantsVariant) {
            $variantPath = "animals/variants/{$size}/".basename($this->avatar);

            if (Storage::disk('public')->exists($variantPath)) {
                return Storage::url($variantPath);
            }
        }

        return Storage::url($this->avatar);
    }

    /**
     * Attribut srcset (descripteurs de largeur), pour laisser le
     * navigateur choisir la taille adaptée, comme dans le fil rouge.
     */
    public function avatarSrcset(): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        $sizes = [320, 640, 1280];

        return collect($sizes)
            ->map(fn ($size) => $this->avatarUrl($size)." {$size}w")
            ->implode(', ');
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
