<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Product;


class Cart extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_title',
        'product_slug',
        'product_image',
        'product_price',
        'product_quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}