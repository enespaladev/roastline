@extends('admin.layout')

@section('title', isset($category) ? 'Ürün Duzenle' : 'Yeni Ürün')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ isset($category) ? route('admin.products.update', $category) : route('admin.products.store') }}">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Ad (TR) *</label>
                    <input type="text" name="name_tr"
                           value="{{ old('name_tr', isset($category) ? $category->getTranslation('name', 'tr') : '') }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Ad (EN) *</label>
                    <input type="text" name="name_en"
                           value="{{ old('name_en', isset($category) ? $category->getTranslation('name', 'en') : '') }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Ad (AR) *</label>
                    <input type="text" name="name_ar"
                           value="{{ old('name_ar', isset($category) ? $category->getTranslation('name', 'ar') : '') }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Aciklama (TR)</label>
                    <textarea name="description_tr" rows="3"
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_tr', isset($category) ? $category->getTranslation('description', 'tr') : '') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Aciklama (EN)</label>
                    <textarea name="description_en" rows="3"
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_en', isset($category) ? $category->getTranslation('description', 'en') : '') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Aciklama (AR)</label>
                    <textarea name="description_ar" rows="3"
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description_ar', isset($category) ? $category->getTranslation('description', 'ar') : '') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Sira</label>
                    <input type="number" name="order"
                           value="{{ old('order', isset($category) ? $category->order : 0) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', isset($category) ? $category->is_active : true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                </div>
            </div>

            @if($errors->any())
                <div class="text-red-500 text-sm">{{ $errors->first() }}</div>
            @endif

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                    {{ isset($category) ? 'Guncelle' : 'Kaydet' }}
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="text-gray-500 text-sm hover:text-gray-700">Iptal</a>
            </div>
        </div>
    </form>
</div>
@endsection
