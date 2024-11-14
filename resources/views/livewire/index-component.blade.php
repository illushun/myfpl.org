<div>
<!-- ========== HEADER ========== -->
<header class="sticky top-4 inset-x-0 before:absolute before:inset-0 before:max-w-[66rem] before:mx-2 before:lg:mx-auto before:rounded-[26px] before:border before:border-gray-200 after:absolute after:inset-0 after:-z-[1] after:max-w-[66rem] after:mx-2 after:lg:mx-auto after:rounded-[26px] after:bg-white flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full">
  <nav class="relative max-w-[66rem] w-full md:flex md:items-center md:justify-between md:gap-3 ps-5 pe-2 mx-2 lg:mx-auto py-2">
    <!-- Logo w/ Collapse Button -->
    <div class="flex items-center justify-between">
      <a class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80" href="#" aria-label="Brand">Brand</a>

      <!-- Collapse Button -->
      <div class="md:hidden">
        <button type="button" class="hs-collapse-toggle relative size-9 flex justify-center items-center text-sm font-semibold rounded-full border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" id="hs-header-classic-collapse" aria-expanded="false" aria-controls="hs-header-classic" aria-label="Toggle navigation" data-hs-collapse="#hs-header-classic">
          <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
          <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          <span class="sr-only">Toggle navigation</span>
        </button>
      </div>
      <!-- End Collapse Button -->
    </div>
    <!-- End Logo w/ Collapse Button -->

    <!-- Collapse -->
    <div id="hs-header-classic" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block" aria-labelledby="hs-header-classic-collapse">
      <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
        <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-0.5 md:gap-1">
          <a class="p-2 flex items-center text-sm text-blue-600 focus:outline-none focus:text-blue-600" href="#" aria-current="page">
            <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            Landing
          </a>

          <a class="p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
            <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Account
          </a>

          <a class="p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
            <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12h.01"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M22 13a18.15 18.15 0 0 1-20 0"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
            Work
          </a>

          <a class="p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
            <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
            Blog
          </a>

          <!-- Dropdown -->
          <div class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] ">
            <button id="hs-header-classic-dropdown" type="button" class="hs-dropdown-toggle w-full p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
              <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 10 2.5-2.5L3 5"/><path d="m3 19 2.5-2.5L3 14"/><path d="M10 6h11"/><path d="M10 12h11"/><path d="M10 18h11"/></svg>
              Dropdown
              <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto md:ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="hs-header-classic-dropdown">
              <div class="py-1 md:px-1 space-y-0.5">
                <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                  About
                </a>

                <div class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] md:[--trigger:hover] [--is-collapse:true] md:[--is-collapse:false] relative">
                  <button id="hs-header-classic-dropdown-sub" type="button" class="hs-dropdown-toggle w-full py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                    Sub Menu
                    <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:-rotate-90 md:-rotate-90 duration-300 ms-auto shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>

                  <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:end-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="hs-header-classic-dropdown-sub">
                    <div class="p-1 space-y-0.5 md:space-y-1">
                      <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                        About
                      </a>

                      <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                        Downloads
                      </a>

                      <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                        Team Account
                      </a>
                    </div>
                  </div>
                </div>

                <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                  Downloads
                </a>

                <a class="py-1.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
                  Team Account
                </a>
              </div>
            </div>
          </div>
          <!-- End Dropdown -->

          <!-- Button Group -->
          <div class="relative flex flex-wrap items-center gap-x-1.5 md:ps-2.5  md:ms-1.5 before:block before:absolute before:top-1/2 before:-start-px before:w-px before:h-4 before:bg-gray-300 before:-translate-y-1/2">
            <a class="p-2 w-full flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500" href="#">
              <svg class="shrink-0 size-4 me-3 md:me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
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

    <x-large-landing />

    {{-- Small Stats --}}
    <x-facts.2.container
        title="Top Performers"
        subheading="Highest expected performing players currently">

        <x-facts.2.item
            title="{{ $highestExpectedGoals->expected_goals }} xG"
            subheading="{{ $highestExpectedGoals->player->first_name }} {{ $highestExpectedGoals->player->second_name }}" />

        <x-facts.2.item
            title="{{ $highestExpectedAssists->expected_assists }} xA"
            subheading="{{ $highestExpectedAssists->player->first_name }} {{ $highestExpectedAssists->player->second_name }}" />

        <x-facts.2.item
            title="{{ $highestExpectedGoalsPer90->expected_goals_per_90 }} xGP90"
            subheading="{{ $highestExpectedGoalsPer90->player->first_name }} {{ $highestExpectedGoalsPer90->player->second_name }}" />

    </x-facts.2.container>

    <x-layout.container>

        <x-layout.container.title title="Recent News"
                                  subtitle="The latest news regarding players" />

        <x-layout.news.grid>

            @foreach ($recentNews as $news)

                <x-layout.news.item title="{{ $news->news }}"
                                    subheading="{{ $news->player->first_name }} {{ $news->player->second_name }} ({{ $news->player->detail->team->name }})"
                                    image="{{ $news->player->detail->photo }}"
                                    alt="{{ $news->player->first_name }} {{ $news->player->second_name }} photo"
                                    link="{{ route('player.view', $news->player->id) }}" />

            @endforeach

        </x-layout.news.grid>

        <x-button.outline-rounded-link-icon text="View All"
                                            link="{{ route('news.view') }}" />

    </x-layout.container>

    {{-- Goals / Assists / Clean Sheets --}}
    <x-feature.v8.container>

          <!-- Item -->
          <div class="sticky top-0 -mt-48 mb-48 rounded-t-[46px] border-t border-black bg-white px-5 py-10 sm:px-20">
            <div class="mb-14 flex gap-8 text-2xl font-bold">
              <p>Most Goals</p>
            </div>
            <div class="flex flex-col-reverse gap-8 sm:gap-20 lg:flex-row lg:items-center">
              <div class="max-w-2xl">
                  <img src="{{ $highestGoalScorer->player->detail->photo }}" alt="Top Scorer Image" />
              </div>
              <div class="max-w-2xl">
                  <h2 class="mb-4 text-3xl font-bold md:text-5xl">{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }}</h2>

                  <div class="grid grid-cols-1 lg:grid-cols-3 border bg-white border-gray-400 rounded-md">

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Goals</span>
                      </div>
                      <span class="text-2xl font-bold text-indigo-400">{{ $highestGoalScorer->goals_scored }}</span>
                    </div>

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Team</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestGoalScorer->player->detail->team->name }}</span>
                    </div>

                    <div class="p-8 flex flex-col lg:items-start items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Position</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestGoalScorer->player->role->singular_name }}</span>
                    </div>

                  </div>

              </div>
            </div>
          </div>

          <!-- Item -->
          <div class="sticky top-24 -mt-24 mb-24 rounded-t-[46px] border-t border-black bg-white px-5 py-10 sm:px-20">
            <div class="mb-14 flex gap-8 text-2xl font-bold">
              <p>Most Assists</p>
            </div>
            <div class="flex flex-col-reverse gap-8 sm:gap-20 lg:flex-row lg:items-center">
              <div class="max-w-2xl">
                  <img src="{{ $highestAssister->player->detail->photo }}" alt="Top Assister Image" />
              </div>
              <div class="max-w-2xl">
                  <h2 class="mb-4 text-3xl font-bold md:text-5xl">{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }}</h2>

                  <div class="grid grid-cols-1 lg:grid-cols-3 border bg-white border-gray-400 rounded-md">

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Assists</span>
                      </div>
                      <span class="text-2xl font-bold text-indigo-400">{{ $highestAssister->assists }}</span>
                    </div>

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Team</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestAssister->player->detail->team->name }}</span>
                    </div>

                    <div class="p-8 flex flex-col lg:items-start items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Position</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestAssister->player->role->singular_name }}</span>
                    </div>

                  </div>

              </div>
            </div>
          </div>

          <!-- Item -->
          <div class="sticky top-48 rounded-t-[46px] border-t border-black bg-white px-5 py-10 sm:px-20">
            <div class="mb-14 flex gap-8 text-2xl font-bold">
              <p>Most Clean Sheets</p>
            </div>
            <div class="flex flex-col-reverse gap-8 sm:gap-20 lg:flex-row lg:items-center">
              <div class="max-w-2xl">
                  <img src="{{ $highestCleanSheets->player->detail->photo }}" alt="Top Assister Image" />
              </div>
              <div class="max-w-2xl">
                  <h2 class="mb-4 text-3xl font-bold md:text-5xl">{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }}</h2>

                  <div class="grid grid-cols-1 lg:grid-cols-3 border bg-white border-gray-400 rounded-md">

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Clean Sheets</span>
                      </div>
                      <span class="text-2xl font-bold text-indigo-400">{{ $highestCleanSheets->clean_sheets }}</span>
                    </div>

                    <div class="lg:border-r border-b border-gray-400 p-8 flex flex-col lg:items-start lg:border-b-0 items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Team</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestCleanSheets->player->detail->team->name }}</span>
                    </div>

                    <div class="p-8 flex flex-col lg:items-start items-center justify-center">
                      <div class="flex justify-between w-full mb-8">
                        <span class="text-gray-500 font-bold">Position</span>
                      </div>
                      <span class="text-2xl font-bold">{{ $highestCleanSheets->player->role->singular_name }}</span>
                    </div>

                  </div>

              </div>
            </div>
          </div>

    </x-feature.v8.container>

    {{-- Dream Team --}}
    <x-layout.container>

        <x-layout.container.title title="Gameweek {{ $gameweek->id }} Dream Team"
                                  subtitle="The most inform players from the current gameweek" />

        <x-layout.gameweek.grid>

            @foreach ($dreamTeam as $player)

                <x-layout.gameweek.item
                    title="{{ $player->player->first_name }} {{ $player->player->second_name }}"
                    subheading="{{ $player->points }} Point(s)"
                    image="{{ $player->player->detail->photo }}" />

            @endforeach

        </x-layout.gameweek.grid>

    </x-layout.container>

{{-- <footer class="block">
  <!-- Container -->
  <div class="py-16 md:py-20 mx-auto w-full max-w-7xl px-5 md:px-10">
    <!-- Component -->
    <div class="flex-col flex items-center">
      <a href="#" class="mb-8 inline-block max-w-full text-black">
        <img src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a94d6f4e6cf96_Group%2047874-3.png" alt="" class="inline-block max-h-10" />
      </a>
      <div class="text-center font-semibold">
        <a href="#" class="inline-block px-6 py-2 font-normal text-black transition hover:text-blue-600"> About </a>
        <a href="#" class="inline-block px-6 py-2 font-normal text-black transition hover:text-blue-600"> Features </a>
        <a href="#" class="inline-block px-6 py-2 font-normal text-black transition hover:text-blue-600"> Works </a>
        <a href="#" class="inline-block px-6 py-2 font-normal text-black transition hover:text-blue-600"> Support </a>
        <a href="#" class="inline-block px-6 py-2 font-normal text-black transition hover:text-blue-600"> Help </a>
      </div>
      <div class="mb-8 mt-8 border-b border-gray-300 w-48"></div>
      <div class="mb-12 grid-cols-4 grid-flow-col grid w-full max-w-52 gap-3">
        <a href="#" class="mx-auto flex-col flex max-w-6 items-center justify-center text-black">
          <img src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a945b4ae6cf7b_Vector-1.svg" alt="" class="inline-block" />
        </a>
        <a href="#" class="mx-auto flex-col flex max-w-6 items-center justify-center text-black">
          <img src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a945560e6cf77_Vector.svg" alt="" class="inline-block" />
        </a>
        <a href="#" class="mx-auto flex-col flex max-w-6 items-center justify-center text-black">
          <img src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a940535e6cf7a_Vector-3.svg" alt="" class="inline-block" />
        </a>
        <a href="#" class="mx-auto flex-col flex max-w-6 items-center justify-center text-black">
          <img src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a9433a9e6cf88_Vector-2.svg" alt="" class="inline-block" />
        </a>
      </div>
      <p class="text-sm sm:text-base"> © Copyright 2024. All rights reserved. </p>
    </div>
  </div>
</footer> --}}

</div>
