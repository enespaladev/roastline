<x-layout.app title="Blog | Roastline Nuts Machines">
    <x-videos.page-hero title="{{ __('posts.title') }}"
        description="{{ __('posts.description') }}" :breadcrumbs="[['label' => __('common.home'), 'url' => localizedRoute('home')], ['label' => __('posts.title')]]" />

    {{-- <x-blog.featured-card :post="$posts[0]" /> --}}
    <x-blog.grid :posts="$posts" />
    {{-- <x-blog.card :posts="$posts" /> --}}
</x-layout.app>
