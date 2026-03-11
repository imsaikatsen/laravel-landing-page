<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MiniApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'appTitle',
        'appImage',
        'metaKeywords',
        'metaTitle',
        'metaDescription',
        'customScript',
        'slug',
        'description',
        'category_id',
        'category_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
