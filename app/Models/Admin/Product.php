<?php

namespace App\Models\Admin;

use App\Models\Admin\Subcategory;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'category_id',
        'subcategory_id',
        'image',
        'brands',
        'description',
        'ingredients',
        'pack_size',
        'price',
        'discount_price',
        'stock',
        'reviews_count',
        'sales_count'
    ];
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}