<div id="iletisim" class="bg-background">
    <div class="mx-auto max-w-6xl px-6 py-24">
        <div class="relative isolate overflow-hidden rounded-2xl bg-accent px-8 py-16 text-accent-foreground md:px-16">
            <img src="{{ asset('frontend/images/roastline-beans.png') }}" alt="" aria-hidden="true"
                class="absolute inset-0 -z-10 size-full object-cover opacity-15">
            <div class="max-w-2xl">
                <h2 class="text-balance font-serif text-4xl font-semibold leading-tight md:text-5xl">
                    Kavurma yolculuğunuza birlikte başlayalım.
                </h2>
                <p class="mt-5 max-w-lg text-pretty text-lg leading-relaxed text-accent-foreground/80">
                    İhtiyacınıza en uygun makineyi birlikte belirleyelim. Uzman
                    ekibimiz size özel bir çözüm için hazır.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ localizedRoute('contact.index') }}"
                        class="rounded-md bg-primary px-6 py-3 text-sm font-medium text-primary-foreground transition-opacity hover:opacity-90">
                        Teklif Alın
                    </a>
                    <a href="{{ localizedRoute('products.index') }}"
                        class="rounded-md border border-accent-foreground/30 px-6 py-3 text-sm font-medium transition-colors hover:bg-accent-foreground/10">
                        Makineleri İnceleyin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
