@extends('admin.layout')

@section('title', 'Sayfalar')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h3 class="text-base font-medium text-gray-900">Tum Sayfalar</h3>
    <a href="{{ route('admin.pages.create') }}"
       class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
        + Yeni Sayfa
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Baslik (TR)</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Slug</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Durum</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Islemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pages as $page)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $page->getTranslation('title', 'tr') }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $page->slug }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $page->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                        {{ $page->is_active ? 'Aktif' : 'Pasif' }}
                    </span>
                </td>
                <td class="px-4 py-3 flex items-center gap-2">
                    <a href="{{ route('admin.pages.edit', $page) }}"
                       class="text-gray-500 hover:text-gray-900 text-xs">Duzenle</a>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}"
                          onsubmit="return confirm('Emin misiniz?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-gray-400">Henuz sayfa eklenmemis</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
