@props(['product'])

@php
    $locale = app()->getLocale();

    // Görsel dizisi: ana görsel + galeri görselleri.
    // Kendi modelindeki gerçek alan adına göre düzenle (ör. $product->images ilişkisi olabilir).
    $images = collect([$product->image ?? null])
        ->merge($product->gallery_images ?? [])
        ->filter()
        ->map(fn ($img) => asset('storage/' . $img))
        ->values();

    $highlights = [
        [
            'icon' => 'gauge',
            'label' => __('Capacity'),
            'value' => $product->getTranslation('capacity', $locale),
            'unit'  => 'kg'
        ],
        ['icon' => 'flame', 'label' => __('Power'), 'value' => $product->getTranslation('power', $locale)],
        ['icon' => 'users', 'label' => __('Manpower'), 'value' => __('Minimal operator need')],
        ['icon' => 'shield-check', 'label' => __('Control'), 'value' => __('Fully automatic')],
    ];

    $shareLinks = [
        ['icon' => 'facebook', 'label' => __('Share on Facebook')],
        ['icon' => 'x', 'label' => __('Share on X')],
        ['icon' => 'linkedin', 'label' => __('Share on LinkedIn')],
        ['icon' => 'pinterest', 'label' => __('Share on Pinterest')],
        ['icon' => 'whatsapp', 'label' => __('Share on WhatsApp')],
    ];
@endphp

<section class="mx-auto max-w-7xl px-6 py-10 lg:py-16" x-data="{ active: 0, images: @js($images) }">
    <div class="grid gap-10 lg:grid-cols-2 lg:gap-14">
        {{-- Gallery --}}
        <div class="flex flex-col gap-4">
            <div class="relative aspect-4/3 overflow-hidden rounded-2xl border border-border bg-linear-to-b from-secondary to-background">
                @if ($product->badge)
                    <span class="absolute left-4 top-4 z-10 rounded-full bg-accent px-3 py-1 text-xs font-semibold uppercase tracking-wide text-accent-foreground">
                        {{ $product->getTranslation('badge', $locale) }}
                    </span>
                @endif

                <template x-for="(img, i) in images" :key="img">
                    <img
                        x-show="active === i"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        :src="img"
                        :alt="'{{ $product->getTranslation('name', $locale) }}'"
                        class="absolute inset-0 h-full w-full object-contain p-6"
                    />
                </template>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <template x-for="(img, i) in images" :key="'thumb-' + img">
                    <button
                        type="button"
                        @click="active = i"
                        :aria-pressed="active === i"
                        class="relative aspect-4/3 overflow-hidden rounded-xl border-2 bg-secondary transition-colors"
                        :class="active === i ? 'border-primary' : 'border-transparent hover:border-border'"
                    >
                        <img :src="img" alt="" class="h-full w-full object-contain p-2" />
                    </button>
                </template>
            </div>
        </div>

        {{-- Info --}}
        <div class="flex flex-col">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-foreground/70">
                Roastline
                @if ($product->model_number)
                    &middot; {{ __('Model') }} {{ $product->model_number }}
                @endif
            </p>

            <h1 class="mt-2 text-balance font-display text-4xl font-bold leading-tight text-primary lg:text-5xl">
                {{ $product->getTranslation('name', $locale) }}
            </h1>

            <p class="mt-5 text-pretty leading-relaxed text-muted-foreground">
                {!! $product->getTranslation('description', $locale) !!}
            </p>

            {{-- Highlights --}}
            <dl class="mt-8 grid grid-cols-2 gap-4">
                @foreach ($highlights as $item)
                    <div class="flex items-start gap-3 rounded-xl border border-border bg-card p-4">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-secondary text-primary">
                            <x-icon name="{{ $item['icon'] }}" class="size-4.5" />
                        </span>
                        <div>
                            <dt class="text-xs uppercase tracking-wide text-muted-foreground">
                                {{ $item['label'] }}
                            </dt>
                            <dd class="text-sm font-semibold text-foreground">
                                {{ $item['value'] }} {{ $item['unit'] ?? '' }}
                            </dd>
                        </div>
                    </div>
                @endforeach
            </dl>

            {{-- Actions --}}
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ localizedRoute('contact.index') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-primary px-6 py-3 font-semibold text-primary-foreground transition-transform hover:-translate-y-0.5">
                    {{ __('Request a Quote') }}
                    <x-icon name="chevron-right" class="size-4" />
                </a>
                <a href="tel:+905525553550"
                   class="inline-flex items-center gap-2 rounded-lg border border-border px-6 py-3 font-semibold text-primary transition-colors hover:bg-secondary">
                    {{ __('Call Sales') }}
                </a>
            </div>

            {{-- Share --}}
            <div class="mt-8 flex items-center gap-3 border-t border-border pt-6">
                <span class="text-sm font-medium text-muted-foreground">{{ __('Share') }}</span>
                <div class="flex items-center gap-2">
                    @foreach ($shareLinks as $share)
                        <a href="#" aria-label="{{ $share['label'] }}"
                           class="grid size-9 place-items-center rounded-full border border-border text-muted-foreground transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground">
                            <x-icon name="{{ $share['icon'] }}" class="size-4" />
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
