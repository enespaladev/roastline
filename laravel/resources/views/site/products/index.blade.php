<x-layout.app title="Products | Roastline Nuts Machines">
    <x-products.pagehero :title="__('common.products')" :description="__('common.products_description')" :breadcrumbs="[['label' => __('common.products')]]" />
    <main class="mx-auto max-w-7xl px-6 py-10 lg:py-14">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[320px_1fr] lg:gap-10">
            <x-products.category-sidebar :categories="$categories" />
            {{-- <x-products.product-listing :products="$products" /> --}}
            <x-products.product-listing :products="$products" :sort="$sort" :category="$activeCategory" />
        </div>
    </main>
</x-layout.app>
