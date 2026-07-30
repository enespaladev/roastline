@props(['product'])

<article
    class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-accent/50 hover:shadow-xl">
    {{-- Image --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-secondary/60">
        @if ($product->badge)
            <span
                class="absolute left-3 top-3 z-10 rounded-full bg-accent px-3 py-1 text-xs font-semibold text-accent-foreground shadow-sm">
                 {{ __($product->badge) }}
            </span>
        @endif
        <img src="{{ asset('storage/' . $product->image ) ?? asset('images/placeholder.svg') }}"
            alt="{{ $product->name }} endüstriyel kavurma makinası"
            class="size-full object-contain p-4 transition-transform duration-500 group-hover:scale-105" />
    </div>

    {{-- Body --}}
    <div class="flex flex-1 flex-col p-5">
        <p class="text-xs font-medium uppercase tracking-wide text-accent-foreground/70">
            {{ __('Bantlı Kavurma') }}
        </p>
        <h3 class="mt-1.5 text-lg font-bold leading-tight text-foreground">{{ $product->name }}</h3>

        <div class="mt-4 grid grid-cols-2 gap-2">
            <div class="flex items-center gap-2 rounded-lg bg-secondary px-3 py-2">
                {{-- Gauge icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="size-4 shrink-0 text-primary">
                    <path d="m12 14 4-4" />
                    <path d="M3.34 19a10 10 0 1 1 17.32 0" />
                </svg>
                <div class="min-w-0">
                    <p class="text-[10px] uppercase text-muted-foreground">{{ __('Kapasite') }}</p>
                    <p class="truncate text-xs font-semibold text-foreground">{{ $product->capacity }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 rounded-lg bg-secondary px-3 py-2">
                {{-- Zap icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="size-4 shrink-0 text-primary">
                    <path
                        d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                </svg>
                <div class="min-w-0">
                    <p class="text-[10px] uppercase text-muted-foreground">{{ __('Güç') }}</p>
                    <p class="truncate text-xs font-semibold text-foreground">{{ $product->power }}</p>
                </div>
            </div>
        </div>


        <a href="{{ localizedRoute('products.show', ['slug' => $product->slug]) }}"
            class="mt-5 flex items-center justify-between rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-primary-foreground transition-colors hover:bg-primary/90">
            {{ __('Detayları İncele') }}
            {{-- ArrowUpRight icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="size-4 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                <path d="M7 7h10v10" />
                <path d="M7 17 17 7" />
            </svg>
        </a>
    </div>
</article>
