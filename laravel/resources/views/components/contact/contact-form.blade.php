{{-- resources/views/components/contact-form.blade.php --}}
<div
    id="teklif"
    x-data="contactForm()"
    class="rounded-3xl border border-border bg-card p-6 shadow-sm sm:p-8"
>
    {{-- Success state --}}
    <div
        x-show="status === 'success'"
        x-cloak
        class="flex h-full min-h-[420px] flex-col items-center justify-center rounded-3xl border border-border bg-card p-10 text-center"
    >
        <span class="flex size-16 items-center justify-center rounded-full bg-primary/10 text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-8">
                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                <path d="m9 11 3 3L22 4" />
            </svg>
        </span>
        <h3 class="mt-6 font-serif text-2xl font-semibold text-foreground">
            {{ __('contact.form_success_title') }}
        </h3>
        <p class="mt-2 max-w-sm text-pretty text-sm leading-relaxed text-muted-foreground">
            {{ __('contact.form_success_message') }}
        </p>
        <button
            @click="reset()"
            type="button"
            class="mt-6 rounded-full border border-border px-5 py-2 text-sm font-medium text-foreground transition-colors hover:border-primary hover:text-primary"
        >
            {{ __('contact.form_send_new') }}
        </button>
    </div>

    {{-- Form state --}}
    <div x-show="status !== 'success'">
        <div class="mb-6">
            <h2 class="font-serif text-2xl font-semibold tracking-tight text-foreground sm:text-3xl">
                {{ __('contact.form_title') }}
            </h2>
            <p class="mt-1.5 text-sm text-muted-foreground">
                {{ __('contact.form_subtitle') }}
            </p>
        </div>

        <form @submit.prevent="submit()" novalidate class="space-y-5">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                {{-- Name --}}
                <div>
                    <label for="name" class="mb-1.5 flex items-center gap-1.5 text-sm font-medium text-foreground">
                        {{ __('contact.form_name_label') }}
                    </label>
                    <input
                        id="name"
                        type="text"
                        x-model="fields.name"
                        @input="clearError('name')"
                        placeholder="{{ __('contact.form_name_placeholder') }}"
                        autocomplete="name"
                        :class="errors.name ? 'border-destructive' : 'border-input'"
                        class="w-full rounded-xl border bg-background px-4 py-3 text-sm text-foreground outline-none transition-colors placeholder:text-muted-foreground/60 focus:border-primary focus:ring-2 focus:ring-primary/20"
                    >
                    <p x-show="errors.name" x-text="errors.name" class="mt-1.5 text-xs text-destructive"></p>
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="mb-1.5 flex items-center gap-1.5 text-sm font-medium text-foreground">
                        {{ __('contact.form_phone_label') }}
                        <span class="text-xs font-normal text-muted-foreground">
                            ({{ __('contact.form_optional') }})
                        </span>
                    </label>
                    <input
                        id="phone"
                        type="tel"
                        x-model="fields.phone"
                        placeholder="+90"
                        autocomplete="tel"
                        class="w-full rounded-xl border border-input bg-background px-4 py-3 text-sm text-foreground outline-none transition-colors placeholder:text-muted-foreground/60 focus:border-primary focus:ring-2 focus:ring-primary/20"
                    >
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="mb-1.5 flex items-center gap-1.5 text-sm font-medium text-foreground">
                    {{ __('contact.form_email_label') }}
                </label>
                <input
                    id="email"
                    type="email"
                    x-model="fields.email"
                    @input="clearError('email')"
                    placeholder="ornek@eposta.com"
                    autocomplete="email"
                    :class="errors.email ? 'border-destructive' : 'border-input'"
                    class="w-full rounded-xl border bg-background px-4 py-3 text-sm text-foreground outline-none transition-colors placeholder:text-muted-foreground/60 focus:border-primary focus:ring-2 focus:ring-primary/20"
                >
                <p x-show="errors.email" x-text="errors.email" class="mt-1.5 text-xs text-destructive"></p>
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="mb-1.5 block text-sm font-medium text-foreground">
                    {{ __('contact.form_message_label') }}
                </label>
                <textarea
                    id="message"
                    rows="5"
                    x-model="fields.message"
                    @input="clearError('message')"
                    placeholder="{{ __('contact.form_message_placeholder') }}"
                    :class="errors.message ? 'border-destructive' : 'border-input'"
                    class="w-full resize-none rounded-xl border bg-background px-4 py-3 text-sm text-foreground outline-none transition-colors placeholder:text-muted-foreground/60 focus:border-primary focus:ring-2 focus:ring-primary/20"
                ></textarea>
                <p x-show="errors.message" x-text="errors.message" class="mt-1.5 text-xs text-destructive"></p>
            </div>

            {{-- Server / network error --}}
            <p x-show="serverError" x-text="serverError" class="text-xs text-destructive"></p>

            <button
                type="submit"
                :disabled="status === 'loading'"
                class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary px-6 py-3.5 text-sm font-semibold text-primary-foreground transition-all hover:opacity-90 disabled:opacity-60 sm:w-auto"
            >
                <template x-if="status === 'loading'">
                    <span class="inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 animate-spin">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                        </svg>
                        {{ __('contact.form_sending') }}
                    </span>
                </template>
                <template x-if="status !== 'loading'">
                    <span class="inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                            <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                            <path d="m21.854 2.147-10.94 10.939" />
                        </svg>
                        {{ __('contact.form_submit') }}
                    </span>
                </template>
            </button>
        </form>
    </div>
</div>

<script>
    function contactForm() {
        return {
            fields: { name: '', email: '', phone: '', message: '' },
            errors: {},
            serverError: '',
            status: 'idle', // idle | loading | success

            clearError(key) {
                if (this.errors[key]) {
                    delete this.errors[key];
                }
            },

            validate() {
                this.errors = {};

                if (!this.fields.name.trim()) {
                    this.errors.name = '{{ __('contact.form_error_name') }}';
                }

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(this.fields.email)) {
                    this.errors.email = '{{ __('contact.form_error_email') }}';
                }

                if (!this.fields.message.trim() || this.fields.message.trim().length < 10) {
                    this.errors.message = '{{ __('contact.form_error_message') }}';
                }

                return Object.keys(this.errors).length === 0;
            },

            async submit() {
                this.serverError = '';

                if (!this.validate()) {
                    return;
                }

                this.status = 'loading';

                try {
                    const response = await fetch('{{ route('contact.store', ['locale' => app()->getLocale()]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                ?? document.querySelector('input[name="_token"]').value,
                        },
                        body: JSON.stringify(this.fields),
                    });

                    if (!response.ok) {
                        const data = await response.json().catch(() => null);

                        if (response.status === 422 && data?.errors) {
                            const serverErrors = {};
                            Object.keys(data.errors).forEach((key) => {
                                serverErrors[key] = data.errors[key][0];
                            });
                            this.errors = serverErrors;
                            this.status = 'idle';
                            return;
                        }

                        throw new Error('Request failed');
                    }

                    this.status = 'success';
                    this.reset(false);
                } catch (e) {
                    this.status = 'idle';
                    this.serverError = '{{ __('contact.form_error_generic') }}';
                }
            },

            reset(clearStatus = true) {
                this.fields = { name: '', email: '', phone: '', message: '' };
                this.errors = {};
                this.serverError = '';
                if (clearStatus) {
                    this.status = 'idle';
                }
            },
        };
    }
</script>
