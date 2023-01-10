<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'title',
        'slug',
        'banner_img'
    ];

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }
}