<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'category_id', 'name', 'description', 'features',
        'meta_title', 'meta_description', 'slug', 'image', 'order', 'is_active'
    ];

    public $translatable = ['name', 'description', 'features', 'meta_title', 'meta_description'];

    protected $casts = ['is_active' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
