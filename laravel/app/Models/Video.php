<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use HasTranslations;

    protected array $translatable = ['title', 'description', 'category'];

    protected $fillable = [
        'title',
        'description',
        'category',
        'youtube_id',
        'duration',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', fn ($query) => $query->orderBy('order'));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getEmbedUrlAttribute(): string
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }

    public function getWatchUrlAttribute(): string
    {
        return "https://www.youtube.com/watch?v={$this->youtube_id}";
    }

    // Thumbnail her zaman YouTube'dan çekilir, hiç DB'de tutmuyoruz.
    // maxresdefault her videoda olmayabilir, hqdefault garantidir.
    public function getThumbnailUrlAttribute(): string
    {
        return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
    }

    /**
     * Kabul ettiği formatlar:
     * - https://www.youtube.com/watch?v=XXXXXXXXXXX
     * - https://youtu.be/XXXXXXXXXXX
     * - https://www.youtube.com/embed/XXXXXXXXXXX
     * - https://www.youtube.com/shorts/XXXXXXXXXXX
     * - Doğrudan 11 karakterlik video ID'si
     */
    public static function extractYoutubeId(string $url): ?string
    {
        $url = trim($url);

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        $patterns = [
            '/(?:youtube\.com\/watch\?v=)([a-zA-Z0-9_-]{11})/',
            '/(?:youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            '/(?:youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
            '/(?:youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
