<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    'metaDescription',
    'customScript'
];

}
