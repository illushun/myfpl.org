@props([
    'title' => '',
    'subheading' => ''
])

<section>

  <!-- Container -->
  <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-20">

    <!-- Title -->
    <div class="flex flex-col items-center text-center">

      <h2 class="text-3xl font-bold md:text-5xl">{{ $title }}</h2>
      <p class="mb-8 mt-4 max-w-lg text-base text-gray-400 md:mb-12 md:text-lg lg:mb-16">{{ $subheading }}</p>

    </div>

    <!-- Content -->
    <div class="mx-auto flex w-full max-w-6xl flex-col flex-wrap justify-between gap-5 px-0 py-0 sm:flex-row md:gap-6 sm:px-16 sm:py-8">

        {{ $slot }}

    </div>

  </div>

</section>
