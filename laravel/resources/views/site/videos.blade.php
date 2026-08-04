<x-layout.app title="Videos | Roastline Nuts Machines">
    <x-videos.page-hero badge="{{ __('common.media') }}" title="{{ __('videos.title') }}"
        description="{{ __('videos.description') }}" :breadcrumbs="[['label' => __('common.home'), 'url' => localizedRoute('home')], ['label' => __('videos.title')]]" />

    <x-videos.video-gallery :videos="$videos" />
</x-layout.app>
