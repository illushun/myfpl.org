@props([
    'title' => '',
    'subheading' => '',
    'image' => ''
])

<div class="grid gap-6 rounded-md border border-solid border-gray-300 p-8 md:p-10">

    <img src="{{ $image }}" alt="" class="inline-block h-16 w-16 object-contain rounded-full " />

    <h3 class="text-xl font-semibold">{{ $title }}</h3>
    <p class="text-sm text-gray-500">{{ $subheading }}</p>

</div>
