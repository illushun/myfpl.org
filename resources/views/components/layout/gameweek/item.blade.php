@props([
    'title' => '',
    'subheading' => '',
    'points' => '',
    'image' => ''
])

<div class="mx-auto flex w-full flex-col items-center gap-2 py-8 text-center relative md:px-8 md:py-4 lg:px-12">

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 py-2 px-4 rounded-full bg-green-300 border border-green-500 drop-shadow-lg">
        <p class="text-center text-lg text-green-800">+{{ $points }}</p>
    </div>

    <img src="{{ $image }}" alt="" class="inline-block h-40 w-40 object-contain" />
    <p class="font-bold">{{ $title }}</p>
    <p class="text-center text-sm text-gray-500">{{ $subheading }}</p>

</div>
