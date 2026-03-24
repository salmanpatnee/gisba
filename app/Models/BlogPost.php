<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'featured_image',
        'meta_title',
        'meta_description',
        'category',
        'author',
    ];

    protected $casts = [
        'category' => Category::class,
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(BlogPostAttachment::class);
    }

    /**
     * Auto-generate slug from title when creating.
     */
    protected static function booted(): void
    {
        static::creating(function (BlogPost $post): void {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Plain-text excerpt stripped from body HTML.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 160);
    }

    /**
     * Resolved URL for the featured image.
     * Handles both uploaded storage paths and seeded external URLs.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->featured_image) {
            return 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=450&fit=crop&auto=format';
        }

        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        return Storage::url($this->featured_image);
    }

    /**
     * Human-readable creation date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('F j, Y');
    }
}
