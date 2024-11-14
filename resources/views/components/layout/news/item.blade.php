@props([
    'title' => '',
    'subheading' => '',
    'image' => '',
    'alt' => '',
    'link' => '#'
])

<a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition" href="{{ $link }}">

  <div class="aspect-w-16 aspect-h-9">

    <img class="w-full object-contain rounded-t-xl" loading="lazy" src="{{ $image }}" alt="{{ $alt }}">

  </div>

  <div class="p-4 md:p-5">

    <p class="mt-2 text-xs uppercase text-gray-400">
      {{ $subheading }}
    </p>

    <h3 class="mt-2 text-lg font-medium text-gray-800 group-hover:text-indigo-400">
      {{ $title }}
    </h3>

  </div>

</a>
