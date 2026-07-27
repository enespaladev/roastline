@php
$features = [
    [
        'icon' => 'headset',
        'title' => 'Teknik Destek',
        'desc' => 'Satış sonrası destek birimimizle üretimleriniz kesintiye uğramasın diye her konuda teknik ekibimizden yardım alabilirsiniz.',
    ],
    [
        'icon' => 'target',
        'title' => 'Çözüm Odaklı',
        'desc' => 'İhtiyaçlarınıza en uygun ürünü birlikte seçerek üretim süreçlerinizde maksimum verimi alabileceğiniz makineleri sunuyoruz.',
    ],
    [
        'icon' => 'leaf',
        'title' => 'Çevre Dostu',
        'desc' => 'Elektrikle çalışan ürünlerin üretimine odaklanarak, çevre dostu ürünlerle gelecek nesillere yaşanabilir bir dünya bırakmayı hedefliyoruz.',
    ],
    [
        'icon' => 'lightbulb',
        'title' => 'Yeni Teknoloji',
        'desc' => 'Tüm üretim süreçlerimizde teknolojinin tüm imkanlarını kullanmak için gerekli Ar-Ge ve inovasyon çalışmalarını yürütüyoruz.',
    ],
    [
        'icon' => 'graduation-cap',
        'title' => 'Eğitim Kursları',
        'desc' => 'Kavurma makineleri ve yöntemleri hakkında güncel eğitimler sunuyoruz.',
    ],
    [
        'icon' => 'wrench',
        'title' => 'Satış Öncesi ve Sonrası',
        'desc' => 'İhtiyaçlarınıza uygun en verimli makineyi seçmenize yardımcı olur, talepleriniz doğrultusunda kurulumunu gerçekleştiririz.',
    ],
];
@endphp

<section class="bg-secondary py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                Neden Roastline?
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                İşinizi büyüten özellikler
            </h2>
            <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
                Üretiminizin her aşamasında yanınızdayız. Verimlilik, dayanıklılık
                ve sürdürülebilirlik odaklı çözümler.
            </p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($features as $f)
                <div class="group rounded-2xl border border-border bg-card p-7 transition-all hover:-translate-y-1 hover:border-accent/50 hover:shadow-lg">
                    <span class="flex size-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition-colors group-hover:bg-accent group-hover:text-accent-foreground">
                        @include('partials.icons.' . $f['icon'], ['class' => 'size-6'])
                    </span>
                    <h3 class="mt-5 font-serif text-xl font-bold text-foreground">{{ $f['title'] }}</h3>
                    <p class="mt-2.5 text-sm leading-relaxed text-muted-foreground">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
