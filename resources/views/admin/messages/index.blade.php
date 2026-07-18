@extends('admin.layout')

@section('title', 'Mesajlar')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Ad</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">E-posta</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Sirket</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Tarih</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Durum</th>
                <th class="text-left px-4 py-3 text-xs font-medium text-gray-500">Islem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($messages as $message)
            <tr class="hover:bg-gray-50 {{ !$message->is_read ? 'font-medium' : '' }}">
                <td class="px-4 py-3">{{ $message->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $message->email }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $message->company ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $message->created_at->format('d.m.Y H:i') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ !$message->is_read ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ !$message->is_read ? 'Yeni' : 'Okundu' }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('admin.messages.show', $message) }}" class="text-gray-500 hover:text-gray-900 text-xs">Goruntule</a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Emin misiniz?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 text-xs">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-400">Henuz mesaj yok</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3">{{ $messages->links() }}</div>
</div>
@endsection
