@props([
    'title' => '',
    'subheading' => ''
])

<div class="flex flex-col items-center justify-center gap-4">
    <p class="text-sm">{{ $subheading }}</p>
    <h2 class="text-3xl font-bold md:text-5xl">{{ $title }}</h2>
</div>
