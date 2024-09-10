<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];


    public function headPhoto(): HasOne
    {
        return $this->hasOne(AdvertisementPhoto::class);
    }

    public function links():HasMany
    {
        return $this->hasMany(AdvertisementPhoto::class);
    }
}
