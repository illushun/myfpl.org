@props([
    'title' => '',
    'subheading' => ''
])

<section>

  <!-- Container -->
  <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-20">

    <!-- Title -->
    <h2 class="text-center text-3xl font-bold md:text-5xl text-indigo-400"> {{ $title }} </h2>
    <p class="mx-auto mb-8 mt-4 text-center text-sm text-gray-500 sm:text-base md:mb-12 lg:mb-16"> {{ $subheading }} </p>

    <!-- Content -->
    <div class="grid grid-cols-1 justify-items-center gap-5 sm:grid-cols-2 sm:justify-items-stretch md:grid-cols-3 md:gap-4 lg:gap-6">

        {{ $slot }}

    </div>

  </div>

</section>
