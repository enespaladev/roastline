@extends('admin.layout')

@section('title', isset($page) ? 'Sayfa Duzenle' : 'Yeni Sayfa')

@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
        @csrf
        @if(isset($page)) @method('PUT') @endif

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-6">

            {{-- Baslik --}}
            <div>
                <p class="text-xs font-medium text-gray-700 mb-2">Baslik *</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <input type="text" name="title_{{ $lang }}"
                               value="{{ old('title_'.$lang, isset($page) ? $page->getTranslation('title', $lang) : '') }}"
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
                        <textarea name="content_{{ $lang }}" rows="8"
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>{{ old('content_'.$lang, isset($page) ? $page->getTranslation('content', $lang) : '') }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Durum --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', isset($page) ? $page->is_active : true) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-700">Aktif</label>
            </div>

            {{-- SEO --}}
            <div class="border-t border-gray-100 pt-4">
                <p class="text-xs font-medium text-gray-700 mb-2">SEO - Meta Baslik</p>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['tr' => 'Turkce', 'en' => 'Ingilizce', 'ar' => 'Arapca'] as $lang => $label)
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                        <input type="text" name="meta_title_{{ $lang }}"
                               value="{{ old('meta_title_'.$lang, isset($page) ? $page->getTranslation('meta_title', $lang) : '') }}"
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
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('meta_description_'.$lang, isset($page) ? $page->getTranslation('meta_description', $lang) : '') }}</textarea>
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
                    {{ isset($page) ? 'Guncelle' : 'Kaydet' }}
                </button>
                <a href="{{ route('admin.pages.index') }}"
                   class="text-gray-500 text-sm hover:text-gray-700">Iptal</a>
            </div>
        </div>
    </form>
</div>
@endsection
