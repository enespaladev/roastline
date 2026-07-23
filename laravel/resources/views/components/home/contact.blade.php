@php
    $info = [
        [
            'icon' => 'map-pin',
            'label' => 'Adres',
            'value' => 'Eskihisar Mah. 8016 Sk. No: 8, Merkezefendi, Denizli / Türkiye',
        ],
        [
            'icon' => 'phone',
            'label' => 'Telefon',
            'value' => '+90 552 555 35 50',
            'href' => 'tel:+905525553550',
        ],
        [
            'icon' => 'mail',
            'label' => 'E-posta',
            'value' => 'info@roastline.com.tr',
            'href' => 'mailto:info@roastline.com.tr',
        ],
        [
            'icon' => 'clock',
            'label' => 'Çalışma Saatleri',
            'value' => 'Pzt-Cuma 08:00-18:00 · Cmt 08:00-13:00',
        ],
    ];
@endphp

<section id="iletisim" class="bg-secondary py-20 md:py-28">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 md:px-6 lg:grid-cols-2 lg:gap-16">
        <div>
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                İletişim
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                Detaylı bilgi için bize ulaşın
            </h2>
            <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
                İhtiyaçlarınıza en uygun makineyi birlikte belirleyelim. Ekibimiz
                fiyat teklifi ve teknik sorularınız için hazır.
            </p>

            <ul class="mt-10 space-y-6">
                @foreach ($info as $item)
                    <li class="flex gap-4">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            @switch($item['icon'])
                                @case('map-pin')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    @break
                                @case('phone')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                        <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384Z"/>
                                    </svg>
                                    @break
                                @case('mail')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                    @break
                                @case('clock')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    @break
                            @endswitch
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-foreground">{{ $item['label'] }}</p>
                            @if (!empty($item['href']))
                                <a href="{{ $item['href'] }}" class="text-sm text-muted-foreground hover:text-accent">
                                    {{ $item['value'] }}
                                </a>
                            @else
                                <p class="text-sm text-muted-foreground">{{ $item['value'] }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Form action'ı kendi route'unuza göre değiştirin --}}
        <form method="POST" action="{{ route('contact.store', ['locale' => app()->getLocale()]) }}" class="rounded-2xl border border-border bg-card p-6 shadow-sm md:p-8">
            @csrf

            @if (session('success'))
                <div class="mb-5 rounded-lg bg-primary/10 px-4 py-3 text-sm text-primary">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <label for="name" class="mb-1.5 block text-sm font-medium text-foreground">
                        Ad Soyad
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        required
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border border-input bg-background px-3.5 py-2.5 text-sm outline-none transition-colors focus:border-accent focus:ring-2 focus:ring-accent/30"
                        placeholder="Adınız"
                    />
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="phone" class="mb-1.5 block text-sm font-medium text-foreground">
                        Telefon
                    </label>
                    <input
                        id="phone"
                        name="phone"
                        type="tel"
                        value="{{ old('phone') }}"
                        class="w-full rounded-lg border border-input bg-background px-3.5 py-2.5 text-sm outline-none transition-colors focus:border-accent focus:ring-2 focus:ring-accent/30"
                        placeholder="+90"
                    />
                    @error('phone')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="mb-1.5 block text-sm font-medium text-foreground">
                        E-posta
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-input bg-background px-3.5 py-2.5 text-sm outline-none transition-colors focus:border-accent focus:ring-2 focus:ring-accent/30"
                        placeholder="ornek@mail.com"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="message" class="mb-1.5 block text-sm font-medium text-foreground">
                        Mesajınız
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        class="w-full resize-none rounded-lg border border-input bg-background px-3.5 py-2.5 text-sm outline-none transition-colors focus:border-accent focus:ring-2 focus:ring-accent/30"
                        placeholder="İhtiyacınızı kısaca anlatın"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button
                type="submit"
                class="mt-6 w-full rounded-full bg-primary px-6 py-3.5 font-semibold text-primary-foreground transition-transform hover:scale-[1.02]"
            >
                Teklif İste
            </button>
        </form>
    </div>
</section>
