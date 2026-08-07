@props(['post'])

<article
    class="group grid overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-shadow hover:shadow-xl md:grid-cols-2">
    <div class="relative aspect-[16/11] overflow-hidden md:aspect-auto">
        <img src="{{ asset('storage/' . $post->image ) ?? asset('images/placeholder.svg') }}" alt="{{ $post->title }}"
            class="size-full object-cover transition-transform duration-500 group-hover:scale-105">
        <span
            class="absolute left-4 top-4 rounded-full bg-accent px-3 py-1 text-xs font-semibold uppercase tracking-wide text-accent-foreground">
            {{ __('posts.featured') }}
        </span>
    </div>

    <div class="flex flex-col justify-center gap-4 p-8 lg:p-10">
        <div class="flex items-center gap-4 text-xs font-medium text-muted-foreground">
            <span class="rounded-full bg-secondary px-2.5 py-1 font-semibold uppercase tracking-wide text-primary">
                {{ $post->badge }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                {{ $post->published_at->translatedFormat('d M Y') }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>
                {{ $post->reading_time }}
            </span>
        </div>

        <h2 class="font-display text-2xl font-bold leading-tight text-balance text-primary md:text-3xl">
            {{ $post->title }}
        </h2>

        <p class="text-pretty leading-relaxed text-muted-foreground">
            {{ $post->excerpt }}
        </p>

        {{-- @dd($post->slug) --}}
        <a href="{{ localizedRoute('posts.show', ['slug' => $post->getTranslation('slug', app()->getLocale())]) }}"
            class="mt-2 inline-flex w-fit items-center gap-2 text-sm font-semibold text-accent transition-colors hover:text-primary">
            {{ __('posts.read_more') }}
            <svg class="size-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</article>
