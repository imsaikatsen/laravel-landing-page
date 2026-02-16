<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'description'
    ];
}
