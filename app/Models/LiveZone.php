<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveZone extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'description', 'metaKeywords', 'metaDescription', 'customScript'
    ];
}
