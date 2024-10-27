<header class="sticky inset-x-0 top-0 z-50 bg-white shadow-[rgba(50,_50,_105,_0.15)_0px_2px_5px_0px,_rgba(0,_0,_0,_0.05)_0px_1px_1px_0px]" x-data="{ open: false, activePage: window.location.pathname }">
  <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
      <a href="./" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
      </a>
    </div>
    <div class="flex lg:hidden">
      <button type="button" @click="open = !open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
      <a href="./teams" :class="{ 'text-indigo-400': activePage === '/teams' }" class="text-sm font-semibold leading-6 text-gray-900">Teams</a>
      <a href="#" :class="{ 'text-indigo-400': activePage === '/players' }" class="text-sm font-semibold leading-6 text-gray-900">Players</a>
      <a href="./news" :class="{ 'text-indigo-400': activePage === '/news' }" class="text-sm font-semibold leading-6 text-gray-900">News</a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
    </div>
  </nav>

  <!-- Mobile menu, show/hide based on menu open state. -->
  <div class="lg:hidden" x-show="open" x-transition:enter="transition transform ease-out duration-300"
       x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
       x-transition:leave="transition transform ease-in duration-300"
       x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
       role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50" @click="open = false"></div>
    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="./" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="">
        </a>
        <button type="button" @click="open = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Close menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            <a href="./teams" :class="{ 'text-indigo-400': activePage === '/teams' }" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Teams</a>
            <a href="#" :class="{ 'text-indigo-400': activePage === '/players' }" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Players</a>
            <a href="./news" :class="{ 'text-indigo-400': activePage === '/news' }" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">News</a>
          </div>
          <div class="py-6">
            <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
