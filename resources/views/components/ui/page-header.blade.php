@props([
    'title',
    'description' => null,
])

<header
    {{ $attributes->merge([
        'class' => 'mb-8'
    ]) }}
>
    <div
        class="
            flex flex-col gap-5
            md:flex-row
            md:items-center
            md:justify-between
        "
    >
        <div class="min-w-0">
            <h1
                class="
                    text-[28px]
                    font-semibold
                    leading-[1.2]
                    tracking-[-0.02em]
                    text-slate-800
                    sm:text-[30px]
                "
            >
                {{ $title }}
            </h1>

            @if ($description)
                <p
                    class="
                        mt-2
                        max-w-3xl
                        text-[15px]
                        leading-6
                        text-slate-500
                    "
                >
                    {{ $description }}
                </p>
            @endif
        </div>

        @isset($actions)
            <div
                class="
                    flex shrink-0
                    flex-wrap
                    items-center
                    gap-3
                "
            >
                {{ $actions }}
            </div>
        @endisset
    </div>
</header>
