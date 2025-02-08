<div>
    <x-large-landing />

    {{-- Goals / Assists / Clean Sheets --}}
    <x-layout.container>

        <div class="mt-16 pb-12 lg:mt-20 lg:pb-20">
            <div class="relative z-0">
              <div class="absolute inset-0 h-5/6 lg:h-2/3"></div>
              <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative lg:grid lg:grid-cols-7">

                  <div class="mx-auto max-w-md lg:mx-0 lg:max-w-none lg:col-start-1 lg:col-end-3 lg:row-start-2 lg:row-end-3">
                    <div class="h-full flex flex-col rounded-lg shadow-lg overflow-hidden lg:rounded-none lg:rounded-l-lg">
                      <div class="flex-1 flex flex-col">
                        <div class="bg-white px-6 py-10">
                          <div>
                            <h3 class="text-center text-2xl font-medium text-gray-900" id="tier-hobby">Most Assists</h3>
                            <div class="mt-4 flex flex-col items-center justify-center">
                              <img src="{{ $highestAssister->player->detail->photo }}" alt="{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }} Image" />
                            </div>
                          </div>
                        </div>
                        <div class="flex-1 flex flex-col justify-between border-t-2 border-gray-100 p-6 bg-gray-50 sm:p-10 lg:p-6 xl:p-10">
                          <ul role="list" class="space-y-4">

                              <li class="flex items-start">
                                <div class="flex-shrink-0">
                                  <!-- Heroicon name: information-circle -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                    </svg>
                                </div>
                                <p class="ml-3 text-base font-medium text-gray-500">{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }}</p>
                              </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: share -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestAssister->assists }} Assist(s)</p>
                            </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: user-circle -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestAssister->player->role->singular_name }}</p>
                            </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: home -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestAssister->player->detail->team->name }}</p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-10 max-w-lg mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-start-3 lg:col-end-6 lg:row-start-1 lg:row-end-4">
                    <div class="relative z-10 rounded-lg shadow-xl">
                      <div class="pointer-events-none absolute inset-0 rounded-lg border-2 border-indigo-600" aria-hidden="true"></div>
                      <div class="absolute inset-x-0 top-0 transform translate-y-px">
                        <div class="flex justify-center transform -translate-y-1/2">
                          <span class="inline-flex rounded-full bg-indigo-600 px-4 py-1 text-sm font-semibold tracking-wider uppercase text-white">Golden Boot</span>
                        </div>
                      </div>
                      <div class="bg-white rounded-t-lg px-6 pt-12 pb-10">
                        <div>
                          <h3 class="text-center text-3xl font-semibold text-gray-900 sm:-mx-6" id="tier-growth">Most Goals</h3>
                          <div class="mt-4 flex flex-col items-center justify-center">
                              <img src="{{ $highestGoalScorer->player->detail->photo }}" alt="{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }} Image" />
                          </div>
                        </div>
                      </div>
                      <div class="border-t-2 border-gray-100 rounded-b-lg pt-10 pb-8 px-6 bg-gray-50 sm:px-10 sm:py-10">
                        <ul role="list" class="space-y-4">
                          <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: information-circle -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base font-medium text-gray-500">{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }}</p>
                          </li>

                          <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: globe-alt -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base font-medium text-gray-500">{{ $highestGoalScorer->goals_scored }} Goal(s)</p>
                          </li>

                          <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: user-circle -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base font-medium text-gray-500">{{ $highestGoalScorer->player->role->singular_name }}</p>
                          </li>

                          <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: home -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </div>
                            <p class="ml-3 text-base font-medium text-gray-500">{{ $highestGoalScorer->player->detail->team->name }}</p>
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="mt-10 mx-auto max-w-md lg:m-0 lg:max-w-none lg:col-start-6 lg:col-end-8 lg:row-start-2 lg:row-end-3">
                    <div class="h-full flex flex-col rounded-lg shadow-lg overflow-hidden lg:rounded-none lg:rounded-r-lg">
                      <div class="flex-1 flex flex-col">
                        <div class="bg-white px-6 py-10">
                          <div>
                            <h3 class="text-center text-2xl font-medium text-gray-900" id="tier-scale">Most Clean Sheets</h3>
                            <div class="mt-4 flex flex-col items-center justify-center">
                              <img src="{{ $highestCleanSheets->player->detail->photo }}" alt="{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }} Image" />
                            </div>
                          </div>
                        </div>
                        <div class="flex-1 flex flex-col justify-between border-t-2 border-gray-100 p-6 bg-gray-50 sm:p-10 lg:p-6 xl:p-10">
                          <ul role="list" class="space-y-4">

                              <li class="flex items-start">
                                <div class="flex-shrink-0">
                                  <!-- Heroicon name: information-circle -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                    </svg>
                                </div>
                                <p class="ml-3 text-base font-medium text-gray-500">{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }}</p>
                              </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: bolt -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestCleanSheets->clean_sheets }} Clean Sheet(s)</p>
                            </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: user-circle -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestCleanSheets->player->role->singular_name }}</p>
                            </li>

                            <li class="flex items-start">
                              <div class="flex-shrink-0">
                              <!-- Heroicon name: home -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                              </div>
                              <p class="ml-3 text-base font-medium text-gray-500">{{ $highestCleanSheets->player->detail->team->name }}</p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

    </x-layout.container>

    {{-- Small Stats --}}
    <x-facts.2.container
        title="Top Performers"
        subheading="Highest expected performing players of the season">

          <div>
            <h6>Expected Goals</h6>
            <div id="xg-chart"></div>
          </div>

          <div>
            <h6>Expected Assists</h6>
            <div id="xa-chart"></div>
          </div>

          <div>
            <h6>Expected Goal Involvements</h6>
            <div id="gi-chart"></div>
          </div>

    </x-facts.2.container>

    <x-layout.container>

        <x-layout.container.title title="Recent News"
                                  subtitle="The latest news regarding players" />

        <x-blog.container>

            @foreach ($recentNews as $post)

                <x-blog.item
                    title="{!! $post->headline !!}"
                    description="{!! $post->description !!}"
                    image="{!! $post->images[0]->link !!}"
                    date="{{ date('D d M Y - H:i:s', strtotime($post->created_at)) }}"
                    link="{!! $post->link !!}"
                    alt="" />

            @endforeach

        </x-blog.container>

        <x-button.outline-rounded-link-icon text="View All"
                                            link="{{ route('news.view') }}" />

    </x-layout.container>


    {{-- Dream Team --}}
    <x-layout.container>

        <x-layout.container.title title="Gameweek {{ $gameweek->id }} Dream Team"
                                  subtitle="The most inform players from the current gameweek" />

        <x-layout.gameweek.grid>

            @foreach ($dreamTeam as $player)

                <x-layout.gameweek.item
                    title="{!! $player->player->first_name !!} {!! $player->player->second_name !!}"
                    subheading="{!! $player->player->detail->team->name !!}"
                    points="{{ $player->points }}"
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

<script>
    new ApexCharts(document.querySelector("#xg-chart"), {
        {!! $xg_chart !!}
    }).render();

    new ApexCharts(document.querySelector("#xa-chart"), {
        {!! $xa_chart !!}
    }).render();

    new ApexCharts(document.querySelector("#gi-chart"), {
        {!! $gi_chart !!}
    }).render();
</script>
