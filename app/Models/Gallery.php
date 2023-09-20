<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory,  HasUuids;

    protected $fillable = [
        'title',
        'gallery_img',
        'width',
        'height'
    ];
}
