<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
