<div>

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

    <x-feature.3.container
        title="Recent News"
        subheading="The latest news regarding players">

        @foreach ($recentNews as $news)

            <x-feature.3.item
        title="{{ $news->player->first_name }} {{ $news->player->second_name }} ({{ $news->player->detail->team->name }})"
                subheading="{{ $news->news }}"
                image="{{ $news->player->detail->photo }}" />

        @endforeach

    </x-feature.3.container>

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
    <x-team.container
        title="Gameweek {{ $gameweek->id }} Dream Team"
        subheading="The most inform players from the current gameweek">

        @foreach ($dreamTeam as $player)

            <x-team.item
                title="{{ $player->player->first_name }} {{ $player->player->second_name }}"
                subheading="{{ $player->points }} Point(s)"
                image="{{ $player->player->detail->photo }}" />

        @endforeach

    </x-team.container>

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
