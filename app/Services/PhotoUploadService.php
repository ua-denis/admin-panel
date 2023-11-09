<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class PhotoUploadService
{
    public function upload($file): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/avatars', $filename);
        return Storage::url($path);
    }

    public function deleteOldPhoto($path): void
    {
        $filename = basename($path);
        Storage::delete('public/avatars/' . $filename);
    }
}