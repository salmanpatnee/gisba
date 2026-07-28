<?php

namespace App\Models;

use App\Enums\ResourceType;
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
        'additional_resources',
        'image_path',
        'sort_order',
        'section',
        'division',
    ];

    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    public function totalResourceCount(): int
    {
        return $this->resources_count ?? $this->resources()
            ->whereIn('resource_type', ResourceType::completable())
            ->count();
    }

    public function watchedResourceCount(?User $user): int
    {
        if (! $user) {
            return 0;
        }

        $loaded = $this->getAttribute('watched_count');

        if ($loaded !== null) {
            return (int) $loaded;
        }

        return $this->resources()
            ->whereIn('resource_type', ResourceType::completable())
            ->whereHas('watchers', fn ($q) => $q->where('users.id', $user->id))
            ->count();
    }

    public function progressPercent(?User $user): int
    {
        $total = $this->totalResourceCount();

        return $total > 0 ? (int) round($this->watchedResourceCount($user) / $total * 100) : 0;
    }

    public function isCompletedBy(?User $user): bool
    {
        $total = $this->totalResourceCount();

        return $total > 0 && $this->watchedResourceCount($user) === $total;
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
