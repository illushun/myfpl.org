@props([
    'title' => '',
    'image' => '',
    'position' => '',
    'strength' => '',
    'link' => '#'
])

<li>
    <a href="{{ $link }}" class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
      <img
        alt="Team Logo"
        src="{{ $image }}"
        class="h-16 w-full rounded-md object-contain"
      />

      <div class="mt-2">
        <dl>
          <div>
            <dt class="sr-only">Team Name</dt>

            <dd class="font-medium">{{ $title }}</dd>
          </div>
        </dl>

        <div class="mt-6 flex items-center gap-8 text-xs">
          <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
<svg class="size-4 text-indigo-700" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22,7H16.333V4a1,1,0,0,0-1-1H8.667a1,1,0,0,0-1,1v7H2a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1V8A1,1,0,0,0,22,7ZM7.667,19H3V13H7.667Zm6.666,0H9.667V5h4.666ZM21,19H16.333V9H21Z"/></svg>

            <div class="mt-1.5 sm:mt-0">
              <p class="text-gray-500">Position</p>

              <p class="font-medium">{{ $position }}</p>
            </div>
          </div>

          <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
            <svg
              class="size-4 text-indigo-700"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
              />
            </svg>

            <div class="mt-1.5 sm:mt-0">
              <p class="text-gray-500">Strength</p>

              <p class="font-medium">{{ $strength }}</p>
            </div>
          </div>

        </div>
      </div>
    </a>
</li>
