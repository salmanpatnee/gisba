<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';

    protected $fillable = ['success_stories_region'];

    public static function current(): self
    {
        return self::firstOrCreate([], ['success_stories_region' => 'eu']);
    }
}
