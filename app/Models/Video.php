<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    /** @var array<int, string> */
    protected $fillable = ['title', 'path', 'mime_type', 'size', 'views'];

    protected function videoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->path),
        );
    }

    protected function readableSize(): Attribute
    {
        return Attribute::make(
            get: function () {
                $bytes = $this->size;

                if ($bytes >= 1073741824) {
                    return number_format($bytes / 1073741824, 1).' GB';
                }

                if ($bytes >= 1048576) {
                    return number_format($bytes / 1048576, 1).' MB';
                }

                return number_format($bytes / 1024, 0).' KB';
            },
        );
    }
}
