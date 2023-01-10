<?php

namespace App\Models\Admin;

use App\Models\Admin\SubCategory;
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
        'sub_category_id',
        'image',
        'brands',
        'description',
        'ingredients',
        'pack_size',
        'price',
        'discount_price',
        'stock',
    ];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}