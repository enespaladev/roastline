@props([
    'badge' => null,
    'title',
    'description' => null,
    'breadcrumbs' => [], // [['label' => 'Home', 'url' => lroute('home')], ...]
])

<section class="relative overflow-hidden bg-brand text-brand-foreground mt-20">
    {{-- subtle decorative grid --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-10"
        style="background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0); background-size: 28px 28px;">
    </div>

    <div class="relative mx-auto flex max-w-7xl flex-col gap-6 px-6 py-16 md:flex-row md:items-end md:justify-between md:py-20">
        <div>
            @if($badge)
                <span class="inline-flex items-center gap-2 rounded-full bg-brand-foreground/10 px-4 py-1.5 text-sm font-medium text-brand-foreground/90">
                    {{-- play-circle icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m10 8 6 4-6 4Z"/>
                    </svg>
                    {{ $badge }}
                </span>
            @endif

            <h1 class="mt-4 font-display text-4xl font-extrabold tracking-tight md:text-5xl">
                {{ $title }}
            </h1>

            @if($description)
                <p class="mt-3 max-w-xl text-pretty leading-relaxed text-brand-foreground/80">
                    {{ $description }}
                </p>
            @endif
        </div>

        @if(count($breadcrumbs))
            <nav aria-label="Breadcrumb" class="text-sm">
                <ol class="flex items-center gap-2 text-brand-foreground/70">
                    @foreach($breadcrumbs as $index => $crumb)
                        @if($index > 0)
                            {{-- chevron-right icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        @endif

                        <li @if($loop->last) aria-current="page" class="font-semibold text-gold" @endif>
                            @if(!$loop->last && !empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}" class="transition-colors hover:text-brand-foreground">
                                    {{ $crumb['label'] }}
                                </a>
                            @else
                                {{ $crumb['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>
</section>
