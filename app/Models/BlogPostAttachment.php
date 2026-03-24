<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class BlogPostAttachment extends Model
{
    protected $fillable = [
        'blog_post_id',
        'filename',
        'path',
        'mime_type',
        'size',
    ];

    public function blogPost(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }

    /**
     * Public URL to download the file.
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    /**
     * Human-readable file size (e.g. "1.2 MB").
     */
    public function getReadableSizeAttribute(): string
    {
        return Number::fileSize($this->size, precision: 1);
    }

    /**
     * Bootstrap icon class based on mime type.
     */
    public function getFileIconAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'bi-file-earmark-pdf',
            in_array($this->mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) => 'bi-file-earmark-word',
            in_array($this->mime_type, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']) => 'bi-file-earmark-slides',
            str_starts_with($this->mime_type, 'image/') => 'bi-file-earmark-image',
            default => 'bi-file-earmark',
        };
    }

    /**
     * Short label for the file type badge.
     */
    public function getFileTypeLabelAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'PDF',
            in_array($this->mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) => 'Word',
            in_array($this->mime_type, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']) => 'PowerPoint',
            str_starts_with($this->mime_type, 'image/') => 'Image',
            default => 'File',
        };
    }

    /**
     * Accent colour for the file type badge.
     */
    public function getFileTypeColorAttribute(): string
    {
        return match ($this->file_type_label) {
            'PDF' => '#e53935',
            'Word' => '#1e88e5',
            'PowerPoint' => '#f4511e',
            'Image' => '#43a047',
            default => '#757575',
        };
    }
}
