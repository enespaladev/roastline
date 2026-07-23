@php
    $posts = [
        [
            'image' => asset('frontend/images/blog-1.png'),
            'category' => 'Kahve',
            'title' => 'Özel Kahvenin Çekirdekten Fincana Yolculuğu',
            'excerpt' => 'Kaliteli bir kahvenin arkasındaki kavurma sürecini ve inceliklerini keşfedin.',
        ],
        [
            'image' => asset('frontend/images/blog-2.jpeg'),
            'category' => 'Teknoloji',
            'title' => 'Kahve Kavurma Makineleri: Ham Çekirdekten Eşsiz Deneyime',
            'excerpt' => 'Doğru kavurma teknolojisinin lezzet ve verim üzerindeki etkisini inceliyoruz.',
        ],
        [
            'image' => asset('frontend/images/blog-3.jpeg'),
            'category' => 'Sektör',
            'title' => 'Kuruyemiş Kavurma Makineleri ve Endüstrisi',
            'excerpt' => 'Kuruyemiş kavurmada başarı, hattın kalitesi ve teknolojisiyle doğrudan ilişkilidir.',
        ],
    ];
@endphp

<section id="blog" class="bg-background py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                Blog
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                Bizden haberler ve duyurular
            </h2>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-3">
            @foreach ($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all hover:shadow-xl">
                    <div class="aspect-video overflow-hidden">
                        <img
                            src="{{ $post['image'] ? asset($post['image']) : asset('images/placeholder.svg') }}"
                            alt="{{ $post['title'] }}"
                            class="size-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-accent">
                            {{ $post['category'] }}
                        </span>
                        <h3 class="mt-2 font-serif text-lg font-bold leading-snug text-foreground">
                            {{ $post['title'] }}
                        </h3>
                        <p class="mt-2.5 flex-1 text-sm leading-relaxed text-muted-foreground">
                            {{ $post['excerpt'] }}
                        </p>
                        <a
                            href="#blog"
                            class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-accent"
                        >
                            Devamını oku
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
