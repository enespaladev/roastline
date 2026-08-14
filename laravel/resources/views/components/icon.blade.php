@props(['name'])

@php
    $icons = [
        'gauge' => '<path d="m12 14 4-4" /><path d="M3.34 19a10 10 0 1 1 17.32 0" />',
        'flame' =>
            '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z" />',
        'users' =>
            '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />',
        'shield-check' =>
            '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" /><path d="m9 12 2 2 4-4" />',
        'chevron-right' => '<path d="m9 18 6-6-6-6" />',
        'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />',
        'x' => '<path d="M4 4l16 16" /><path d="M20 4L4 20" />',
        'linkedin' =>
            '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" /><rect width="4" height="12" x="2" y="9" /><circle cx="4" cy="4" r="2" />',
        'pinterest' =>
            '<circle cx="12" cy="12" r="10" /><path d="M8 21c1-3 1.5-6 2-9" /><path d="M12 12a3 3 0 1 0-5-2.5c0 1 .5 1.5 1 2" />',
        'whatsapp' => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 3.4z" />',
        'move-diagonal' =>
            '<polyline points="5 11 5 5 11 5" /><polyline points="19 13 19 19 13 19" /><line x1="5" x2="19" y1="5" y2="19" />',
        'move-horizontal' =>
            '<polyline points="18 8 22 12 18 16" /><polyline points="6 8 2 12 6 16" /><line x1="2" x2="22" y1="12" y2="12" />',
        'move-vertical' =>
            '<polyline points="8 18 12 22 16 18" /><polyline points="8 6 12 2 16 6" /><line x1="12" x2="12" y1="2" y2="22" />',
        'zap' =>
            '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />',
        'chevron-right' =>
            '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />',
        'calendar-days' =>
            '<path d="M8 2v3"/><path d="M16 2v3"/><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M8 13h.01"/><path d="M12 13h.01"/><path d="M16 13h.01"/><path d="M8 17h.01"/><path d="M12 17h.01"/><path d="M16 17h.01"/>',
        'tag' => '<path
    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z" />
<circle cx="7.5" cy="7.5" r=".5" fill="currentColor" />',
    ];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
    stroke-linecap="round" stroke-linejoin="round" {{ $attributes }}>
    {!! $icons[$name] ?? '' !!}
</svg>
