@php
    $values = [
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6" aria-hidden="true"><path d="m12 14 4-4"/><path d="M3.34 16a10 10 0 1 1 17.32 0"/></svg>',
            'title' => 'Hassas Kontrol',
            'description' => 'Dereceye kadar ayarlanabilen sıcaklık ve zamanlama ile her kavurmada aynı mükemmel sonucu elde edin.',
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
            'title' => 'Dayanıklı Mühendislik',
            'description' => 'Endüstriyel kalitede paslanmaz çelik gövde ve uzun ömürlü bileşenlerle yıllarca kesintisiz üretim.',
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 22c1.25-.97 2.6-2.81 3.25-5.18"/></svg>',
            'title' => 'Verimli & Sürdürülebilir',
            'description' => 'Optimize edilmiş hava akışı ve enerji tüketimiyle hem çevreye hem bütçenize saygılı üretim.',
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
            'title' => 'Yanınızdayız',
            'description' => 'Kurulumdan yedek parçaya, eğitimden bakıma kadar ömür boyu teknik destek sözü veriyoruz.',
        ],
    ];
@endphp

<section
    id="degerler"
    class="bg-primary py-24 text-primary-foreground md:py-32"
    aria-labelledby="degerler-baslik"
>
    <div class="mx-auto max-w-6xl px-6">
        <div class="max-w-2xl">
            <span class="mb-5 flex items-center gap-3 text-sm font-medium uppercase tracking-[0.2em] text-accent">
                <span class="h-px w-10 bg-accent" aria-hidden="true"></span>
                Değerlerimiz
            </span>
            <h2
                id="degerler-baslik"
                class="text-balance font-serif text-4xl font-semibold leading-tight md:text-5xl"
            >
                Her makinenin arkasındaki ilkelerimiz.
            </h2>
        </div>

        <div class="mt-16 grid gap-px overflow-hidden rounded-lg border border-primary-foreground/10 bg-primary-foreground/10 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($values as $value)
                <div class="flex flex-col gap-4 bg-primary p-8 transition-colors hover:bg-primary-foreground/5">
                    <span class="flex size-12 items-center justify-center rounded-md bg-accent/15 text-accent">
                        {!! $value['icon'] !!}
                    </span>
                    <h3 class="font-serif text-xl font-semibold">{{ $value['title'] }}</h3>
                    <p class="text-pretty text-sm leading-relaxed text-primary-foreground/65">
                        {{ $value['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
