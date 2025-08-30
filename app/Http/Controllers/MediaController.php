<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use App\Helpers\MediaHelper;

class MediaController extends Controller
{
    /**
     * Show original media file
     */
    public function show(?string $prefix, string $uuid, ?string $size = null)
    {
        $media = Media::where('uuid', $uuid)->firstOrFail();

        if ($size) {
            $sizeKey = ltrim($size, '-');
            $version = $media->versions()->where('size_key', $sizeKey)->firstOrFail();
            $path = MediaHelper::getStorageFolder() . '/' . $version->filename . '.' . $version->extension;
        } else {
            $path = MediaHelper::getStorageFolder() . '/' . $media->filename . '.' . $media->extension;
        }

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }

        $mimeType = $media->mime_type;

        return response()->file(Storage::disk('public')->path($path), [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000',
            'Content-Disposition' => 'inline; filename="' . $media->slug . '.' . $media->extension . '"',
        ]);
    }
}
