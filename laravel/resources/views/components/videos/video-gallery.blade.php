@props(['videos'])

<section x-data="{ active: null, open(v) { this.active = v }, close() { this.active = null } }" x-on:keydown.escape.window="close()"
    x-effect="document.body.style.overflow = active ? 'hidden' : ''" class="mx-auto max-w-7xl px-6 py-16 md:py-24">
    {{-- Section heading --}}
    <div class="mx-auto mb-14 max-w-2xl text-center">
        <span class="inline-flex items-center gap-2 rounded-full bg-accent px-4 py-1.5 text-sm font-semibold text-brand">
            {{-- Video icon --}}
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m22 8-6 4 6 4V8Z" />
                <rect x="2" y="6" width="14" height="12" rx="2" ry="2" />
            </svg>
            {{ __('videos.section_badge') }}
        </span>
        <h2 class="mt-5 text-balance font-display text-4xl font-extrabold tracking-tight text-foreground md:text-5xl">
            {{ __('videos.section_title') }}
        </h2>
        <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
            {{ __('videos.section_desc') }}
        </p>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($videos as $video)
            <article
                class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <button type="button"
                    x-on:click="open({
                        title: {{ Js::from($video->getTranslation('title', app()->getLocale())) }},
                        description: {{ Js::from($video->getTranslation('description', app()->getLocale())) }},
                        category: {{ Js::from($video->getTranslation('category', app()->getLocale())) }},
                        embedUrl: {{ Js::from($video->embed_url) }}
                    })"
                    class="relative aspect-[4/3] w-full overflow-hidden"
                    aria-label="{{ __('videos.play_label', ['title' => $video->getTranslation('title', app()->getLocale())]) }}">
                    <img src="{{ $video->thumbnail_url }}"
                        alt="{{ $video->getTranslation('title', app()->getLocale()) }}" loading="lazy"
                        class="absolute inset-0 size-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <span
                        class="absolute inset-0 bg-gradient-to-t from-brand-dark/70 via-brand-dark/10 to-transparent"></span>

                    <span
                        class="absolute left-3 top-3 rounded-full bg-card/90 px-3 py-1 text-xs font-semibold text-brand backdrop-blur">
                        {{ $video->getTranslation('category', app()->getLocale()) }}
                    </span>
                    <span
                        class="absolute bottom-3 right-3 flex items-center gap-1 rounded-full bg-brand-dark/80 px-2.5 py-1 text-xs font-medium text-brand-foreground backdrop-blur">
                        {{-- Clock icon --}}
                        <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        {{ $video->duration }}
                    </span>

                    <span class="absolute inset-0 flex items-center justify-center">
                        <span
                            class="flex size-16 items-center justify-center rounded-full bg-gold/95 text-gold-foreground shadow-lg transition-transform duration-300 group-hover:scale-110">
                            {{-- Play icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-play size-6 translate-x-0.5 fill-current"
                                aria-hidden="true">
                                <path
                                    d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z">
                                </path>
                            </svg>
                        </span>
                    </span>
                </button>

                <div class="flex flex-1 flex-col p-5">
                    <h3 class="text-pretty font-display text-lg font-bold leading-snug text-foreground">
                        {{ $video->getTranslation('title', app()->getLocale()) }}
                    </h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-muted-foreground">
                        {{ Str::limit($video->getTranslation('description', app()->getLocale()), 120) }}
                    </p>
                    <button type="button"
                        x-on:click="open({
                            title: {{ Js::from($video->getTranslation('title', app()->getLocale())) }},
                            description: {{ Js::from($video->getTranslation('description', app()->getLocale())) }},
                            category: {{ Js::from($video->getTranslation('category', app()->getLocale())) }},
                            embedUrl: {{ Js::from($video->embed_url) }}
                        })"
                        class="mt-5 inline-flex items-center justify-center gap-2 rounded-full bg-gold px-4 py-2.5 text-sm font-semibold text-gold-foreground transition-colors hover:bg-gold/90">
                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        {{ __('videos.watch_button') }}
                    </button>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Lightbox --}}
    <div x-show="active" x-cloak x-on:click="close()"
        class="fixed inset-0 z-[60] flex items-center justify-center bg-brand-dark/80 p-4 backdrop-blur-sm"
        role="dialog" aria-modal="true" style="display: none;">
        <div x-show="active" x-on:click.stop x-transition
            class="relative w-full max-w-4xl overflow-hidden rounded-2xl bg-card shadow-2xl">
            <button type="button" x-on:click="close()" aria-label="{{ __('videos.close_label') }}"
                class="absolute right-3 top-3 z-10 flex size-9 items-center justify-center rounded-full bg-brand-dark/70 text-brand-foreground transition-colors hover:bg-brand-dark">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>

            <div class="aspect-video w-full bg-brand-dark">
                <template x-if="active">
                    <iframe :src="active.embedUrl" :title="active.title"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="size-full"></iframe>
                </template>
            </div>

            <div class="p-5" x-show="active">
                <span class="text-xs font-semibold uppercase tracking-wide text-brand" x-text="active?.category"></span>
                <h3 class="mt-1 font-display text-xl font-bold text-foreground" x-text="active?.title"></h3>
                <p class="mt-2 text-sm leading-relaxed text-muted-foreground" x-text="active?.description"></p>
            </div>
        </div>
    </div>
</section>
