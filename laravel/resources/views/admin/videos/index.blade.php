@extends('admin.layout')

@section('title', 'Videolar')

@section('content')
    <div class="mx-auto ">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Videolar</h1>
            <a href="{{ route('admin.videos.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                + Yeni Video
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Önizleme</th>
                        <th class="px-4 py-3">Başlık</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Süre</th>
                        <th class="px-4 py-3">Sıra</th>
                        <th class="px-4 py-3">Durum</th>
                        <th class="px-4 py-3 text-right">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($videos as $video)
                        <tr>
                            <td class="px-4 py-3">
                                <img src="{{ $video->thumbnail_url }}" class="h-12 w-20 rounded object-cover" alt="">
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $video->getTranslation('title', 'tr') }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $video->getTranslation('category', 'tr') }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $video->duration }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $video->order }}</td>
                            <td class="px-4 py-3">
                                @if ($video->is_active)
                                    <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">Pasif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.videos.edit', $video) }}" class="mr-3 text-brand hover:underline">Düzenle</a>
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline" onsubmit="return confirm('Silinsin mi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-400">Henüz video eklenmemiş.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $videos->links() }}
        </div>
    </div>
@endsection
