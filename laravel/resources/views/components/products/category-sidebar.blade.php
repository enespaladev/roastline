@props(['categories' => []])

<aside class="flex flex-col gap-6">
    <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-sm">
        <div class="flex items-center gap-2.5 border-b border-border bg-primary px-5 py-4 text-primary-foreground">
            {{-- LayoutGrid icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="size-5 text-accent">
                <rect width="7" height="7" x="3" y="3" rx="1" />
                <rect width="7" height="7" x="14" y="3" rx="1" />
                <rect width="7" height="7" x="14" y="14" rx="1" />
                <rect width="7" height="7" x="3" y="14" rx="1" />
            </svg>
            <h2 class="text-sm font-bold uppercase tracking-wide">{{ __('Ürün Kategorileri') }}</h2>
        </div>

        <nav class="p-2">
            @foreach ($categories as $cat)
                <a href="{{ $cat->url ?? '#' }}" @if ($cat->active ?? false) aria-current="page" @endif
                    class="group flex items-center justify-between gap-2 rounded-xl px-3 py-3 text-sm transition-colors {{ $cat->active ?? false
                        ? 'bg-secondary font-semibold text-primary'
                        : 'text-foreground/75 hover:bg-secondary hover:text-primary' }}">
                    <span class="flex items-center gap-2">
                        {{-- ChevronRight icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="size-4 shrink-0 transition-transform {{ $cat->active ?? false ? 'text-accent' : 'text-muted-foreground group-hover:translate-x-0.5' }}">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                        <span class="text-pretty leading-snug">{{ $cat->name }}</span>
                    </span>

                    <span
                        class="shrink-0 rounded-full px-2 py-0.5 text-xs font-semibold {{ $cat->active ?? false ? 'bg-accent text-accent-foreground' : 'bg-secondary text-muted-foreground' }}">
                        {{ $cat->count }}
                    </span>
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Help card --}}
    <div class="relative overflow-hidden rounded-2xl bg-primary p-6 text-primary-foreground shadow-sm">
        <div class="relative z-10">
            <span class="mb-4 flex size-11 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                {{-- Headset icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                    <path
                        d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H4a1 1 0 0 1-1-1v-4a9 9 0 0 1 18 0v4a1 1 0 0 1-1 1h-2a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3" />
                    <path d="M21 16v2a4 4 0 0 1-4 4h-5" />
                </svg>
            </span>
            <h3 class="text-lg font-bold">{{ __('Yardıma mı ihtiyacınız var?') }}</h3>
            <p class="mt-2 text-sm leading-relaxed text-primary-foreground/80">
                {{ __('Üretim kapasitenize en uygun kavurma hattını birlikte belirleyelim.') }}
            </p>
            {{-- <x-products.button class="mt-4 w-full bg-accent font-semibold text-accent-foreground hover:bg-accent/90">
                {{ __('Uzmanla Görüş') }}
            </x-products.button> --}}
            <button class="group/button inline-flex shrink-0 items-center justify-center rounded-lg border border-transparent bg-clip-padding text-sm whitespace-nowrap transition-all outline-none select-none focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 active:not-aria-[haspopup]:translate-y-px disabled:pointer-events-none disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:border-destructive/50 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 [a]:hover:bg-primary/80 h-8 gap-1.5 px-2.5 has-data-[icon=inline-end]:pr-2 has-data-[icon=inline-start]:pl-2 mt-4 w-full bg-accent font-semibold text-accent-foreground hover:bg-accent/90">
                {{ __('Uzmanla Görüş') }}
            </button>
        </div>
        <div class="pointer-events-none absolute -right-8 -top-8 size-32 rounded-full bg-accent/15"></div>
    </div>
</aside>
