@php
    $videos = [
        [
            'title' => 'Özel Kahvenin Çekirdekten Fincana Yolculuğu',
            'image' => asset('frontend/images/blog-1.png'),
        ],
        [
            'title' => 'Kahve Kavurma Makineleri: Ham Çekirdekten Eşsiz Deneyime',
            'image' => asset('frontend/images/blog-2.jpeg'),
        ],
        [
            'title' => 'Kuruyemiş Kavurma Makineleri ve Endüstrisi',
            'image' => asset('frontend/images/blog-3.jpeg'),
        ],
    ];
@endphp

<section id="videolar" class="bg-primary py-20 text-primary-foreground md:py-28">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div className="mx-auto max-w-2xl text-center">
            <span className="text-sm font-semibold uppercase tracking-widest text-accent">
                Videolar
            </span>
            <h2 className="mt-3 text-balance font-serif text-3xl font-bold leading-tight md:text-4xl">
                Makinelerimiz iş başında
            </h2>
            <p className="mt-4 text-pretty leading-relaxed text-primary-foreground/75">
                Firmamızın ürettiği kavurma hatlarının çalışma videolarını izleyin.
            </p>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-3">
            @foreach ($videos as $video)
                <button type="button" class="group relative overflow-hidden rounded-2xl text-left">
                    <img src="{{ $video['image'] ? asset($video['image']) : asset('images/placeholder.svg') }}"
                        alt="{{ $video['title'] }}"
                        class="aspect-video w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent" />
                    <span
                        class="absolute left-1/2 top-1/2 flex size-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-accent text-accent-foreground shadow-lg transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-play-icon lucide-play">
                            <path
                                d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z" />
                        </svg>
                    </span>
                    <p class="absolute inset-x-0 bottom-0 p-5 text-sm font-medium leading-snug">
                        {{ $video['title'] }}
                    </p>
                </button>
            @endforeach
        </div>
    </div>
</section>
