<!-- ========== HEADER ========== -->
<header
  class="sticky top-4 inset-x-0 before:absolute before:inset-0 before:max-w-[66rem] before:mx-2 before:lg:mx-auto before:rounded-[26px] before:border before:border-gray-200 after:absolute after:inset-0 after:-z-[1] after:max-w-[66rem] after:mx-2 after:lg:mx-auto after:rounded-[26px] after:bg-white flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full"
  x-data="{ isOpen: false }"
>
  <nav class="relative max-w-[66rem] w-full md:flex md:items-center md:justify-between md:gap-3 ps-5 pe-2 mx-2 lg:mx-auto py-2">
    <!-- Logo w/ Collapse Button -->
    <div class="flex items-center justify-between">
      <a
        class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80"
        href="{{ route('index') }}"
        aria-label="Brand"
      >
        MyFPL
      </a>

      <!-- Collapse Button -->
      <div class="md:hidden">
        <button
          type="button"
          @click="isOpen = !isOpen"
          class="relative size-9 flex justify-center items-center text-sm font-semibold rounded-full border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <!-- Open Icon -->
          <svg
            x-show="!isOpen"
            xmlns="http://www.w3.org/2000/svg"
            class="size-4"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <line x1="3" x2="21" y1="6" y2="6" />
            <line x1="3" x2="21" y1="12" y2="12" />
            <line x1="3" x2="21" y1="18" y2="18" />
          </svg>
          <!-- Close Icon -->
          <svg
            x-show="isOpen"
            xmlns="http://www.w3.org/2000/svg"
            class="size-4"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M18 6 6 18" />
            <path d="M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- End Collapse Button -->
    </div>
    <!-- End Logo w/ Collapse Button -->

    <!-- Collapse -->
    <div
      id="hs-header-classic"
      class="hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block"
      :class="{ 'hidden': !isOpen }"
      x-bind:class="{ 'block': isOpen, 'hidden': !isOpen } md:block"
    >
      <div
        class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300"
      >
        <div
          class="py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-0.5 md:gap-1"
        >
          <a
            class="p-2 flex items-center text-sm text-blue-600 focus:outline-none focus:text-blue-600"
            href="{{ route('players.view') }}"
            aria-current="page"
          >
            <svg
              class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
              <path
                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
              />
            </svg>
            Players
          </a>

          <a
            class="p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500"
            href="{{ route('news.view') }}"
          >
            <svg
              class="shrink-0 size-4 me-3 md:me-2 block md:hidden"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
            News
          </a>

          <!-- Button Group -->
          <div
            class="relative flex flex-wrap items-center gap-x-1.5 md:ps-2.5 md:ms-1.5 before:block before:absolute before:top-1/2 before:-start-px before:w-px before:h-4 before:bg-gray-300 before:-translate-y-1/2"
          >
            <a
              class="p-2 w-full flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500"
              href="#"
            >
              <svg
                class="shrink-0 size-4 me-3 md:me-2"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
              Log in
            </a>
          </div>
          <!-- End Button Group -->
        </div>
      </div>
    </div>
    <!-- End Collapse -->
  </nav>
</header>
<!-- ========== END HEADER ========== -->

