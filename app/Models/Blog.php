<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Blog extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'image',
        'keywords',
        'description',
        'views',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}