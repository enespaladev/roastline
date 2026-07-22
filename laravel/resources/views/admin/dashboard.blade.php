@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs text-gray-500 mb-1">Kategoriler</p>
        <p class="text-3xl font-semibold text-gray-900">{{ $stats['categories'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs text-gray-500 mb-1">Urunler</p>
        <p class="text-3xl font-semibold text-gray-900">{{ $stats['products'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs text-gray-500 mb-1">Blog Yazilari</p>
        <p class="text-3xl font-semibold text-gray-900">{{ $stats['posts'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs text-gray-500 mb-1">Okunmamis Mesajlar</p>
        <p class="text-3xl font-semibold text-gray-900 text-red-500">{{ $stats['messages'] }}</p>
    </div>
</div>
@endsection
