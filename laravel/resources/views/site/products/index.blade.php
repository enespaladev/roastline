<x-layout.app title="Products | Roastline Nuts Machines">
    <x-products.pagehero :title="$products->getTranslation('name', app()->getLocale())" :description="$product->getTranslation('short_description', app()->getLocale())" :breadcrumbs="[
        ['label' => __('common.products'), 'url' => route('products.index', app()->getLocale())],
        ['label' => $product->getTranslation('name', app()->getLocale())],
    ]" />
</x-layout.app>
