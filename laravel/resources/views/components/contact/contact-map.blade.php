{{-- resources/views/components/contact-map.blade.php --}}
@php
    $mapQuery = 'Roastline Kuruyemiş, Eskihisar Mah. 8016 Sk. No:8 Merkezefendi Denizli';
@endphp

<section id="harita" class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 md:pb-24 lg:px-8">
    <div class="relative overflow-hidden rounded-3xl border border-border shadow-sm">
        <iframe title="{{ __('contact.map_title') }}"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3500.00354071069762!2d29.096623716164437!3d37.81214201731821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14c715432d02bd5b%3A0xc85acb3690684e5d!2zUk9BU1RMxLBORSBLVVJVWUVNxLDFniBNQUvEsE5BTEFSSSBTQU4uIFZFIFTEsEMuIExURC7FnlTEsA!5e0!3m2!1str!2str!4v1786279001601!5m2!1str!2str"
            class="h-[380px] w-full grayscale-[0.15] md:h-[460px]" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        {{-- Floating location card --}}
        <div
            class="pointer-events-none absolute inset-x-0 bottom-0 p-4 sm:inset-auto sm:bottom-6 sm:left-6 sm:max-w-sm sm:p-0">
            <div class="pointer-events-auto rounded-2xl border border-border bg-card/95 p-5 shadow-lg backdrop-blur">
                <div class="flex items-start gap-3">
                    <span
                        class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary text-primary-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                            <path
                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h3 class="font-serif text-base font-semibold text-foreground">
                            Roastline Kuruyemiş
                        </h3>
                        <div class="mt-1 flex items-center gap-1.5 text-sm">
                            <span class="flex items-center gap-0.5 font-semibold text-foreground">
                                5,0
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="size-3.5 text-accent">
                                    <path
                                        d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                </svg>
                            </span>
                            <span
                                class="text-muted-foreground">({{ __('contact.review_count', ['count' => 12]) }})</span>
                        </div>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">
                            {{ __('contact.address_line_1') }}, {{ __('contact.address_line_2') }}
                        </p>
                    </div>
                </div>

                <a href="https://www.google.com/maps?cid=14437074990700973661" target="_blank" rel="noopener noreferrer"
                    class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary px-4 py-2.5 text-sm font-semibold text-primary-foreground transition-opacity hover:opacity-90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                        <polygon points="3 11 22 2 13 21 11 13 3 11" />
                    </svg>
                    {{ __('contact.directions') }}
                </a>

            </div>
        </div>
    </div>
</section>
