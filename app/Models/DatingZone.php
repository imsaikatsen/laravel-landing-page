<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatingZone extends Model
{
    protected $fillable = [
    'title',
    'slug',
    'image',
    'description',
    'tag1',
    'tag2',
    'count',
    'metaKeywords',
    'metaTitle',
    'metaDescription',
    'customScript',
    'category_id',
    'category_active',
];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
