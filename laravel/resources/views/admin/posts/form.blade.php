@extends('admin.layout')

@section('title', isset($post) ? 'Yazı Düzenle' : 'Yeni Yazı')

@section('content')
    <div x-data="{
        lang: 'tr',
        preview: '{{ isset($post) && $post->image ? asset('storage/' . $post->image) : '' }}',
        removeImage: false,
        onFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.removeImage = false;
            const reader = new FileReader();
            reader.onload = (ev) => this.preview = ev.target.result;
            reader.readAsDataURL(file);
        },
        clearImage() {
            this.preview = '';
            this.removeImage = true;
            this.$refs.imageInput.value = '';
        }
    }">
        <form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <input type="hidden" name="remove_image" x-bind:value="removeImage ? 1 : 0">

            {{-- Üst bar: başlık + kaydet --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-lg font-semibold text-gray-900">
                    {{ isset($post) ? 'Yazı Düzenle' : 'Yeni Yazı' }}
                </h1>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.posts.index') }}" class="text-gray-500 text-sm hover:text-gray-700">İptal</a>
                    <button type="submit"
                        class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                        {{ isset($post) ? 'Güncelle' : 'Kaydet' }}
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg px-4 py-3 mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- SOL: İçerik --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Dil sekmeleri --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center gap-1 border-b border-gray-100 mb-5 -mt-1">
                            @foreach (['tr' => 'Türkçe', 'en' => 'İngilizce', 'ar' => 'Arapça'] as $code => $label)
                                <button type="button" @click="lang = '{{ $code }}'"
                                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition -mb-px"
                                    :class="lang === '{{ $code }}'
                                        ?
                                        'border-gray-900 text-gray-900' :
                                        'border-transparent text-gray-400 hover:text-gray-600'">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        @foreach (['tr' => 'Türkçe', 'en' => 'İngilizce', 'ar' => 'Arapça'] as $code => $label)
                            <div x-show="lang === '{{ $code }}'" x-cloak class="space-y-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Başlık ({{ $label }}) *
                                    </label>
                                    <input type="text" name="title_{{ $code }}"
                                        value="{{ old('title_' . $code, isset($post) ? $post->getTranslation('title', $code) : '') }}"
                                        dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                                        {{ $code === 'tr' ? 'required' : '' }}>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        İçerik ({{ $label }}) *
                                    </label>
                                    <textarea name="content_{{ $code }}" rows="10" dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                                        {{ $code === 'tr' ? 'required' : '' }}>{{ old('content_' . $code, isset($post) ? $post->getTranslation('content', $code) : '') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Slug ({{ $label }}) *
                                    </label>
                                    <input type="text" name="slug_{{ $code }}"
                                        value="{{ old('slug_' . $code, isset($post) ? $post->getTranslation('slug', $code) : '') }}"
                                        dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                                        {{ $code === 'tr' ? 'required' : '' }}>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Etiket ({{ $label }}) *
                                    </label>
                                    <input type="text" name="badge_{{ $code }}"
                                        value="{{ old('badge_' . $code, isset($post) ? $post->getTranslation('badge', $code) : '') }}"
                                        dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                                        {{ $code === 'tr' ? 'required' : '' }}>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- SEO --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <p class="text-sm font-semibold text-gray-900 mb-4">SEO</p>

                        @foreach (['tr' => 'Türkçe', 'en' => 'İngilizce', 'ar' => 'Arapça'] as $code => $label)
                            <div x-show="lang === '{{ $code }}'" x-cloak class="space-y-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Meta Başlık ({{ $label }})
                                    </label>
                                    <input type="text" name="meta_title_{{ $code }}"
                                        value="{{ old('meta_title_' . $code, isset($post) ? $post->getTranslation('meta_title', $code) : '') }}"
                                        dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Meta Açıklama ({{ $label }})
                                    </label>
                                    <textarea name="meta_description_{{ $code }}" rows="3" dir="{{ $code === 'ar' ? 'rtl' : 'ltr' }}"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('meta_description_' . $code, isset($post) ? $post->getTranslation('meta_description', $code) : '') }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- SAĞ: Görsel + Yayın Ayarları --}}
                <div class="space-y-6">

                    {{-- Görsel --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <p class="text-xs font-medium text-gray-700 mb-3">Görsel</p>

                        <div class="relative">
                            <div x-show="preview" class="relative group">
                                <img :src="preview"
                                    class="w-full aspect-video object-cover rounded-lg border border-gray-200">
                                <button type="button" @click="clearImage()"
                                    class="absolute top-2 right-2 bg-white/90 hover:bg-white text-gray-700 rounded-full w-7 h-7 flex items-center justify-center shadow text-sm">
                                    ✕
                                </button>
                            </div>

                            <label x-show="!preview"
                                class="flex flex-col items-center justify-center w-full aspect-video border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:border-gray-400 transition text-gray-400">
                                <span class="text-2xl mb-1">+</span>
                                <span class="text-xs">Görsel seç</span>
                                <input type="file" x-ref="imageInput" name="image" accept="image/*"
                                    @change="onFile($event)" class="hidden">
                            </label>
                        </div>

                        <label x-show="preview"
                            class="mt-2 block text-xs text-center text-gray-500 hover:text-gray-700 cursor-pointer">
                            Görseli değiştir
                            <input type="file" x-ref="imageInputChange" name="image" accept="image/*"
                                @change="onFile($event)" class="hidden">
                        </label>
                    </div>

                    {{-- Yayın Ayarları --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                        <p class="text-xs font-medium text-gray-700">Yayın Ayarları</p>

                        <div>
                            <label class="block text-xs text-gray-500 mb-1.5">Yayın Tarihi</label>
                            <input type="datetime-local" name="published_at"
                                value="{{ old('published_at', isset($post) ? $post->published_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        </div>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', isset($post) ? $post->is_active : true) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
