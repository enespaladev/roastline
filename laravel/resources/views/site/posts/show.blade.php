<div class="flex min-h-screen flex-col" style="background-color: lab(98.2976% -.19002 2.27954)">
    <x-layout.app title="Post Detail | Roastline Nuts Machines">
        <main class="flex-1">
            {{-- Breadcrumb --}}
            <div class="border-b border-border mt-22" style="background-color: color-mix(in oklab, lab(94.2739% -.358552 4.57379) 60%, transparent)">
                <div
                    class="mx-auto flex max-w-7xl flex-col gap-1 px-6 py-6 md:flex-row md:items-center md:justify-between">
                    <h1 class="font-serif text-lg font-medium text-foreground md:text-xl">
                        {{ $post->title }}
                    </h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center gap-2 text-sm text-muted-foreground">
                            <li class="text-muted-foreground/70">{{ __('blog.you_are_here') }}</li>
                            <li>
                                <a href="{{ localizedRoute('home') }}" class="transition-colors hover:text-brand">
                                    {{ __('blog.home') }}
                                </a>
                            </li>
                            <x-icon name="chevron-right" class="h-3.5 w-3.5" />
                            <li class="font-medium text-brand">{{ __('blog.blog') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Content grid --}}
            <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-[1fr_340px] lg:py-16">
                <x-blog.article :post="$post" />
                <x-blog.sidebar :popular-posts="$popularPosts" :labels="$labels" />
            </div>
        </main>
    </x-layout.app>
</div>
