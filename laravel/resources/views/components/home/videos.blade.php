@php
    // YouTube linkinden video ID çıkarır (youtu.be, youtube.com/watch, embed vs. hepsini destekler)
    function getYoutubeId($url)
    {
        preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
            $url,
            $matches
        );
        return $matches[1] ?? null;
    }

    $videos = [
        [
            'title' => 'Özel Kahvenin Çekirdekten Fincana Yolculuğu',
            'youtube' => 'https://www.youtube.com/watch?v=0MOXPeTKK-w',
        ],
        [
            'title' => 'Kahve Kavurma Makineleri: Ham Çekirdekten Eşsiz Deneyime',
            'youtube' => 'https://youtu.be/HMtubrpzQmo',
        ],
        [
            'title' => 'Kuruyemiş Kavurma Makineleri ve Endüstrisi',
            'youtube' => 'https://www.youtube.com/watch?v=qR_TSDg0bLA',
        ],
    ];

    // Her videoya otomatik thumbnail + embed url ekle
    foreach ($videos as &$video) {
        $ytId = getYoutubeId($video['youtube']);
        $video['image'] = $ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : asset('images/placeholder.svg');
        $video['embed'] = $ytId ? "https://www.youtube.com/embed/{$ytId}?autoplay=1&rel=0" : null;
    }
    unset($video);
@endphp

<section id="videolar" class="bg-primary py-20 text-primary-foreground md:py-28"
    x-data="{ open: false, activeEmbed: null, activeTitle: '' }"
    @keydown.escape.window="open = false; activeEmbed = null">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                Videolar
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight md:text-4xl">
                Makinelerimiz iş başında
            </h2>
            <p class="mt-4 text-pretty leading-relaxed text-primary-foreground/75">
                Firmamızın ürettiği kavurma hatlarının çalışma videolarını izleyin.
            </p>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-3">
            @foreach ($videos as $video)
                <button type="button" class="group relative overflow-hidden rounded-2xl text-left"
                    @click="open = true; activeEmbed = '{{ $video['embed'] }}'; activeTitle = @js($video['title'])">
                    <img src="{{ $video['image'] }}" alt="{{ $video['title'] }}"
                        class="aspect-video w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/30 to-transparent"></div>
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

    {{-- Video Modal --}}
    <div x-show="open" x-cloak x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
        @click.self="open = false; activeEmbed = null">
        <div class="relative w-full max-w-4xl" x-show="open" x-transition.scale>
            <button type="button" @click="open = false; activeEmbed = null"
                class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18M6 6l12 12" />
                </svg>
            </button>

            <div class="aspect-video w-full overflow-hidden rounded-xl bg-black">
                <template x-if="open && activeEmbed">
                    <iframe :src="activeEmbed" class="h-full w-full" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </template>
            </div>

            <p class="mt-3 text-center text-sm text-white/80" x-text="activeTitle"></p>
        </div>
    </div>
</section>
