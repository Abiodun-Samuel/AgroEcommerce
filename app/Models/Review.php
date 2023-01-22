<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function boot()
    {
        parent::boot();
        // static::created(function ($item) {
        //     dd($item);
        // });
        //     static::creating(function ($item) {
        //         Log::info('Creating event call: ' . $item);
        //     });

        //     static::updating(function ($item) {
        //         Log::info('Updating event call: ' . $item);

        //         $item->slug = Str::slug($item->name);
        //     });
        //     static::updated(function ($item) {
        //         Log::info('Updated event call: ' . $item);
        //     });
        //     static::deleted(function ($item) {
        //         Log::info('Deleted event call: ' . $item);
        //     });
    }

}