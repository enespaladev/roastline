@php
    $slides = [
        [
            'image' => asset('frontend/images/slider-1.jpg'),
            'alt' => 'Roastline endüstriyel kuruyemiş ve kahve kavurma makinesi',
            'tag' => 'Kavurma teknolojisinde uzman',
            'title' => 'Kuruyemiş ve kahvenin mükemmel kavrulması',
            'text' =>
                'Üstün performans ve dayanıklılık için tasarlanmış yüksek kaliteli kavurma makineleri üretiyoruz. Yenilikçi hatlarımızla üretiminizden maksimum verim alın.',
        ],
        [
            'image' => asset('frontend/images/slider-2.jpg'),
            'alt' => 'Kavurma tamburundan dökülen taze kavrulmuş kahve çekirdekleri',
            'tag' => 'Homojen ve kontrollü kavurma',
            'title' => 'Her partide tutarlı, kusursuz sonuçlar',
            'text' =>
                'Hassas sıcaklık kontrolü ve dengeli tambur tasarımıyla ürününüz baştan sona eşit kavrulur. Lezzet ve aromayı en üst seviyede koruyun.',
        ],
        [
            'image' => asset('frontend/images/slider-3.jpg'),
            'alt' => 'Modern fabrikada sıra halinde kavurma makineleri',
            'tag' => 'Endüstriyel ölçekte üretim',
            'title' => 'İşletmenize özel kavurma hatları',
            'text' =>
                'Küçük atölyeden büyük tesise kadar her kapasiteye uygun çözümler. Anahtar teslim kavurma hatlarıyla üretiminizi bir sonraki seviyeye taşıyın.',
        ],
        [
            'image' => asset('frontend/images/slider-4.jpg'),
            'alt' => 'Modern fabrikada sıra halinde kavurma makineleri',
            'tag' => 'Endüstriyel ölçekte üretim',
            'title' => 'İşletmenize özel kavurma hatları',
            'text' =>
                'Küçük atölyeden büyük tesise kadar her kapasiteye uygun çözümler. Anahtar teslim kavurma hatlarıyla üretiminizi bir sonraki seviyeye taşıyın.',
        ],
    ];

    $badges = ['Dünya geneline ihracat', 'ISO & CE sertifikalı', 'Yüksek enerji verimliliği'];
@endphp

<section id="anasayfa" x-data="{
    current: 0,
    total: {{ count($slides) }},
    duration: 6000,
    timer: null,
    slides: @js($slides),
    start() {
        this.timer = setInterval(() => this.next(), this.duration);
    },
    stop() {
        clearInterval(this.timer);
    },
    goTo(i) {
        this.current = (i + this.total) % this.total;
        this.stop();
        this.start();
    },
    next() { this.current = (this.current + 1) % this.total; },
    prev() { this.goTo(this.current - 1); },
}" x-init="start()"
    class="relative flex min-h-screen items-center overflow-hidden">
    {{-- Slides --}}
    <template x-for="(slide, i) in slides" :key="i">
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
            :style="{ opacity: i === current ? 1 : 0 }" :aria-hidden="i !== current">
            <img :src="slide.image" :alt="slide.alt" class="size-full scale-100 object-cover" />
            <div class="absolute inset-0  from-primary/95 via-primary/80 to-primary/40"></div>
            {{-- <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/80 to-primary/40"></div> --}}
        </div>
    </template>

    {{-- Content --}}
    <div class="relative mx-auto w-full max-w-7xl px-4 pt-28 pb-16 md:px-6">
        <div class="max-w-2xl">
            {{-- <span class="inline-flex items-center gap-2 rounded-full border border-primary-foreground/25 bg-primary-foreground/10 px-4 py-1.5 text-sm font-medium text-primary-foreground backdrop-blur-sm">
                <span class="size-2 rounded-full bg-accent"></span>
                <span x-text="slides[current].tag"></span>
            </span> --}}

            {{-- <h1
                :key="'title-' + current"
                x-text="slides[current].title"
                class="animate-slide-up mt-6 text-balance font-serif text-4xl font-bold leading-[1.1] text-primary-foreground sm:text-5xl md:text-6xl lg:text-7xl"
            ></h1> --}}

            {{-- <p
                :key="'text-' + current"
                x-text="slides[current].text"
                class="animate-slide-up mt-6 max-w-xl text-pretty text-lg leading-relaxed text-primary-foreground/80"
            ></p> --}}

            {{-- <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="#iletisim"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-7 py-3.5 font-semibold text-accent-foreground transition-transform hover:scale-[1.03]">
                    Hemen Fiyat Teklifi Alın
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
                <a href="#makineler"
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-primary-foreground/30 bg-primary-foreground/5 px-7 py-3.5 font-semibold text-primary-foreground backdrop-blur-sm transition-colors hover:bg-primary-foreground/15">
                    Makineleri İnceleyin
                </a>
            </div> --}}

            {{-- <div class="mt-12 flex flex-wrap gap-x-8 gap-y-4">
                @foreach ($badges as $badge)
                    <div class="flex items-center gap-2.5 text-primary-foreground/90">
                        <svg class="size-5 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5" />
                        </svg>
                        <span class="text-sm font-medium">{{ $badge }}</span>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>

    {{-- Arrows --}}
    <button type="button" @click="prev()" aria-label="Önceki görsel"
        class="absolute left-3 top-1/2 z-10  -translate-y-1/2 rounded-full border border-primary-foreground bg-primary-foreground/10 p-3 text-primary backdrop-blur-sm transition-colors hover:bg-primary md:block">
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6" />
        </svg>
    </button>
    <button type="button" @click="next()" aria-label="Sonraki görsel"
        class="absolute right-3 top-1/2 z-10  -translate-y-1/2 rounded-full border border-primary-foreground/30 bg-primary-foreground/10 p-3 text-primary-foreground backdrop-blur-sm transition-colors hover:bg-primary-foreground/20 md:block">
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-8 left-1/2 z-10 flex -translate-x-1/2 gap-3">
        <template x-for="(slide, i) in slides" :key="i">
            <button type="button" @click="goTo(i)" :aria-label="(i + 1) + '. görsele geç'"
                :aria-current="i === current" class="h-2.5 rounded-full transition-all duration-300"
                :style="{
                    width: i === current ? '32px' : '10px',
                    backgroundColor: i === current ? 'var(--accent)' :
                        'color-mix(in oklab, var(--primary-foreground) 45%, transparent)'
                }">
            </button>
        </template>
    </div>
</section>
