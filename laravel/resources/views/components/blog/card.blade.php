@props(['post'])

<article
    class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-shadow hover:shadow-xl">
    <div class="relative aspect-[16/10] overflow-hidden">
        <img src="{{ asset('storage/' . $post->image ) ?? asset('images/placeholder.svg') }}" alt="{{ $post->title }}"
            class="size-full object-cover transition-transform duration-500 group-hover:scale-105">
        <span
            class="absolute left-4 top-4 rounded-full bg-card/90 px-2.5 py-1 text-xs font-semibold uppercase tracking-wide text-primary backdrop-blur">
            {{ $post->badge }}
            {{-- test --}}
        </span>
    </div>

    <div class="flex flex-1 flex-col gap-3 p-6">
        <div class="flex items-center gap-4 text-xs font-medium text-muted-foreground">
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

        <h3 class="font-display text-lg font-bold leading-snug text-balance text-primary">
            {{ $post->title }}
        </h3>

        <p class="text-sm leading-relaxed text-muted-foreground">
            {{ $post->excerpt }}
        </p>


        <a href="{{ localizedRoute('posts.show', ['slug' => $post->slug]) }}"
            class="mt-auto inline-flex w-fit items-center gap-2 pt-2 text-sm font-semibold text-accent transition-colors hover:text-primary">
            {{ __('posts.read_more') }}
            <svg class="size-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</article>
