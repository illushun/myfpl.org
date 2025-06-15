{{--
    Final Navigation Bar - Compact Glassmorphism

    - Combines the approved compact structure with the glassmorphism background.
    - Uses the standardized 'brand-accent' color for all highlights.
    - This is the complete and final code for the header.
--}}
<header
    class="sticky top-0 inset-x-0 z-50 bg-black/70 backdrop-blur-lg border-b border-brand-accent/50 shadow-lg"
>
    <nav class="relative max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">

        <div class="flex-none">
            <a
                class="flex-none font-semibold text-xl text-white focus:outline-none"
                href="{{ route('index') }}"
                aria-label="Brand"
            >
                MyFPL
            </a>
        </div>
        <div class="hidden md:flex items-center gap-2">
            <a
                class="px-3 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-md transition-colors"
                href="{{ route('players.view') }}"
                aria-current="page"
            >
                Players
            </a>
            <a
                class="px-3 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-md transition-colors"
                href="{{ route('news.view') }}"
            >
                News
            </a>
        </div>
        <div class="flex items-center gap-x-4">
            <a
                class="hidden sm:block px-4 py-1.5 text-sm font-medium text-brand-accent rounded-full ring-1 ring-inset ring-brand-accent hover:bg-brand-accent/10 transition-colors"
                href="#"
            >
                Log In
            </a>

            <div
                x-data="{}"
                class="md:hidden"
            >
                <button
                    type="button"
                    @click="$dispatch('toggle-mobile-menu')"
                    class="relative size-9 flex justify-center items-center text-sm font-semibold rounded-md text-gray-300 hover:bg-white/10 focus:outline-none"
                    aria-label="Toggle navigation"
                >
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                </button>
            </div>
            </div>
        </nav>
</header>

<div
    x-data="{ isOpen: false }"
    @toggle-mobile-menu.window="isOpen = !isOpen"
    x-show="isOpen"
    x-transition:enter="duration-200 ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="duration-150 ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-black/50 backdrop-blur-lg md:hidden"
    @click.away="isOpen = false"
    style="display: none;"
>
    <div class="flex flex-col gap-y-2 rounded-b-2xl p-4 pt-24 bg-gray-950/90 shadow-2xl">
        <a class="block w-full px-3 py-2 text-base text-gray-300 hover:bg-white/5 hover:text-white rounded-md transition-colors" href="{{ route('players.view') }}" aria-current="page">Players</a>
        <a class="block w-full px-3 py-2 text-base text-gray-300 hover:bg-white/5 hover:text-white rounded-md transition-colors" href="{{ route('news.view') }}">News</a>
        <div class="border-t border-white/10 mt-2 pt-2">
            <a class="block w-full px-3 py-2 text-base text-gray-300 hover:bg-white/5 hover:text-white rounded-md transition-colors sm:hidden" href="#">Log In</a>
        </div>
    </div>
</div>

<style>
/* Styles the currently active navigation link */
[aria-current="page"] {
    color: theme('colors.brand-accent');
    font-weight: 600;
}

/* Styles the active link specifically on the mobile menu */
@media (max-width: 767px) {
    [aria-current="page"] {
        background-color: theme('colors.brand-accent / 0.1');
    }
}
</style>