<?php

namespace App\Traits;

use App\Jobs\ProcessUploadedImageJob;
use App\Models\Animal;
use Illuminate\Support\Facades\Storage;

trait HandlesAnimalAvatar
{
    protected function storeAnimalAvatar($file): string
    {
        $path = $file->store('animals', 'public');

        ProcessUploadedImageJob::dispatchSync($path, basename($path));

        return $path;
    }

    protected function deleteAnimalAvatar(Animal $animal): void
    {
        if (! $animal->avatar || str_starts_with($animal->avatar, 'assets/')) {
            return;
        }

        Storage::disk('public')->delete($animal->avatar);

        foreach (config('animalavatars.sizes') as $size) {
            $path = sprintf(config('animalavatars.variant_pattern'), $size['width']).'/'.basename($animal->avatar);
            Storage::disk('public')->delete($path);
        }
    }
}
