@props([
    'title' => '',
    'subtitle' => '',
])

<h2 class="text-center text-3xl font-bold md:text-5xl"> {{ $title }} </h2>
<p class="mx-auto mb-8 mt-4 text-center text-sm text-gray-400 sm:text-base md:mb-12 lg:mb-16"> {{ $subtitle }} </p>
