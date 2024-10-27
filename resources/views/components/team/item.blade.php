@props([
    'title' => '',
    'subheading' => '',
    'image' => ''
])

<div class="mx-auto flex w-full flex-col items-center gap-4 py-8 text-center md:px-8 md:py-4 lg:px-12">

    <img src="{{ $image }}" alt="" class="mb-4 inline-block h-40 w-40 rounded-full object-contain" />
    <p class="font-bold">{{ $title }}</p>
    <p class="text-center text-sm text-gray-500">{{ $subheading }}</p>

</div>
