{{-- resources/views/components/machines.blade.php --}}
@php
    $machines = [
        [
            'image' => asset('images/machine-hazelnut.png'),
            'tag' => 'Kuruyemiş',
            'title' => 'Fındık & Kuruyemiş Kavurma Makinesi',
            'desc' => '50-60 kg kapasiteli, döner tamburlu, homojen kavurma sağlayan endüstriyel çözüm.',
        ],
        [
            'image' => asset('images/machine-coffee.png'),
            'tag' => 'Kahve',
            'title' => 'Kahve Kavurma Makinesi',
            'desc' => 'Cam gözetleme penceresi ve hassas kontrol paneli ile profesyonel kahve kavurma.',
        ],
        [
            'image' => asset('images/hero-roasting-machine.png'),
            'tag' => 'Mağaza Tipi',
            'title' => 'Otomatik Kavurma Fırını',
            'desc' => 'Mağaza ve dükkanlar için kompakt, otomatik kuruyemiş kavurma fırını.',
        ],
        [
            'image' => asset('images/machine-placeholder-4.png'),
            'tag' => 'Endüstriyel',
            'title' => 'Büyük Kapasiteli Kavurma Hattı',
            'desc' => '100+ kg kapasiteli, tam otomatik endüstriyel kavurma hattı.',
        ],
        [
            'image' => asset('images/machine-placeholder-5.png'),
            'tag' => 'Paketleme',
            'title' => 'Otomatik Paketleme Makinesi',
            'desc' => 'Kavurma sonrası ürünleri hızlı ve hassas şekilde paketler.',
        ],
    ];
@endphp

<section id="makineler" class="bg-background py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                    Makinelerimiz
                </span>
                <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                    İhtiyacınıza uygun kavurma hatları
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <a href="#iletisim"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-accent">
                    Tüm ürünler için bize ulaşın
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17 17 7" />
                        <path d="M7 7h10v10" />
                    </svg>
                </a>

                <div class="hidden md:flex items-center gap-2">
                    <button type="button" data-machines-prev
                        class="flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground transition hover:bg-accent hover:text-accent-foreground disabled:opacity-40 disabled:pointer-events-none">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <button type="button" data-machines-next
                        class="flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground transition hover:bg-accent hover:text-accent-foreground disabled:opacity-40 disabled:pointer-events-none">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="relative mt-12 overflow-hidden" data-machines-viewport>
            <div class="flex transition-transform duration-500 ease-out" data-machines-track>
                @foreach ($machines as $m)
                    <article class="shrink-0 px-3" style="width: 33.333%">
                        <div
                            class="group h-full overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all hover:shadow-xl">
                            <div class="relative aspect-4/3 overflow-hidden">
                                <img src="{{ $m['image'] }}" alt="{{ $m['title'] }}"
                                    class="size-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy">
                                <span
                                    class="absolute left-4 top-4 rounded-full bg-accent px-3 py-1 text-xs font-semibold text-accent-foreground">
                                    {{ $m['tag'] }}
                                </span>
                            </div>
                            <div class="p-6">
                                <h3 class="font-serif text-xl font-bold text-foreground">{{ $m['title'] }}</h3>
                                <p class="mt-2.5 text-sm leading-relaxed text-muted-foreground">{{ $m['desc'] }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Mobil için nokta göstergeleri --}}
        <div class="mt-6 flex items-center justify-center gap-2 md:hidden" data-machines-dots></div>
    </div>
</section>

<script>
    (function() {
        const viewport = document.querySelector('[data-machines-viewport]');
        const track = document.querySelector('[data-machines-track]');
        const prevBtn = document.querySelector('[data-machines-prev]');
        const nextBtn = document.querySelector('[data-machines-next]');
        const dotsWrap = document.querySelector('[data-machines-dots]');

        if (!viewport || !track) return;

        const slides = Array.from(track.children);
        const perView = 3; // hep 3 kart, responsive değil
        let index = 0;

        function maxIndex() {
            return Math.max(0, slides.length - perView);
        }

        function update() {
            const slideWidth = viewport.clientWidth / perView;
            track.style.transform = `translateX(-${index * slideWidth}px)`;

            if (prevBtn) prevBtn.disabled = index === 0;
            if (nextBtn) nextBtn.disabled = index >= maxIndex();

            renderDots();
        }

        function renderDots() {
            if (!dotsWrap) return;
            dotsWrap.innerHTML = '';
            const dotCount = maxIndex() + 1;
            for (let i = 0; i < dotCount; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `size-2 rounded-full transition ${i === index ? 'bg-accent w-5' : 'bg-border'}`;
                dot.addEventListener('click', () => {
                    index = i;
                    update();
                });
                dotsWrap.appendChild(dot);
            }
        }

        prevBtn?.addEventListener('click', () => {
            index = Math.max(0, index - 1);
            update();
        });
        nextBtn?.addEventListener('click', () => {
            index = Math.min(maxIndex(), index + 1);
            update();
        });
        window.addEventListener('resize', update);

        update();
    })();
</script>
