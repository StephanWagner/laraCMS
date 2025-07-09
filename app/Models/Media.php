<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserActivity;

class Media extends Model
{
    use TracksUserActivity;

    protected $fillable = [
        'filename',
        'mime_type',
        'media_type',
        'original_name',
        'size',
        'meta',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function versions()
    {
        return $this->hasMany(MediaVersion::class);
    }
}
