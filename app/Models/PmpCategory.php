<?php

namespace App\Models;

use Database\Factories\PmpCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PmpCategory extends Model
{
    /** @use HasFactory<PmpCategoryFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function pmpPosts(): HasMany
    {
        return $this->hasMany(PmpPost::class, 'category_id');
    }
}
