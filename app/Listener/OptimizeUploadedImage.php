<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OptimizeUploadedImage
{
    public function handle($event): void
    {
        $path = $event->path ?? null;

        if (!$path) {
            return;
        }

        // hanya optimasi jpg/png
        if (preg_match('/\.(jpg|jpeg|png)$/i', $path)) {
            $fullPath = Storage::disk('public')->path($path);

            if (!file_exists($fullPath)) {
                return;
            }

            $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

            $image = Image::make($fullPath);

            if ($extension === 'jpg' || $extension === 'jpeg') {
                $image->encode('jpg', 75);
            } else {
                $image->encode('png'); // biarkan default
            }

            $image->save($fullPath);
        }
    }
}
