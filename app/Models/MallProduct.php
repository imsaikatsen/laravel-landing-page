<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MallProduct extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'price',
        'sold_count',
        'review_count',
        'rating',
        'is_new',
        'description',
        'metaKeywords',
        'metaTitle',
        'metaDescription',
        'customScript'
    ];
}
