<x-layout.app title="About | Roastline Nuts Roasting Machines" >
    <x-about.page-hero title="{{ __('about.title') }}"
        description="{{ __('about.description') }}" :breadcrumbs="[['label' => __('common.home'), 'url' => localizedRoute('home')], ['label' => __('about.title')]]" />
        <x-about.brand-story />
    <x-about.brand-values />
    <x-about.about-footer />
</x-layout.app>
