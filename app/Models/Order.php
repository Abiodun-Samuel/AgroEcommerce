<?php

namespace App\Models;

use App\Models\Admin\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'total_price',
        'name',
        'email',
        'phone',
        'address',
        'order_items',
        'payment_option',
        'delivery_option',
        'order_status',
        'delivery_date',
        'payment_status',
        'payment_date'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['stock', 'price']);
    }
}