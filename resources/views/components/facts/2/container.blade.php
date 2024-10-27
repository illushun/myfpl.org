@props([
    'title' => '',
    'subheading' => ''
])

<section>

  <!-- Container -->
  <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-20">

    <!-- Title -->
    <h2 class="text-center text-3xl font-bold md:text-5xl text-indigo-400">{{ $title }}</h2>
    <p class="mx-auto mb-8 mt-4 max-w-lg items-center text-center text-sm text-gray-500 sm:text-base md:mb-12 lg:mb-16">{{ $subheading }}</p>

    <!-- Content -->
    <div class="mx-auto flex w-full max-w-4xl flex-col flex-wrap justify-between gap-5 px-16 py-8 sm:flex-row md:gap-6">

        {{ $slot }}

    </div>

  </div>

</section>
