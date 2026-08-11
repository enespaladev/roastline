@props([
    'product' => null,
    'category' => null, // kategori listeleme sayfası için (ürün olmadan)
    'title' => null, // özel sayfalar için manuel başlık override
    'trail' => null, // tamamen manuel trail geçmek istersen
])

@php
    $locale = app()->getLocale();

    if ($trail === null) {
        $trail = [
            ['label' => __('product.home'), 'href' => localizedRoute('home')],
            ['label' => __('product.ourproducts'), 'href' => localizedRoute('products.index')],
        ];

        $resolvedCategory = $product?->category ?? $category;

        if ($resolvedCategory) {
            $trail[] = [
                'label' => $resolvedCategory->getTranslation('name', $locale),
                // 'href' => localizedRoute('products.category', ['slug' => $resolvedCategory->getTranslation('slug', $locale)]),
                    'href' => localizedRoute('products.category', ['categorySlug' => $resolvedCategory->getTranslation('slug', $locale)]),
            ];
        }

        if ($product) {
            $trail[] = [
                'label' => $product->getTranslation('name', $locale),
                'href' => '#',
            ];
        }
    }

    $pageTitle = $title ?? ($product?->getTranslation('name', $locale) ?? $category?->getTranslation('name', $locale));
@endphp

<div class="border-b border-border bg-secondary/50 mt-22">
    <div class="mx-auto flex max-w-7xl flex-col gap-2 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="font-display text-xl font-semibold text-primary">
            {{ $pageTitle }}
        </h2>

        <nav aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center gap-1.5 text-sm text-muted-foreground">
                @foreach ($trail as $index => $item)
                    <li class="flex items-center gap-1.5">
                        @if ($index > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="size-3.5 opacity-50">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        @endif

                        @if ($index === count($trail) - 1)
                            <span class="font-medium text-primary">{{ $item['label'] }}</span>
                        @else
                            <a href="{{ $item['href'] }}" class="transition-colors hover:text-primary">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
