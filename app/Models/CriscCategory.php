<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CriscCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all CRISC posts in this category.
     */
    public function criscPosts(): HasMany
    {
        return $this->hasMany(CriscPost::class, 'category_id');
    }
}
