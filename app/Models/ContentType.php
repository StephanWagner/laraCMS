<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TracksUserActivity;

class ContentType extends Model
{
    use SoftDeletes;
    use TracksUserActivity;

    protected $fillable = [
        'key',
        'name',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
