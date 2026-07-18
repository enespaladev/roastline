@extends('admin.layout')

@section('title', 'Mesaj Detayi')

@section('content')
<div class="max-w-2xl bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <div class="grid grid-cols-2 gap-4 text-sm">
        <div><span class="text-gray-500">Ad:</span> <span class="font-medium">{{ $message->name }}</span></div>
        <div><span class="text-gray-500">E-posta:</span> {{ $message->email }}</div>
        <div><span class="text-gray-500">Telefon:</span> {{ $message->phone ?? '-' }}</div>
        <div><span class="text-gray-500">Sirket:</span> {{ $message->company ?? '-' }}</div>
        <div><span class="text-gray-500">Dil:</span> {{ strtoupper($message->locale) }}</div>
        <div><span class="text-gray-500">Tarih:</span> {{ $message->created_at->format('d.m.Y H:i') }}</div>
    </div>
    <div class="border-t border-gray-100 pt-4">
        <p class="text-xs text-gray-500 mb-2">Mesaj:</p>
        <p class="text-sm text-gray-800 leading-relaxed">{{ $message->message }}</p>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-900">← Geri Don</a>
</div>
@endsection
