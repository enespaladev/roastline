{{--
    resources/views/components/blog/sidebar.blade.php

    Kullanım (posts/show.blade.php içinde):
    <x-blog.sidebar :popular-posts="$popularPosts" :labels="$labels" />

    Beklenen veri:
    - $popularPosts: Post modeli koleksiyonu (title, slug alanları translatable).
      Controller tarafında örn:
        $popularPosts = Post::query()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(5)
            ->get();
    - $labels: Tag/Category modeli koleksiyonu (name, slug translatable).
      Örn: $labels = Tag::orderBy('name')->get();

    Rota isimlerini (posts.show / blog.tag) kendi RouteTranslator / lroute() yapına göre güncelle.
--}}
@props([
    'popularPosts' => collect(),
    'labels' => collect(),
])

<aside class="flex flex-col gap-6 lg:sticky lg:top-28">
    {{-- Popular posts --}}
    <section class="rounded-2xl border border-border bg-card p-6">
        <h2 class="font-serif text-xl font-semibold text-foreground">{{ __('blog.popular_posts') }}</h2>
        <div class="mt-2 h-0.5 w-10 rounded-full bg-gold"></div>

        <ul class="mt-5 flex flex-col">
            @forelse ($popularPosts as $index => $popularPost)
                <li>
                    <a
                        href="{{ lroute('posts.show', $popularPost->slug) }}"
                        class="group flex items-start gap-4 border-b border-border py-4 last:border-0 last:pb-0"
                    >
                        <span class="font-serif text-2xl font-bold leading-none text-brand/25 transition-colors group-hover:text-gold">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="text-sm font-medium leading-snug text-foreground transition-colors group-hover:text-brand">
                            {{ $popularPost->title }}
                        </span>
                        <x-icon name="arrow-up-right" class="ml-auto h-4 w-4 shrink-0 text-muted-foreground opacity-0 transition-opacity group-hover:opacity-100" />
                    </a>
                </li>
            @empty
                <li class="py-4 text-sm text-muted-foreground">{{ __('blog.no_popular_posts') }}</li>
            @endforelse
        </ul>
    </section>

    {{-- Labels --}}
    <section class="rounded-2xl border border-border bg-card p-6">
        <h2 class="flex items-center gap-2 font-serif text-xl font-semibold text-foreground">
            <x-icon name="tag" class="h-4 w-4 text-brand" /> {{ __('blog.labels') }}
        </h2>
        <div class="mt-2 h-0.5 w-10 rounded-full bg-gold"></div>

        <div class="mt-5 flex flex-wrap gap-2">
            @forelse ($labels as $label)
                <a
                    href="{{ lroute('posts.byLabel', $label->slug) }}"
                    class="rounded-full border border-border bg-secondary px-3 py-1.5 text-xs font-medium text-muted-foreground transition-colors hover:border-brand hover:bg-brand hover:text-brand-foreground"
                >
                    {{ $label->name }}
                </a>
            @empty
                <span class="text-sm text-muted-foreground">{{ __('blog.no_labels') }}</span>
            @endforelse
        </div>
    </section>

    {{-- CTA card --}}
    <section class="overflow-hidden rounded-2xl bg-brand p-6 text-brand-foreground">
        <h2 class="font-serif text-xl font-semibold">{{ __('blog.cta_title') }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-brand-foreground/80">
            {{ __('blog.cta_description') }}
        </p>
        <a
            href="{{ lroute('products.index') }}"
            class="mt-4 inline-flex items-center gap-2 rounded-full bg-gold px-4 py-2 text-sm font-semibold text-gold-foreground transition-transform hover:-translate-y-0.5"
        >
            {{ __('blog.cta_button') }} <x-icon name="arrow-up-right" class="h-4 w-4" />
        </a>
    </section>
</aside>
