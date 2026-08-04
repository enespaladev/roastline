@php
    $isEdit = isset($video);
    $currentYoutubeUrl = $isEdit ? $video->watch_url : '';
    $currentThumbnail = $isEdit ? $video->thumbnail_url : null;
@endphp

<div
    x-data="{
        youtubeUrl: @js($currentYoutubeUrl),
        thumbnail: @js($currentThumbnail),
        activeLocale: 'tr',
        extractId(url) {
            if (!url) return null;
            const trimmed = url.trim();
            if (/^[a-zA-Z0-9_-]{11}$/.test(trimmed)) return trimmed;
            const patterns = [
                /(?:youtube\.com\/watch\?v=)([a-zA-Z0-9_-]{11})/,
                /(?:youtu\.be\/)([a-zA-Z0-9_-]{11})/,
                /(?:youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/,
                /(?:youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/,
            ];
            for (const p of patterns) {
                const m = trimmed.match(p);
                if (m) return m[1];
            }
            return null;
        },
        updatePreview() {
            const id = this.extractId(this.youtubeUrl);
            this.thumbnail = id ? `https://img.youtube.com/vi/${id}/hqdefault.jpg` : null;
        }
    }"
    x-init="updatePreview()"
>
    {{-- YouTube linki --}}
    <div class="mb-6">
        <label for="youtube_url" class="mb-1.5 block text-sm font-medium text-gray-700">
            YouTube Linki <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            name="youtube_url"
            id="youtube_url"
            x-model="youtubeUrl"
            x-on:input.debounce.400ms="updatePreview()"
            placeholder="https://www.youtube.com/watch?v=..."
            value="{{ old('youtube_url', $currentYoutubeUrl) }}"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand @error('youtube_url') border-red-500 @enderror"
        >
        @error('youtube_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        {{-- Otomatik thumbnail önizlemesi --}}
        <div x-show="thumbnail" x-cloak class="mt-3">
            <p class="mb-1.5 text-xs font-medium text-gray-500">Thumbnail önizlemesi (YouTube'dan otomatik çekilir):</p>
            <img :src="thumbnail" class="h-32 w-auto rounded-lg border border-gray-200 object-cover" alt="Önizleme">
        </div>
        <div x-show="youtubeUrl && !thumbnail" x-cloak class="mt-2 text-sm text-amber-600">
            Geçerli bir YouTube linki gibi görünmüyor.
        </div>
    </div>

    {{-- Süre ve sıralama --}}
    <div class="mb-6 grid grid-cols-2 gap-4">
        <div>
            <label for="duration" class="mb-1.5 block text-sm font-medium text-gray-700">Süre</label>
            <input
                type="text"
                name="duration"
                id="duration"
                value="{{ old('duration', $video->duration ?? '') }}"
                placeholder="4:12"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand"
            >
        </div>
        <div>
            <label for="order" class="mb-1.5 block text-sm font-medium text-gray-700">Sıra</label>
            <input
                type="number"
                name="order"
                id="order"
                value="{{ old('order', $video->order ?? 0) }}"
                min="0"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand"
            >
        </div>
    </div>

    {{-- Dil sekmeleri --}}
    <div class="mb-6">
        <div class="mb-3 flex gap-2 border-b border-gray-200">
            @foreach (['tr' => 'Türkçe', 'en' => 'English', 'ar' => 'العربية'] as $locale => $label)
                <button
                    type="button"
                    x-on:click="activeLocale = '{{ $locale }}'"
                    :class="activeLocale === '{{ $locale }}' ? 'border-brand text-brand' : 'border-transparent text-gray-500'"
                    class="border-b-2 px-4 py-2 text-sm font-medium transition-colors"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        @foreach (['tr', 'en', 'ar'] as $locale)
            <div x-show="activeLocale === '{{ $locale }}'" x-cloak class="space-y-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Başlık ({{ strtoupper($locale) }}) <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="title[{{ $locale }}]"
                        value="{{ old('title.'.$locale, $isEdit ? $video->getTranslation('title', $locale) : '') }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand @error('title.'.$locale) border-red-500 @enderror"
                    >
                    @error('title.'.$locale)
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Kategori ({{ strtoupper($locale) }}) <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="category[{{ $locale }}]"
                        value="{{ old('category.'.$locale, $isEdit ? $video->getTranslation('category', $locale) : '') }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand @error('category.'.$locale) border-red-500 @enderror"
                    >
                    @error('category.'.$locale)
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Açıklama ({{ strtoupper($locale) }}) <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="description[{{ $locale }}]"
                        rows="3"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-brand focus:ring-brand @error('description.'.$locale) border-red-500 @enderror"
                    >{{ old('description.'.$locale, $isEdit ? $video->getTranslation('description', $locale) : '') }}</textarea>
                    @error('description.'.$locale)
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    {{-- Aktif/pasif --}}
    <div class="mb-6 flex items-center gap-2">
        <input
            type="checkbox"
            name="is_active"
            id="is_active"
            value="1"
            {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }}
            class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition"
        >
        <label for="is_active" class="text-sm font-medium text-gray-700">Aktif (sitede göster)</label>
    </div>
</div>
