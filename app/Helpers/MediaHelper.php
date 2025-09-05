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
use Illuminate\Support\Facades\Log;

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
                    'error'   => __('admin::media.upload.error.errorFileExceedsMaxSize', ['size' => round($limit / 1024 / 1024, 2) . ' MB']),
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
                    // TODO TEST
                    'error'   => __('admin::media.upload.error.errorReplaceFileNotFound'),
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
        if (
            $mimeType === 'application/pdf' ||
            $mediaType === 'image' && self::supportsMime($mimeType)
        ) {
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
        $versions = [
            'large'      => [2400, 2400],
            'medium'     => [1200, 1200],
            'small'      => [600, 600],
            'thumbnail'  => [300, 300],
        ];

        $convertToWebp = true;
        $imageQuality  = 85;

        $manager          = self::getManager();
        $convertImage     = self::supportsMime($media->mime_type);
        $storageFolder    = self::getStorageFolder();
        $storageSubfolder = self::getStorageSubfolder($media);

        $originalPath = storage_path('app/public/' . $storageFolder . '/' . $media->filename . '.' . $media->extension);

        foreach ($versions as $key => [$maxWidth, $maxHeight]) {
            $existing = $media->versions()->where('size_key', $key)->first();
            if ($existing) {
                self::deleteVersion($existing);
            }

            $extension       = $media->extension;
            $versionFilename = ($storageSubfolder ? $storageSubfolder . '/' : '') . $media->uuid . '-' . $key;
            $storagePath     = storage_path('app/public/' . $storageFolder . '/' . $versionFilename . '.' . ($convertToWebp ? 'webp' : $extension));

            try {
                if ($media->mime_type === 'application/pdf') {
                    if (class_exists(\Imagick::class)) {
                        // Special case for PDF first page
                        $imagick = new \Imagick();
                        $imagick->setResolution(150, 150);
                        $imagick->readImage($originalPath . '[0]');
                        $imagick->setImageFormat('webp');
                        $imagick->setImageCompressionQuality($imageQuality);
                        $imagick->setImageBackgroundColor('white');
                        $imagick = $imagick->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
                        $imagick->thumbnailImage($maxWidth, $maxHeight, true);
                        $imagick->writeImage($storagePath);

                        $width  = $imagick->getImageWidth();
                        $height = $imagick->getImageHeight();

                        $imagick->clear();
                        $imagick->destroy();
                    } else {
                        \Log::warning("Skipping PDF preview for media {$media->id}: Imagick not installed");
                        continue;
                    }
                } elseif ($convertImage) {
                    // Regular image flow
                    $image = $manager->read($originalPath)->scaleDown($maxWidth, $maxHeight);
                    if ($convertToWebp) {
                        $image->encode(new WebpEncoder(quality: $imageQuality))->save($storagePath);
                        $extension = 'webp';
                    } else {
                        $image->save($storagePath, quality: $imageQuality);
                    }
                    $width  = $image->width();
                    $height = $image->height();
                } else {
                    continue;
                }

                // Save DB record
                MediaVersion::create([
                    'media_id'  => $media->id,
                    'size_key'  => $key,
                    'filename'  => $versionFilename,
                    'extension' => $convertToWebp ? 'webp' : $extension,
                    'width'     => $width ?? null,
                    'height'    => $height ?? null,
                ]);
            } catch (\Exception $e) {
                \Log::error("Failed generating version {$key} for media {$media->id}: " . $e->getMessage());
            }
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
        self::deleteFile($version);
        $version->delete();
    }

    /**
     * Delete media file
     */
    public static function deleteFile($media): void
    {
        $disk = Storage::disk('public');

        $path = self::getStorageFolder() . '/' . $media->filename . '.' . $media->extension;

        if ($disk->exists($path)) {
            $disk->delete($path);
        } else {
            Log::info("Skipping missing file: {$path}");
        }
    }

    /**
     * Get the manager
     */
    private static function getManager(): ImageManager
    {
        return extension_loaded('imagick')
            ? new ImageManager(new ImagickDriver())
            : new ImageManager(new GdDriver());
    }

    /**
     * Get supported MIME types for the current driver
     */
    private static function getSupportedMimes(): array
    {
        $manager = self::getManager();

        if ($manager->driver() instanceof ImagickDriver) {
            $imagick = new \Imagick();
            $formats = array_map('strtolower', $imagick->queryFormats());

            $extToMime = [
                'jpeg' => 'image/jpeg',
                'jpg'  => 'image/jpeg',
                'png'  => 'image/png',
                'gif'  => 'image/gif',
                'webp' => 'image/webp',
                'tiff' => 'image/tiff',
                'bmp'  => 'image/bmp',
                'heic' => 'image/heic',
                'heif' => 'image/heif',
                'avif' => 'image/avif',
                'tga'  => 'image/x-tga',
                // 'svg'  => 'image/svg+xml',
                // 'ico'  => 'image/vnd.microsoft.icon',
            ];

            return array_values(array_intersect_key($extToMime, array_flip($formats)));
        }

        if ($manager->driver() instanceof GdDriver) {
            // GD is very limited
            return [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp',
                'image/bmp',
            ];
        }

        return [];
    }

    /**
     * Check if a MIME type is supported by current setup
     */
    public static function supportsMime(string $mime): bool
    {
        return in_array($mime, self::getSupportedMimes(), true);
    }
}
