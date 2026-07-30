@extends('admin.layout')

@section('title', isset($product) ? 'Ürün Düzenle' : 'Yeni Ürün')

@php
    $badges = [
        ['title' => __('product.new'), 'value' => 'new'],
        ['title' => __('product.popular'), 'value' => 'popular'],
        ['title' => __('product.highcapacity'), 'value' => 'highcapacity'],
    ];
@endphp

@section('content')
    <div class="">
        <form method="POST"
            enctype="multipart/form-data"
            action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">

                <!-- Kategori Seçimi -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="category_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 bg-white"
                        required>
                        <option value="">Kategori Seçin</option>
                        @foreach ($categories as $categoryOption)
                            <option value="{{ $categoryOption->id }}"
                                {{ old('category_id', isset($product) ? $product->category_id : '') == $categoryOption->id ? 'selected' : '' }}>
                                {{ $categoryOption->getTranslation('name', 'tr') }} {{-- Eğer kategori modelinde çeviri yoksa sadece $categoryOption->name kullanabilirsiniz --}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- İsim Alanları -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Ad (TR) *</label>
                        <input type="text" name="name_tr"
                            value="{{ old('name_tr', isset($product) ? $product->getTranslation('name', 'tr') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                            required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Ad (EN) *</label>
                        <input type="text" name="name_en"
                            value="{{ old('name_en', isset($product) ? $product->getTranslation('name', 'en') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                            required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Ad (AR) *</label>
                        <input type="text" name="name_ar"
                            value="{{ old('name_ar', isset($product) ? $product->getTranslation('name', 'ar') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                            required>
                    </div>
                </div>

                <!-- Açıklama Alanları -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Açıklama (TR)</label>
                        <textarea name="description_tr" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_tr', isset($product) ? $product->getTranslation('description', 'tr') : '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Açıklama (EN)</label>
                        <textarea name="description_en" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_en', isset($product) ? $product->getTranslation('description', 'en') : '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Açıklama (AR)</label>
                        <textarea name="description_ar" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_ar', isset($product) ? $product->getTranslation('description', 'ar') : '') }}</textarea>
                    </div>
                </div>

                <!-- Rozet (Badge) -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">İşaret</label>
                        <select name="badge"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 bg-white"
                            required>
                            <option value="">İşaret Seçin</option>
                            @foreach ($badges as $badge)
                                <option value="{{ $badge['value'] }}"
                                    {{ old('badge', isset($badge) ? $badge['title'] : '') == $badge['title'] ? 'selected' : '' }}>
                                    {{ $badge['title'] }} {{-- Eğer kategori modelinde çeviri yoksa sadece $categoryOption->name kullanabilirsiniz --}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Kavrulan Ürünler -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4"
                    x-data='{
        items: {{ isset($roastedItems) ? json_encode($roastedItems) : '[]' }}
    }'>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kavrulan Ürünler</label>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" :name="'roasted_name_tr[]'" x-model="item.name_tr"
                                    placeholder="Ad (TR) — örn: Tuzlu Fıstık"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                            </div>
                            <div class="flex-1">
                                <input type="text" :name="'roasted_name_en[]'" x-model="item.name_en"
                                    placeholder="Ad (EN) — e.g: Salted Peanuts"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                            </div>
                            <div class="flex-1">
                                <input type="text" :name="'roasted_name_ar[]'" x-model="item.name_ar"
                                    placeholder="Ad (AR)" dir="rtl"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                            </div>
                            <div class="w-28">
                                <input type="number" step="0.01" :name="'roasted_kg[]'" x-model="item.kg"
                                    placeholder="Kg"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                            </div>
                            <button type="button" @click="items.splice(index, 1)"
                                class="text-red-500 hover:text-red-700 px-2 py-2 text-sm">Sil</button>
                        </div>
                    </template>

                    <button type="button" @click="items.push({ name_tr: '', name_en: '', name_ar: '', kg: '' })"
                        class="text-sm text-gray-700 border border-gray-300 rounded-lg px-3 py-1.5 hover:bg-gray-50">
                        + Ürün Ekle
                    </button>
                </div>

                <!-- Enerji Özellikleri -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Enerji Tüketimi — Dizel (lt/saat)</label>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Min</label>
                            <input type="number" step="0.01" name="diesel_min"
                                value="{{ old('diesel_min', isset($product) ? $product->energy_specs['diesel']['min'] ?? '' : '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Max</label>
                            <input type="number" step="0.01" name="diesel_max"
                                value="{{ old('diesel_max', isset($product) ? $product->energy_specs['diesel']['max'] ?? '' : '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Ortalama</label>
                            <input type="number" step="0.01" name="diesel_avg"
                                value="{{ old('diesel_avg', isset($product) ? $product->energy_specs['diesel']['avg'] ?? '' : '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        </div>
                    </div>
                </div>

                <!-- Kapasite Alanları -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Kapasite</label>
                        <input type="text" name="capacity" placeholder="Örn: 1000 kg/saat"
                            value="{{ old('capacity_tr', isset($product) ? $product->getTranslation('capacity', 'tr') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                </div>

                <!-- Kapasite Sıralama Değeri -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">
                        Kapasite Sıralama Değeri (sayı) *
                        <span class="text-gray-400 font-normal">— sadece sayı, örn: 1000</span>
                    </label>
                    <input type="number" name="capacity_value"
                        value="{{ old('capacity_value', isset($product) ? $product->capacity_value : '') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>

                <!-- Güç Alanları -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Güç (TR)</label>
                        <input type="text" name="power_tr" placeholder="Örn: 15 kW"
                            value="{{ old('power_tr', isset($product) ? $product->getTranslation('power', 'tr') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Güç (EN)</label>
                        <input type="text" name="power_en" placeholder="e.g: 15 kW"
                            value="{{ old('power_en', isset($product) ? $product->getTranslation('power', 'en') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Güç (AR)</label>
                        <input type="text" name="power_ar"
                            value="{{ old('power_ar', isset($product) ? $product->getTranslation('power', 'ar') : '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                            dir="rtl">
                    </div>
                </div>

                <!-- Görsel Yükleme -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-3" x-data="{ preview: {{ isset($product) && $product->image ? '\'' . asset('storage/' . $product->image) . '\'' : 'null' }} }">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Ürün Görseli</label>

                    <div class="flex items-center gap-4">
                        <template x-if="preview">
                            <img :src="preview" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                        </template>

                        <div class="flex-1">
                            <input type="file" name="image" accept="image/*"
                                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview"
                                class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-900 file:text-white file:text-sm hover:file:bg-gray-800">
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG veya WEBP. Boş bırakırsan mevcut görsel korunur.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ayarlar -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Sıra</label>
                        <input type="number" name="order"
                            value="{{ old('order', isset($product) ? $product->order : 0) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    <div class="flex items-center gap-2 mt-5">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', isset($product) ? $product->is_active : true) ? 'checked' : '' }}>
                        <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm p-2 bg-red-50 rounded-lg">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                        {{ isset($product) ? 'Güncelle' : 'Kaydet' }}
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="text-gray-500 text-sm hover:text-gray-700">İptal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
