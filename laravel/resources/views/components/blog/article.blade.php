{{--
    resources/views/components/blog/article.blade.php

    Kullanım (posts/show.blade.php içinde):
    <x-blog.article :post="$post" />

    ÖNEMLİ VARSAYIM:
    Orijinal TSX dosyasında "Harvesting / Processing / Machines / Why Roastline" gibi
    bölümler component prop'u olarak değil, sabit (hardcoded) içerik olarak yazılmıştı.
    Bunu admin panelinden yönetilebilir hale getirmek için en pratik yol, bu gövde
    içeriğini Post modelinde tek bir zengin metin (WYSIWYG) alanı olarak tutmaktır:

        $table->json('body'); // Spatie HasTranslations ile ('tr','en','ar')

    Admin panelindeki editörden (TipTap/CKEditor/Quill vb.) gelen HTML,
    aşağıdaki gibi "prose" sınıflarıyla stilize edilerek basılır: {!! $post->body !!}

    Bu sayede h2/h3/p/ul/ol/blockquote gibi etiketler otomatik olarak
    tasarımdaki tipografiye uyar (bkz. dosya sonundaki @push('styles') bloğu).

    Eğer "Stage 01 / Stage 02..." gibi ikonlu blokları admin panelinden yapılandırılabilir
    ayrı kartlar olarak tutmak istersen (ör. Post model üzerinde json "highlights" alanı),
    bana haber ver, o alana özel bir Blade partial'ı da ayrıca çıkarabilirim.

    Beklenen $post alanları:
    - $post->category->name / $post->category->slug (BelongsTo Category)
    - $post->published_at (Carbon)
    - $post->reading_time (int, dakika) -> yoksa aşağıda otomatik hesaplanıyor
    - $post->title (translatable)
    - $post->excerpt (translatable, üstteki alıntı paragrafı)
    - $post->image (path/url), $post->image_alt, $post->image_caption
    - $post->body (translatable HTML)
--}}
@props([
    'post',
])

@php
    // reading_time modelde yoksa gövde metninden kabaca hesapla (dk)
    $readingTime = $post->reading_time
        ?? max(1, (int) ceil(str_word_count(strip_tags($post->body)) / 200));

    $shareUrl = url()->current();
@endphp

<article class="min-w-0">
    {{-- Article header --}}
    <div class="mb-8 flex flex-wrap items-center gap-3 text-sm">
        @if ($post->category)
            <a
                href="{{ lroute('posts.byCategory', $post->category->slug) }}"
                class="rounded-full bg-brand px-3 py-1 font-medium text-brand-foreground"
            >
                {{ $post->category->name }}
            </a>
        @endif

        <span class="flex items-center gap-1.5 text-muted-foreground">
            <x-icon name="calendar-days" class="h-4 w-4" />
            {{ $post->published_at?->translatedFormat('d F Y') }}
        </span>

        <span class="flex items-center gap-1.5 text-muted-foreground">
            <x-icon name="clock class="h-4 w-4" />
            {{ trans_choice('blog.min_read', $readingTime, ['count' => $readingTime]) }}
        </span>
    </div>

    <h1 class="font-serif text-4xl font-bold leading-[1.08] tracking-tight text-foreground text-balance md:text-5xl">
        {{ $post->title }}
    </h1>

    @if ($post->excerpt)
        <p class="mt-6 border-l-2 border-gold pl-5 text-lg leading-relaxed text-muted-foreground text-pretty">
            {{ $post->excerpt }}
        </p>
    @endif

    {{-- Hero image --}}
    @if ($post->image)
        <figure class="mt-8 overflow-hidden rounded-2xl border border-border bg-card shadow-sm">
            <img
                src="{{ asset('storage/' . $post->image) }}"
                alt="{{ $post->image_alt ?? $post->title }}"
                width="1200"
                height="800"
                class="h-auto w-full object-cover"
                loading="eager"
            />
            @if ($post->image_caption)
                <figcaption class="border-t border-border bg-secondary px-5 py-3 text-center text-sm text-muted-foreground">
                    {{ $post->image_caption }}
                </figcaption>
            @endif
        </figure>
    @endif

    {{-- Body (admin panelden gelen zengin metin) --}}
    <div class="prose-blog mt-10 space-y-5 text-base leading-relaxed text-muted-foreground">
        {!! $post->body !!}
    </div>

    {{-- Share --}}
    <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-border pt-6">
        <span class="flex items-center gap-2 text-sm font-medium text-foreground">
            <x-icon name="share class="h-4 w-4 text-brand" /> {{ __('blog.share_this_article') }}
        </span>
        <div class="flex items-center gap-2">
            <a
                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex h-9 w-9 items-center justify-center rounded-full border border-border text-muted-foreground transition-colors hover:border-brand hover:bg-brand hover:text-brand-foreground"
                aria-label="Facebook"
            >
                <x-icon name="facebook" class="h-4 w-4" />
            </a>
            <a
                href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($post->title) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex h-9 w-9 items-center justify-center rounded-full border border-border text-muted-foreground transition-colors hover:border-brand hover:bg-brand hover:text-brand-foreground"
                aria-label="Twitter/X"
            >
                <x-icon name="twitter" class="h-4 w-4" />
            </a>
            <a
                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex h-9 w-9 items-center justify-center rounded-full border border-border text-muted-foreground transition-colors hover:border-brand hover:bg-brand hover:text-brand-foreground"
                aria-label="LinkedIn"
            >
                <x-icon name="linkedin" class="h-4 w-4" />
            </a>
        </div>
    </div>
</article>

@once
    @push('styles')
        <style>
            /* Admin editöründen gelen HTML gövdesi için tipografi.
               Tasarım tokenlarınla (font-serif, text-brand, bg-accent vb.) hizalı. */
            .prose-blog h2 {
                @apply mt-14 font-serif text-2xl font-semibold leading-tight text-foreground first:mt-0 md:text-3xl;
            }
            .prose-blog h3 {
                @apply mt-8 font-serif text-lg font-semibold text-brand;
            }
            .prose-blog p { @apply leading-relaxed; }
            .prose-blog strong { @apply font-semibold text-foreground; }
            .prose-blog ul, .prose-blog ol { @apply mt-2 space-y-2 pl-5; }
            .prose-blog ul { @apply list-disc; }
            .prose-blog ol { @apply list-decimal; }
            .prose-blog blockquote {
                @apply mt-6 rounded-2xl bg-brand p-8 text-brand-foreground;
            }
            .prose-blog img {
                @apply mt-6 w-full rounded-2xl border border-border;
            }
        </style>
    @endpush
@endonce
