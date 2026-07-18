<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roastline Admin — Giris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 w-full max-w-md">
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-semibold text-gray-900">Roastline</h1>
        <p class="text-gray-500 text-sm mt-1">Yonetim Paneli</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                placeholder="admin@roastline.com.tr" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sifre</label>
            <input type="password" name="password"
                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                placeholder="••••••••" required>
        </div>

        @if($errors->any())
            <p class="text-red-500 text-sm">{{ $errors->first() }}</p>
        @endif

        <button type="submit"
            class="w-full bg-gray-900 text-white rounded-lg py-2.5 text-sm font-medium hover:bg-gray-800 transition">
            Giris Yap
        </button>
    </form>
</div>

</body>
</html>
