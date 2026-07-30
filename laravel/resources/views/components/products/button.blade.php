@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'button',
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2';

    $variants = [
        'default'     => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'secondary'   => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'outline'     => 'border border-border bg-transparent text-foreground hover:bg-secondary',
        'ghost'       => 'bg-transparent text-foreground hover:bg-secondary',
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        'link'        => 'bg-transparent text-primary underline-offset-4 hover:underline',
    ];

    $sizes = [
        'default' => 'h-11 px-5 py-2.5',
        'sm'      => 'h-9 px-3.5 text-xs',
        'lg'      => 'h-12 px-7 text-base',
        'icon'    => 'h-11 w-11',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['default']) . ' ' . ($sizes[$size] ?? $sizes['default']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class([$classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class([$classes]) }}>
        {{ $slot }}
    </button>
@endif
