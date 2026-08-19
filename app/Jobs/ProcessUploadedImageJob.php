<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProcessUploadedImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $fullPathToOriginal,
        public string $newOriginalFileName,
    ) {}

    public function handle(): void
    {
        $manager = new ImageManager(Driver::class);

        $image = $manager->decodeBinary(
            Storage::disk('public')->get($this->fullPathToOriginal)
        );

        $sizes = config('animalavatars.sizes');
        $imageType = config('animalavatars.image_type');
        $variantPattern = config('animalavatars.variant_pattern');

        foreach ($sizes as $size) {
            $variant = clone $image;
            $variant->scale($size['width']);

            $path = sprintf($variantPattern, $size['width']).'/'.$this->newOriginalFileName;

            Storage::disk('public')->put($path, (string) $variant->encodeUsingFileExtension($imageType));
        }
    }
}
