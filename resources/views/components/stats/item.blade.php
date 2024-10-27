@props([
    'title' => '',
    'subheading' => ''
])

<div class="mx-auto flex max-w-xs flex-col gap-y-4">
    <dt class="text-base leading-7 text-gray-600">{{ $subheading }}</dt>
    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $title }}</dd>
</div>
