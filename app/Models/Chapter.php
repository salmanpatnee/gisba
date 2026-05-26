<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'sort_order',
        'section',
    ];

    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    protected static function booted(): void
    {
        static::creating(function (Chapter $chapter): void {
            if (empty($chapter->slug)) {
                $chapter->slug = Str::slug($chapter->title);
            }
        });
    }

    public function getImageUrlAttribute(): string
    {
        if (! $this->image_path) {
            return 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=450&fit=crop&auto=format';
        }

        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }

        return Storage::url($this->image_path);
    }
}
