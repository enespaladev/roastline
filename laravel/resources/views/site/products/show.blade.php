<div class="flex min-h-screen flex-col">
    <x-layout.app title="Products | Roastline Nuts Machines">
        <main class="flex-1">
            <x-products.breadcrumb :product="$product" />
            <x-products.product-hero :product="$product" />
            <x-products.product-specs :product="$product" />
        </main>
    </x-layout.app>
</div>
