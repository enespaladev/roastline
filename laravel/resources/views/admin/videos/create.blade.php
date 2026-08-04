@extends('admin.layout')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-6 text-2xl font-bold text-gray-900">Yeni Video Ekle</h1>

        <form action="{{ route('admin.videos.store') }}" method="POST" class="rounded-xl border border-gray-200 bg-white p-6">
            @csrf
            @include('admin.videos._form')

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.videos.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700">İptal</a>
                <button type="submit" class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-800 transition">Kaydet</button>
            </div>
        </form>
    </div>
@endsection
