<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function miniApps(): HasMany
    {
        return $this->hasMany(MiniApp::class);
    }

    public function datingZones(): HasMany
    {
        return $this->hasMany(DatingZone::class);
    }

    public function liveZones(): HasMany
    {
        return $this->hasMany(LiveZone::class);
    }

    public function mallProducts(): HasMany
    {
        return $this->hasMany(MallProduct::class);
    }
}
