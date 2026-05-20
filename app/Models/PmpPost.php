<?php

namespace App\Models;

use Database\Factories\PmpPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PmpPost extends Model
{
    /** @use HasFactory<PmpPostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'featured_image',
        'meta_title',
        'meta_description',
        'category_id',
        'author',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PmpCategory::class, 'category_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(PmpPostAttachment::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PmpPost $post): void {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 160);
    }

    public function getImageUrlAttribute(): string
    {
        if (! $this->featured_image) {
            return 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=450&fit=crop&auto=format';
        }

        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        return Storage::url($this->featured_image);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('F j, Y');
    }
}
