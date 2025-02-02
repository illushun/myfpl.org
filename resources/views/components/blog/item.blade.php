@props([
    'title' => '',
    'description' => '',
    'image' => '',
    'date' => '',
    'link' => '#',
    'alt' => ''
])

<div>

  <a href="{{ $link }}" target="_blank">
    <img src="{{ $image }}" class="object-contain w-full h-56 mb-5 bg-center rounded" alt="{{ $alt }}" loading="lazy" />
  </a>

  <h2 class="mb-2 text-lg font-semibold text-gray-900">
    <a href="#" class="text-gray-900 hover:text-purple-700">{{ $title }}</a>
  </h2>

  <p class="mb-3 text-sm font-normal text-gray-500 mb-4">{{ $description }}</p>
  <p class="mb-3 text-xs font-normal text-gray-400">{{ $date }}</p>

</div>
