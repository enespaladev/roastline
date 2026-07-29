@props([
    'title',
    'description' => null,
    'breadcrumbs' => [], // [['label' => 'Ürünlerimiz', 'url' => route('products.index')], ...]
])

<div class="relative overflow-hidden border-b border-border bg-primary text-primary-foreground">
    <div class="pointer-events-none absolute inset-0 opacity-10 [background-image:radial-gradient(circle_at_1px_1px,var(--color-accent)_1px,transparent_0)] [background-size:24px_24px]"></div>
    <div class="pointer-events-none absolute -right-16 -top-24 size-72 rounded-full bg-accent/10 blur-2xl"></div>

    <div class="relative mx-auto flex max-w-7xl flex-col gap-4 px-6 py-10 sm:py-14">
        <nav aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center gap-1.5 text-sm text-primary-foreground/70">
                <li>
                    <a href="{{ route('home', app()->getLocale()) }}" class="flex items-center gap-1 transition-colors hover:text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <path d="M9 22V12h6v10" />
                        </svg>
                        {{ __('common.home') }}
                    </a>
                </li>

                @foreach ($breadcrumbs as $crumb)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5 opacity-50">
                        <path d="M9 18l6-6-6-6" />
                    </svg>

                    @if ($loop->last)
                        <li class="font-medium text-accent">{{ $crumb['label'] }}</li>
                    @else
                        <li>
                            <a href="{{ $crumb['url'] }}" class="transition-colors hover:text-accent">
                                {{ $crumb['label'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

        <h1 class="max-w-3xl text-3xl font-bold tracking-tight text-balance sm:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>

        @if ($description)
            <p class="max-w-2xl text-pretty leading-relaxed text-primary-foreground/80">
                {{ $description }}
            </p>
        @endif
    </div>
</div>
