@props([
    'title' => '',
    'subheading' => ''
])

<section {{ $attributes->merge(['class' => 'px-4 mx-auto max-w-7xl']) }}>

    @if ($title && $subheading)
        <h2 class="mb-2 text-3xl font-extrabold leading-tight text-gray-900">{{ $title }}</h2>
        <p class="mb-20 text-lg text-gray-500">{{ $subheading }}</p>
    @endif

  <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">

      {{ $slot }}

  </div>

</section>
