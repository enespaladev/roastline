{{-- resources/views/partials/about.blade.php --}}
@php
    // TODO: İleride admin panelden -> $page->getTranslation('field', app()->getLocale())
    // Şimdilik statik dummy veri, aynı key yapısıyla:
    $about = [
        'label'       => 'Hakkımızda',
        'heading'     => 'Kaliteli üretim, güçlü teknoloji ve kesintisiz destek',
        'paragraph_1' => 'Roastline olarak üstün performans ve dayanıklılık için tasarlanmış yüksek kaliteli kuruyemiş ve kahve kavurma makineleri konusunda uzmanlaşıyoruz. Yenilikçi makinelerimiz kusursuz sonuçlar sunarken, uzman ekibimiz mükemmel müşteri hizmeti ve teknik destek sağlar.',
        'paragraph_2' => 'İhtiyaçlarınıza en uygun ürünü birlikte seçerek üretim süreçlerinizde maksimum verimliliği elde etmenizi hedefliyoruz.',
        'image'       => asset('frontend/images/machine-hazelnut.png'),
        'badge_value' => '%100',
        'badge_label' => 'Yerli üretim',
    ];

    // TODO: İleride -> $aboutStats = AboutStat::orderBy('order')->get();
    $stats = [
        // ['value' => '20+',   'label' => 'Yıllık tecrübe'],
        ['value' => '40+',   'label' => 'İhracat ülkesi'],
        ['value' => '15-1000', 'label' => 'kg kapasite aralığı'],
        ['value' => '7/24',  'label' => 'Teknik destek'],
    ];
@endphp

<section id="hakkimizda" class="bg-background py-20 md:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 md:px-6 lg:grid-cols-2 lg:gap-16">
        <div class="relative">
            <img
                src="{{ asset($about['image']) }}"
                alt="Roastline paslanmaz çelik fındık kavurma makinesi"
                class="aspect-4/3 w-full rounded-2xl object-cover shadow-xl"
            >
            <div class="absolute -bottom-6 -right-4 hidden rounded-xl bg-primary px-6 py-5 text-primary-foreground shadow-lg sm:block">
                <p class="font-serif text-3xl font-bold">{{ $about['badge_value'] }}</p>
                <p class="text-sm text-primary-foreground/80">{{ $about['badge_label'] }}</p>
            </div>
        </div>

        <div>
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                {{ $about['label'] }}
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                {{ $about['heading'] }}
            </h2>
            <p class="mt-5 text-pretty leading-relaxed text-muted-foreground">
                {{ $about['paragraph_1'] }}
            </p>
            <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
                {{ $about['paragraph_2'] }}
            </p>

            <dl class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4">
                @foreach ($stats as $s)
                    <div class="border-l-2 border-accent pl-4">
                        <dt class="font-serif text-2xl font-bold text-primary">{{ $s['value'] }}</dt>
                        <dd class="mt-1 text-sm text-muted-foreground">{{ $s['label'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>
