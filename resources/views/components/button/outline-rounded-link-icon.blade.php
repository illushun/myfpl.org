@props([
    'text' => '',
    'link' => '#',
])

<div class="text-center">

    <div class="inline-block bg-white border shadow-sm rounded-full">

      <div class="py-3 px-4 flex items-center gap-x-2">

        <a class="inline-flex items-center gap-x-1.5 text-indigo-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="{{ $link }}">
          {{ $text }}
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>

      </div>

    </div>

</div>
