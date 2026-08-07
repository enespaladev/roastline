@props(['posts'])

@php
    $featured = $posts->first();
    $rest = $posts->skip(1);
@endphp

<section class="mx-auto max-w-7xl px-6 py-16 md:py-20">
    <div class="mx-auto mb-12 max-w-2xl text-center">
        <span class="text-sm font-semibold uppercase tracking-widest text-accent">
            {{ __('posts.latest_articles') }}
        </span>
        <h2 class="mt-3 font-display text-3xl font-bold text-balance text-primary md:text-4xl">
            {{ __('posts.section_title') }}
        </h2>
        <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
            {{ __('posts.description') }}
        </p>
    </div>

    @if($featured)
        <div class="mb-8">
            <x-blog.featured-card :post="$featured" />
        </div>
    @endif

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
        @foreach($rest as $post)
            <x-blog.card :post="$post" />
        @endforeach
    </div>
</section>
