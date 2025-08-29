<?php

namespace App\Helpers;

use App\Models\Media;
use App\Models\MediaVersion;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Store file
     */
    public static function store(UploadedFile $file, $replaceId = false)
    {
        if ($file->getError() !== UPLOAD_ERR_OK) {
            $error = $file->getError();

            if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
                $maxUpload = self::convertToBytes(ini_get('upload_max_filesize'));
                $maxPost   = self::convertToBytes(ini_get('post_max_size'));
                $limit     = min($maxUpload, $maxPost);

                return [
                    'success' => false,
                    // TODO from lang files
                    'error'   => 'File exceeds maximum allowed size of ' . round($limit / 1024 / 1024, 2) . ' MB',
                ];
            }

            return [
                'success' => false,
                'error'   => $file->getErrorMessage(),
            ];
        }

        // Get media object
        if ($replaceId) {
            $media = Media::with('versions')->find($replaceId);

            if (!$media) {
                return [
                    'success' => false,
                    // TODO from lang files
                    'error'   => 'Media not found',
                ];
            }

            $uuid = $media->uuid;
            $filename = $media->filename;
            $meta = $media->meta;
        } else {
            $media = new Media();
            $uuid = (string) Str::uuid();
            $storageSubfolder = self::getStorageSubfolder();
            $filename = $storageSubfolder ? $storageSubfolder . '/' . $uuid : $uuid;
            $meta = [];
        }

        // Filename and extension
        $extension = strtolower($file->getClientOriginalExtension());

        // Get storage folder
        $storageFolder = self::getStorageFolder();

        // Store original file
        $file->storeAs($storageFolder, $filename . '.' . $extension, 'public');

        // Get mime type
        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            $mediaType = 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            $mediaType = 'video';
        } else {
            $mediaType = 'file';
        }

        // Generate hash
        $hash = hash_file('sha256', $file->getRealPath());

        // Construct meta
        $meta['hash'] = $hash;

        $fillData = [
            'filename_original' => $file->getClientOriginalName(),
            'extension' => $extension,
            'mime_type' => $mimeType,
            'media_type' => $mediaType,
            'size' => $file->getSize(),
            'meta' => $meta,
        ];

        if (!$replaceId) {
            $fileTitle = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $fillData['uuid'] = $uuid;
            $fillData['title'] = $fileTitle;
            $fillData['filename'] = $filename;
            $fillData['meta'] = [
                'hash' => $hash,
            ];
        }

        $media->fill($fillData);
        $media->save();

        // Generate versions
        if ($mediaType === 'image') {
            if ($replaceId) {
                self::deleteVersions($media);
            }
            self::generateVersions($media);
        }

        $media = Media::with('versions')->find($media->id);

        return [
            'success' => true,
            'media' => $media,
        ];
    }

    /**
     * Generate versions
     */
    public static function generateVersions(Media $media): void
    {
        // Versions
        // TODO get from settings
        $versions = [
            'large'  => [2400, 2400],
            'medium' => [1200, 1200],
            'small'  => [600, 600],
            'thumbnail'  => [300, 300],
        ];

        // Convert to webp
        // TODO get from settings
        $convertToWebp = true;
        $imageQuality = 85;

        // Prefer imagick if available
        $manager = extension_loaded('imagick')
            ? new ImageManager(new ImagickDriver())
            : new ImageManager(new GdDriver());

        // Storage folders
        $storageFolder = self::getStorageFolder();
        $storageSubfolder = self::getStorageSubfolder($media);

        // Original path
        $originalPath = storage_path('app/public/' . $storageFolder . '/' . $media->filename . '.' . $media->extension);

        // Save versions
        foreach ($versions as $key => [$maxWidth, $maxHeight]) {
            $existing = $media->versions()->where('size_key', $key)->first();

            if ($existing) {
                continue;
            }

            $image = $manager->read($originalPath)
                ->scaleDown($maxWidth, $maxHeight);

            $extension = strtolower(pathinfo($media->filename, PATHINFO_EXTENSION));
            $versionFilename = ($storageSubfolder ? $storageSubfolder . '/' : '') . $media->uuid . '-' . $key;

            $storagePath = storage_path('app/public/' . $storageFolder . '/' . $versionFilename . '.' . $extension);

            if ($convertToWebp) {
                $image->encode(new WebpEncoder(quality: $imageQuality))
                    ->save($storagePath);
            } else {
                $image->save($storagePath, quality: $imageQuality);
            }

            MediaVersion::create(
                [
                    'media_id' => $media->id,
                    'size_key' => $key,
                    'filename' => $versionFilename,
                    'extension' => $extension,
                    'width' => $image->width(),
                    'height' => $image->height(),
                ]
            );
        }
    }

    /**
     * Convert to bytes
     */
    private static function convertToBytes($val)
    {
        $val  = trim($val);
        $last = strtolower($val[strlen($val) - 1]);

        $num = (int) $val;

        switch ($last) {
            case 'g':
                $num *= 1024;
            case 'm':
                $num *= 1024;
            case 'k':
                $num *= 1024;
        }

        return $num;
    }

    /**
     * Get storage folder
     */
    public static function getStorageFolder()
    {
        return 'uploads';
    }

    /**
     * Get storage subfolder
     */
    private static function getStorageSubfolder($media = null)
    {
        // TODO get from settings
        $storeInFolders = true;

        $storageSubfolder = '';

        if ($storeInFolders && $media && $media->filename) {
            $storageSubfolder = pathinfo($media->filename, PATHINFO_DIRNAME);
        } elseif ($storeInFolders) {
            $storageSubfolder = date('Y/m');
        }

        return $storageSubfolder;
    }

    /**
     * Delete versions
     */
    public static function deleteVersions(Media $media): void
    {
        $versions = $media->versions;

        foreach ($versions as $version) {
            self::deleteVersion($version);
        }
    }

    /**
     * Delete version
     */
    public static function deleteVersion(MediaVersion $version): void
    {
        $filename = self::getStorageFolder() . '/' . $version->filename . '.' . $version->extension;
        Storage::disk('public')->delete($filename);
        $version->delete();
    }
}
