<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'category_id', 'name', 'description', 'features',
        'meta_title', 'meta_description', 'slug', 'image',
        'badge', 'capacity', 'capacity_value', 'power',
        'order', 'is_active',
        'length', 'width', 'height',
        'roasted_products', 'energy_specs',
    ];

    public $translatable = [
        'name', 'description', 'features',
        'meta_title', 'meta_description',
        'badge', 'capacity', 'power',
        'roasted_products',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'capacity_value' => 'integer',
        'energy_specs'   => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
