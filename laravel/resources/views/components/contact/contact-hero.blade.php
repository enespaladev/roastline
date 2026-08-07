{{-- resources/views/components/contact-hero.blade.php --}}
@php
    $chips = [
        [
            'icon' => 'phone',
            'label' => __('contact.phone_label'),
            'value' => '+90 552 555 35 50',
            'href' => 'tel:+905525553550',
        ],
        [
            'icon' => 'whatsapp',
            'label' => 'WhatsApp',
            'value' => '+90 552 555 35 50',
            'href' => 'https://wa.me/905525553550',
        ],
        [
            'icon' => 'mail',
            'label' => __('contact.email_label'),
            'value' => 'info@roastline.com.tr',
            'href' => 'mailto:info@roastline.com.tr',
        ],
        [
            'icon' => 'map-pin',
            'label' => __('contact.address_label'),
            'value' => 'Merkezefendi, Denizli',
            'href' => '#harita',
        ],
    ];
@endphp

<section class="relative overflow-hidden bg-primary text-primary-foreground mt-20">
    {{-- soft texture accents --}}
    <div aria-hidden="true"
        class="pointer-events-none absolute -right-24 -top-24 size-72 rounded-full bg-accent/20 blur-3xl"></div>
    <div aria-hidden="true"
        class="pointer-events-none absolute -bottom-32 left-1/3 size-80 rounded-full bg-primary-foreground/5 blur-3xl">
    </div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 md:py-24 lg:px-8">
        <div class="max-w-2xl">
            <span
                class="inline-flex items-center gap-2 rounded-full border border-primary-foreground/20 bg-primary-foreground/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.22em] text-accent">
                {{ __('contact.badge') }}
            </span>
            <h1
                class="mt-6 text-pretty font-serif text-4xl font-semibold leading-[1.05] tracking-tight sm:text-5xl md:text-6xl">
                {{ __('contact.title_line_1') }}
                <br>
                {{ __('contact.title_line_2') }}
            </h1>
            <p class="mt-5 max-w-xl text-pretty text-base leading-relaxed text-primary-foreground/75 sm:text-lg">
                {{ __('contact.description') }}
            </p>
        </div>

        <div class="mt-12 grid gap-3 lg:grid-cols-4">
            @foreach ($chips as $chip)
                <a href="{{ $chip['href'] }}"
                    class="group flex items-center gap-3 rounded-2xl border border-primary-foreground/15 bg-primary-foreground/5 p-4 transition-colors hover:border-accent/60 hover:bg-primary-foreground/10">
                    <span
                        class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-accent text-accent-foreground transition-transform group-hover:scale-105">
                        @switch($chip['icon'])
                            @case('phone')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path
                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                </svg>
                            @break

                            @case('whatsapp')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M2.992 16.342A2 2 0 0 1 2.7 15.06l1.847-6.973A2 2 0 0 1 6.62 7.08L10 8.5" />
                                    <path d="M7.5 8.5a11 11 0 0 0 8 8" />
                                    <path d="M20.5 12a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                                </svg>
                            @break

                            @case('mail')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            @break

                            @case('map-pin')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            @break
                        @endswitch
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs uppercase tracking-wider text-primary-foreground/60">
                            {{ $chip['label'] }}
                        </span>
                        <span class="block truncate text-sm font-semibold">
                            {{ $chip['value'] }}
                        </span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
