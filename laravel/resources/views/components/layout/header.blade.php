@php
    $navItems = [
        ['label' => __('menu.home'),     'href' => route('home', ['locale' => app()->getLocale()])],
        ['label' => __('menu.about'),    'href' => '#hakkimizda'],
        ['label' => __('menu.products'), 'href' => route('products.index', ['locale' => app()->getLocale()])],
        ['label' => __('menu.videos'),   'href' => '#videolar'],
        ['label' => __('menu.docs'),     'href' => '#belgeler'],
        ['label' => __('menu.blog'),     'href' => route('posts.index', ['locale' => app()->getLocale()])],
        ['label' => __('menu.contact'),  'href' => route('contact.index', ['locale' => app()->getLocale()])],
    ];
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="
        scrolled = window.scrollY > 24;
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 24 }, { passive: true })
    "
    :class="scrolled
        ? 'border-b border-gray-200 bg-white/90 backdrop-blur-md'
        : 'border-b border-transparent bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 md:px-6">

        {{-- Logo --}}
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-2.5">
            <img src="{{asset('frontend/images/roastline-logo.webp')}}" alt="" width="300" height="300">
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden items-center gap-7 lg:flex">
            @foreach ($navItems as $item)

                    <a href="{{ $item['href'] }}"
                    :class="scrolled ? 'text-background/90 hover:text-orange-600' : 'text-white/90 hover:text-orange-300'"
                    class="text-sm font-medium transition-colors"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Sağ Alan --}}
        <div class="flex items-center gap-3">

            {{-- Dil Seçici --}}
            <div class="hidden items-center gap-1 sm:flex">
                @foreach(['tr', 'en', 'ar'] as $lang)

                        <a href="{{ url($lang . '/' . ltrim(request()->path(), 'tr/en/ar/')) }}"
                        class="rounded px-2 py-1 text-xs font-medium transition-colors
                               {{ app()->getLocale() === $lang
                                   ? 'bg-accent text-white'
                                   : (request()->is(app()->getLocale().'*') ? 'text-gray-600 hover:text-gray-900' : 'text-white/80 hover:text-white') }}"
                    >
                        {{ strtoupper($lang) }}
                    </a>
                @endforeach
            </div>

            {{-- Telefon --}}

               <a href="tel:+905525553550"
                class="hidden items-center gap-2 rounded-full bg-accent px-4 py-2 text-sm font-semibold text-accent-foreground transition-transform hover:scale-[1.03] sm:inline-flex"
            >
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                </svg>
                +90 552 555 35 50
            </a>

            {{-- Mobile Toggle --}}
            <button
                type="button"
                x-on:click="open = !open"
                :class="scrolled ? 'text-gray-900' : 'text-white'"
                class="inline-flex size-10 items-center justify-center rounded-md lg:hidden"
                aria-label="Menüyü aç/kapat"
            >
                <svg x-show="!open" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-t border-gray-200 bg-white lg:hidden"
    >
        <nav class="mx-auto flex max-w-7xl flex-col px-4 py-2">
            @foreach ($navItems as $item)

                   <a href="{{ $item['href'] }}"
                    x-on:click="open = false"
                    class="border-b border-gray-100 py-3 text-sm font-medium text-gray-700 last:border-b-0 hover:text-orange-600"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- Mobile Dil Seçici --}}
            <div class="flex items-center gap-2 py-3 border-b border-gray-100">
                @foreach(['tr', 'en', 'ar'] as $lang)
                    <a
                        href="{{ url($lang . '/' . ltrim(request()->path(), 'tr/en/ar/')) }}"
                        class="rounded px-2 py-1 text-xs font-medium transition-colors
                               {{ app()->getLocale() === $lang ? 'bg-accent text-white' : 'text-gray-500 hover:text-gray-900' }}"
                    >
                        {{ strtoupper($lang) }}
                    </a>
                @endforeach
            </div>


                <a href="tel:+905525553550"
                class="my-3 inline-flex items-center justify-center gap-2 rounded-full bg-accent px-4 py-2.5 text-sm font-semibold text-white"
            >
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                </svg>
                +90 552 555 35 50
            </a>
        </nav>
    </div>
</header>
