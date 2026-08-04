<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Video;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'youtube_url' => ['required', 'string'],
            'title.tr' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'title.ar' => ['required', 'string', 'max:255'],
            'description.tr' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'description.ar' => ['required', 'string'],
            'category.tr' => ['required', 'string', 'max:100'],
            'category.en' => ['required', 'string', 'max:100'],
            'category.ar' => ['required', 'string', 'max:100'],
            'duration' => ['nullable', 'string', 'max:20'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'youtube_url.required' => 'YouTube linki zorunludur.',
        ];
    }

    /**
     * youtube_url'den ID çıkarıp validate eder, request'e ekler.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $id = Video::extractYoutubeId($this->input('youtube_url', ''));

            if (! $id) {
                $validator->errors()->add('youtube_url', 'Geçerli bir YouTube linki veya video ID giriniz.');
                return;
            }

            $this->merge(['youtube_id' => $id]);
        });
    }
}
