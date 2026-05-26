@props([
    'items' => [],
])

@if(count($items) > 0)
    <nav
        {{ $attributes->merge([
            'class' => 'inline-flex max-w-full bg-transparent text-[13px] leading-6'
        ]) }}
        aria-label="Breadcrumb"
    >
        <ol class="flex max-w-full flex-wrap items-center gap-x-1.5 gap-y-1 text-slate-500">
            @foreach($items as $item)
                @php
                    $label = data_get($item, 'label');
                    $url = data_get($item, 'url');
                    $isLast = $loop->last;
                @endphp

                <li class="inline-flex min-w-0 items-center gap-x-1.5">
                    @if(! $loop->first)
                        <svg
                            class="h-3.5 w-3.5 flex-none text-slate-300"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    @endif

                    @if($url && ! $isLast)
                        <a
                            href="{{ $url }}"
                            class="min-w-0 truncate text-slate-500 no-underline transition-colors hover:text-emerald-700 focus-visible:outline-none focus-visible:underline focus-visible:decoration-emerald-600 focus-visible:underline-offset-4"
                        >
                            {{ $label }}
                        </a>
                    @else
                        <span
                            class="min-w-0 truncate font-semibold {{ $isLast ? 'text-emerald-700' : 'text-slate-700' }}"
                            @if($isLast) aria-current="page" @endif
                        >
                            {{ $label }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
