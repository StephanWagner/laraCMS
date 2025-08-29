<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\MediaHelper;

class MediaVersion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'media_id',
        'size_key',
        'filename',
        'extension',
        'width',
        'height'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaHelper::deleteFile($media);
        });
    }
}
