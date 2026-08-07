<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'content', 'meta_title', 'meta_description', 'badge',
        'slug', 'image', 'is_active', 'published_at'
    ];

    public $translatable = ['title', 'content', 'slug', 'badge', 'meta_title', 'meta_description'];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
}
