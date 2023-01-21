<?php

namespace App\Models\Admin;

use App\Models\Admin\Subcategory;
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

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }
}