@props([
    'title' => '',
    'subheading' => ''
])

<section>
  <div class="mx-auto max-w-screen-xl px-4 py-24 sm:px-6 sm:py-24 lg:py-24 lg:px-8">
    <header>
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">{{ $title }}</h2>

      <p class="mt-4 max-w-md text-gray-500">
        {{ $subheading }}
      </p>
    </header>

    {{ $slot }}

  </div>

</section>
