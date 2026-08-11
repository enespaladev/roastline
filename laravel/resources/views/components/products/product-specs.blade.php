@props(['product'])

@php
    $locale = app()->getLocale();

    $capacity = $product->getTranslation('roasted_products', $locale) ?? [];

    $dimensions = [
        ['icon' => 'move-diagonal', 'label' => __('Length'), 'value' => $product->length],
        ['icon' => 'move-horizontal', 'label' => __('Width'), 'value' => $product->width],
        ['icon' => 'move-vertical', 'label' => __('Height'), 'value' => $product->height],
    ];

    $fuelLabels = [
        'diesel' => __('Diesel'),
        'lpg' => __('LPG'),
        'natural_gas' => __('Natural Gas'),
        'electric' => __('Electric'),
    ];

    $energy = collect($product->energy_specs ?? [])
        ->map(
            fn($values, $fuel) => [
                'label' => $fuelLabels[$fuel] ?? ucfirst($fuel),
                'min' => $values['min'] ?? '-',
                'max' => $values['max'] ?? '-',
                'avg' => $values['avg'] ?? '-',
            ],
        )
        ->values();

    $tabs = [
        ['id' => 'capacity', 'label' => __('Product Capacity'), 'icon' => 'gauge'],
        ['id' => 'dimensions', 'label' => __('Product Dimensions'), 'icon' => 'move-diagonal'],
        ['id' => 'energy', 'label' => __('Energy Consumption'), 'icon' => 'zap'],
    ];
@endphp

<section class="bg-secondary/40 py-16" x-data="{ active: 'capacity' }">
    <div class="mx-auto max-w-5xl px-6">
        <div class="mb-10 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-foreground/70">
                {{ __('Technical Specifications') }}
            </p>
            <h2 class="mt-2 font-display text-3xl font-bold text-primary">
                {{ __('Everything about') }} {{ $product->getTranslation('name', $locale) }}
            </h2>
        </div>

        {{-- Tab bar --}}
        <div role="tablist" aria-label="{{ __('Product specifications') }}"
            class="mx-auto flex max-w-2xl flex-col gap-2 rounded-2xl border border-border bg-card p-2 sm:flex-row">
            @foreach ($tabs as $tab)
                <button type="button" role="tab" id="tab-{{ $tab['id'] }}"
                    :aria-selected="active === '{{ $tab['id'] }}'" aria-controls="panel-{{ $tab['id'] }}"
                    @click="active = '{{ $tab['id'] }}'"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl px-4 py-3 text-sm font-semibold transition-colors"
                    :class="active === '{{ $tab['id'] }}'
                        ?
                        'bg-primary text-primary-foreground' :
                        'text-muted-foreground hover:bg-secondary hover:text-primary'">
                    <x-icon name="{{ $tab['icon'] }}" class="size-4" />
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>

        {{-- Panels --}}
        <div class="mt-8">
            {{-- Capacity --}}
            <div x-show="active === 'capacity'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                role="tabpanel" id="panel-capacity" aria-labelledby="tab-capacity"
                class="overflow-hidden rounded-2xl border border-border bg-card">
                <ul class="divide-y divide-border">
                    @foreach ($capacity as $item)
                        @continue(empty($item['name']))
                        <li
                            class="flex items-center justify-between gap-4 px-6 py-4 transition-colors hover:bg-secondary/60">
                            <span class="font-medium text-foreground">{{ $item['name'] }}</span>
                            <span
                                class="rounded-full bg-secondary px-3 py-1 font-mono text-sm font-medium text-primary">
                                {{ $item['kg'] }} kg/h
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Dimensions --}}
            <div x-show="active === 'dimensions'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                role="tabpanel" id="panel-dimensions" aria-labelledby="tab-dimensions"
                class="grid gap-4 sm:grid-cols-3">
                @foreach ($dimensions as $dim)
                    <div
                        class="flex flex-col items-center gap-3 rounded-2xl border border-border bg-card p-8 text-center">
                        <span class="grid size-12 place-items-center rounded-xl bg-secondary text-primary">
                            <x-icon name="{{ $dim['icon'] }}" class="size-6" />
                        </span>
                        <span class="text-sm uppercase tracking-wide text-muted-foreground">
                            {{ $dim['label'] }}
                        </span>
                        <span class="font-display text-3xl font-bold text-primary">
                            {{ $dim['value'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Energy --}}
            <div x-show="active === 'energy'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                role="tabpanel" id="panel-energy" aria-labelledby="tab-energy"
                class="overflow-hidden rounded-2xl border border-border bg-card">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-sm">
                        <thead>
                            <tr class="bg-primary text-primary-foreground">
                                <th class="px-6 py-4 font-semibold">{{ __('Fuel Type') }}</th>
                                <th class="px-6 py-4 font-semibold">{{ __('Min.') }}</th>
                                <th class="px-6 py-4 font-semibold">{{ __('Max.') }}</th>
                                <th class="px-6 py-4 font-semibold">{{ __('Average') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach ($energy as $row)
                                <tr class="transition-colors hover:bg-secondary/60">
                                    <th scope="row" class="px-6 py-4 font-semibold text-foreground">
                                        {{ $row['label'] }}
                                    </th>
                                    <td class="px-6 py-4 font-mono text-muted-foreground">{{ $row['min'] }}</td>
                                    <td class="px-6 py-4 font-mono text-muted-foreground">{{ $row['max'] }}</td>
                                    <td class="px-6 py-4 font-mono text-muted-foreground">{{ $row['avg'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
