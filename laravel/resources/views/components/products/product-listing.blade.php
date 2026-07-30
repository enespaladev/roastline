@props(['products' => collect(), 'sort' => 'newest'])

<section aria-label="Ürün listesi">
    <div class="flex flex-col gap-2 border-b border-border pb-4">
        <h1 class="text-2xl font-bold tracking-tight text-foreground text-balance sm:text-3xl">
            {{ __('Bantlı Kuruyemiş Kavurma Makinaları') }}
        </h1>
        <p class="max-w-2xl text-sm leading-relaxed text-muted-foreground">
            {{ __('Endüstriyel ölçekte homojen kavurma sağlayan, tam otomasyonlu bantlı kavurma fırınları. İhtiyacınıza uygun kapasiteyi seçin.') }}
        </p>
    </div>

    <div class="mt-5 flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-muted-foreground">
            {{ __('Toplam ürün sayısı') }} <span class="font-bold text-foreground">{{ $products->count() }}</span>
        </p>

        <form method="GET" x-data="{ sort: '{{ $sort }}' }" @change="$el.submit()" class="relative">
            <select
                name="sort"
                x-model="sort"
                aria-label="{{ __('Sıralama') }}"
                class="appearance-none rounded-xl border border-border bg-card py-2.5 pl-4 pr-10 text-sm font-medium text-foreground shadow-sm outline-none transition-colors hover:border-accent focus-visible:ring-2 focus-visible:ring-ring"
            >
                <option value="newest">{{ __('En Yeni Ürünler') }}</option>
                <option value="capacity-desc">{{ __('Kapasite (Yüksek → Düşük)') }}</option>
                <option value="capacity-asc">{{ __('Kapasite (Düşük → Yüksek)') }}</option>
                <option value="name">{{ __('İsme Göre (A → Z)') }}</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="pointer-events-none absolute right-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </form>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($products as $product)
            <x-products.product-card :product="$product" />
        @endforeach
    </div>
</section>
