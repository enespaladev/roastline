<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'content', 'meta_title', 'meta_description', 'slug', 'is_active'
    ];

    public $translatable = ['title', 'content', 'meta_title', 'meta_description'];

    protected $casts = ['is_active' => 'boolean'];
}
