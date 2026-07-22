@extends('admin.layout')

@section('title', isset($post) ? 'Yazi Duzenle' : 'Yeni Yazi')

@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-6">

            {{-- Baslik --}}
            <div>
                <p class="text-xs font-medium text-gray-700 mb-2">Baslik *</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <input type="text" name="title_{{ $lang }}"
                               value="{{ old('title_'.$lang, isset($post) ? $post->getTranslation('title', $lang) : '') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Icerik --}}
            <div>
                <p class="text-xs font-medium text-gray-700 mb-2">Icerik *</p>
                <div class="space-y-3">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <textarea name="content_{{ $lang }}" rows="6"
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>{{ old('content_'.$lang, isset($post) ? $post->getTranslation('content', $lang) : '') }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Yayin Tarihi & Durum --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Yayin Tarihi</label>
                    <input type="datetime-local" name="published_at"
                           value="{{ old('published_at', isset($post) ? $post->published_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', isset($post) ? $post->is_active : true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                </div>
            </div>

            {{-- SEO --}}
            <div class="border-t border-gray-100 pt-4">
                <p class="text-xs font-medium text-gray-700 mb-2">SEO - Meta Baslik</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <input type="text" name="meta_title_{{ $lang }}"
                               value="{{ old('meta_title_'.$lang, isset($post) ? $post->getTranslation('meta_title', $lang) : '') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="text-xs font-medium text-gray-700 mb-2">SEO - Meta Aciklama</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <textarea name="meta_description_{{ $lang }}" rows="2"
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('meta_description_'.$lang, isset($post) ? $post->getTranslation('meta_description', $lang) : '') }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            @if($errors->any())
                <div class="text-red-500 text-sm">{{ $errors->first() }}</div>
            @endif

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                    {{ isset($post) ? 'Guncelle' : 'Kaydet' }}
                </button>
                <a href="{{ route('admin.posts.index') }}"
                   class="text-gray-500 text-sm hover:text-gray-700">Iptal</a>
            </div>
        </div>
    </form>
</div>
@endsection
