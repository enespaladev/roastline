@php
    $certs = [
        ['name' => 'ISO 9001', 'image' => asset('frontend/images/iso.webp')],
        ['name' => 'CE', 'image' => asset('frontend/images/tse.webp')],
        ['name' => 'TSEK', 'image' => asset('frontend/images/tsek.webp')],
        ['name' => 'TSE', 'image' => asset('frontend/images/ce.webp')],
        ['name' => 'TSE', 'image' => asset('frontend/images/ce.webp')],
        ['name' => 'TSE', 'image' => asset('frontend/images/ce.webp')],
        ['name' => 'TSE', 'image' => asset('frontend/images/ce.webp')],
        ['name' => 'TSE', 'image' => asset('frontend/images/ce.webp')],
    ];
@endphp

<section id="belgeler" class="bg-secondary py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-widest text-accent">
                Belgelerimiz
            </span>
            <h2 class="mt-3 text-balance font-serif text-3xl font-bold leading-tight text-foreground md:text-4xl">
                Uluslararası kalite standartları
            </h2>
            <p class="mt-4 text-pretty leading-relaxed text-muted-foreground">
                Firmamızın tüm sertifika ve belgeleri, ürünlerimizin küresel
                standartlara uygunluğunu güvence altına alır.
            </p>
        </div>

        <div class="relative mt-14">
            {{-- Sol ok --}}
            <button
                type="button"
                id="cert-prev"
                aria-label="Önceki"
                class="absolute left-0 top-1/2 z-10 hidden size-10 -translate-x-4 -translate-y-1/2 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-sm transition-colors hover:border-accent/50 hover:text-accent md:flex"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </button>

            {{-- Sağ ok --}}
            <button
                type="button"
                id="cert-next"
                aria-label="Sonraki"
                class="absolute right-0 top-1/2 z-10 hidden size-10 -translate-y-1/2 translate-x-4 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-sm transition-colors hover:border-accent/50 hover:text-accent md:flex"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </button>

            {{-- Slider track --}}
            <div
                id="cert-track"
                class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-1 pb-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
            >
                @foreach ($certs as $cert)
                    <div class="w-[45%] shrink-0 snap-start sm:w-[30%] lg:w-[23%]">
                        <button
                            type="button"
                            class="cert-card group flex w-full flex-col items-center gap-3 rounded-2xl border border-border bg-card px-4 py-8 text-center transition-colors hover:border-accent/50"
                            data-cert-image="{{ asset($cert['image']) }}"
                            data-cert-name="{{ $cert['name'] }}"
                            onclick="openCertModal(this)"
                        >
                            <span class="relative flex aspect-square w-full items-center justify-center overflow-hidden rounded-xl bg-white/60 p-4">
                                <img
                                    src="{{ asset($cert['image']) }}"
                                    alt="{{ $cert['name'] }} sertifikası"
                                    class="size-full object-contain transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy"
                                />
                                <span class="absolute right-2 top-2 flex size-7 items-center justify-center rounded-full bg-accent/10 text-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                                        <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
                                        <circle cx="12" cy="8" r="6"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="font-serif text-lg font-bold text-foreground">{{ $cert['name'] }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Büyütme modalı: arkası şeffaf + bulanık, ortada büyüyerek açılır --}}
    <div
        id="cert-modal"
        class="pointer-events-none fixed inset-0 z-50 opacity-0 transition-opacity duration-300"
        aria-hidden="true"
    >
        <div
            id="cert-modal-backdrop"
            class="absolute inset-0 bg-white/10 backdrop-blur-md"
            onclick="closeCertModal()"
        ></div>

        <button
            type="button"
            onclick="closeCertModal()"
            aria-label="Kapat"
            class="absolute right-5 top-5 z-10 flex size-10 items-center justify-center rounded-full border border-border bg-card text-foreground shadow-sm transition-colors hover:border-accent/50 hover:text-accent"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                <path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
            </svg>
        </button>

        <div
            class="relative flex h-full flex-col items-center justify-center gap-5 p-6"
            onclick="if (event.target === event.currentTarget) closeCertModal()"
        >
            <img
                id="cert-modal-img"
                src=""
                alt=""
                class="max-h-[70vh] max-w-[90vw] scale-90 rounded-2xl object-contain shadow-2xl transition-transform duration-300 ease-out"
            />
            <p id="cert-modal-name" class="font-serif text-2xl font-bold text-foreground"></p>
        </div>
    </div>
</section>

<script>
    (function () {
        const track = document.getElementById('cert-track');
        const prevBtn = document.getElementById('cert-prev');
        const nextBtn = document.getElementById('cert-next');

        function scrollAmount() {
            const card = track.querySelector('.cert-card')?.closest('div');
            return card ? card.offsetWidth + 16 : 240; // 16 = gap-4
        }

        prevBtn?.addEventListener('click', () => {
            track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
        });

        nextBtn?.addEventListener('click', () => {
            track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
        });
    })();

    function openCertModal(el) {
        const modal = document.getElementById('cert-modal');
        const img = document.getElementById('cert-modal-img');
        const nameEl = document.getElementById('cert-modal-name');

        img.src = el.dataset.certImage;
        img.alt = el.dataset.certName;
        nameEl.textContent = el.dataset.certName;

        modal.classList.remove('pointer-events-none');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Bir sonraki frame'de opacity ve scale geçişini tetikle
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            img.classList.remove('scale-90');
            img.classList.add('scale-100');
        });
    }

    function closeCertModal() {
        const modal = document.getElementById('cert-modal');
        const img = document.getElementById('cert-modal-img');

        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        img.classList.remove('scale-100');
        img.classList.add('scale-90');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';

        setTimeout(() => modal.classList.add('pointer-events-none'), 300);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeCertModal();
    });
</script>
