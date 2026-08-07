{{-- resources/views/components/contact-info.blade.php --}}
@php
    $hours = [
        ['day' => __('contact.hours_weekday'), 'time' => '08:00 – 18:00', 'open' => true],
        ['day' => __('contact.hours_saturday'), 'time' => '08:00 – 13:00', 'open' => true],
        ['day' => __('contact.hours_sunday'), 'time' => __('contact.closed'), 'open' => false],
    ];

    $quick = [
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
    ];
@endphp

<div class="flex flex-col gap-6">
    {{-- Address --}}
    <div class="rounded-3xl border border-border bg-card p-6 shadow-sm">
        <div class="flex items-start gap-4">
            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                    <path
                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
            </span>
            <div>
                <h3 class="font-serif text-lg font-semibold text-foreground">{{ __('contact.address_title') }}</h3>
                <p class="mt-1 text-sm leading-relaxed text-muted-foreground">
                    {{ __('contact.address_line_1') }}
                    <br>
                    {{ __('contact.address_line_2') }}
                </p>

                <a href="#harita"
                class="mt-3 inline-flex text-sm font-semibold text-primary underline-offset-4 hover:underline"
                >
                {{ __('contact.view_on_map') }} →
                </a>
            </div>
        </div>
    </div>

    {{-- Quick contacts --}}
    <div class="rounded-3xl border border-border bg-card p-6 shadow-sm">
        <h3 class="font-serif text-lg font-semibold text-foreground">{{ __('contact.direct_contact_title') }}</h3>
        <ul class="mt-4 divide-y divide-border">
            @foreach ($quick as $item)
                <li class="mt-5">

                    <a href="{{ $item['href'] }}"
                    class="group flex items-center gap-3 py-3 first:pt-0 last:pb-0"
                    >
                    <span
                        class="flex size-9 items-center justify-center rounded-lg bg-secondary text-primary transition-colors group-hover:bg-primary group-hover:text-primary-foreground">
                        @switch($item['icon'])
                            @case('phone')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                    <path
                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                </svg>
                            @break

                            @case('whatsapp')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                    <path d="M2.992 16.342A2 2 0 0 1 2.7 15.06l1.847-6.973A2 2 0 0 1 6.62 7.08L10 8.5" />
                                    <path d="M7.5 8.5a11 11 0 0 0 8 8" />
                                    <path d="M20.5 12a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                                </svg>
                            @break

                            @case('mail')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            @break
                        @endswitch
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs uppercase tracking-wider text-muted-foreground">
                            {{ $item['label'] }}
                        </span>
                        <span class="block truncate text-sm font-semibold text-foreground">
                            {{ $item['value'] }}
                        </span>
                    </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Working hours --}}
    <div class="rounded-3xl border border-border bg-primary p-6 text-primary-foreground shadow-sm">
        <div class="flex items-center gap-3">
            <span class="flex size-11 items-center justify-center rounded-xl bg-primary-foreground/10 text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
            </span>
            <h3 class="font-serif text-lg font-semibold">{{ __('contact.hours_title') }}</h3>
        </div>
        <ul class="mt-5 space-y-3">
            @foreach ($hours as $h)
                <li class="flex items-center justify-between gap-4 text-sm">
                    <span class="text-primary-foreground/80">{{ $h['day'] }}</span>
                    <span
                        class="rounded-full px-3 py-1 text-xs font-semibold {{ $h['open'] ? 'bg-accent text-accent-foreground' : 'bg-primary-foreground/10 text-primary-foreground/60' }}">
                        {{ $h['time'] }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
