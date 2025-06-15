{{--
    Redesigned Landing Page - Enhanced Dark Theme

    Key Improvements:
    - A sophisticated, immersive dark theme using a deep color palette.
    - Consistent use of a vibrant accent color (teal) for visual cohesion.
    - Introduction of "glassmorphism" effects with backdrop blurs and glows.
    - Enhanced hover effects for a more dynamic and interactive user experience.
    - Typography optimized for readability on dark backgrounds.
--}}

{{-- The main wrapper now uses a gradient for a more dynamic background --}}
<div class="bg-black text-gray-300">

    {{-- The main hero section would need to be adapted for a dark theme as well --}}
    <x-large-landing />

    {{--
        Season Leaders Section - Updated with Smaller Dots of Mist

        - Replaced the two large mist clouds with four smaller, circular "dots".
        - Scattered the dots at various positions, sizes, and opacities for a more
          subtle and organic atmospheric effect.
    --}}
    <div class="relative isolate bg-black">

        <div class="absolute -z-10 h-[20rem] w-[20rem] -translate-y-1/2 rounded-full bg-gradient-to-r from-brand-accent to-transparent opacity-10 blur-3xl top-1/4 left-1/4"></div>
        <div class="absolute -z-10 h-[30rem] w-[30rem] -translate-x-1/2 rounded-full bg-gradient-to-r from-brand-accent to-transparent opacity-15 blur-3xl top-0 -right-1/4"></div>
        <div class="absolute -z-10 h-[25rem] w-[25rem] translate-y-1/2 rounded-full bg-gradient-to-r from-brand-accent to-transparent opacity-10 blur-3xl bottom-1/4 -left-1/4"></div>
        <div class="absolute -z-10 h-[20rem] w-[20rem] translate-x-1/2 rounded-full bg-gradient-to-r from-brand-accent/70 to-transparent opacity-20 blur-3xl bottom-0 -right-1/4"></div>
        <x-layout.container class="py-24 sm:py-32">
            <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl">
                    Season Leaders
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-400">
                    The titans of the season, dominating the charts.
                </p>
            </div>

            {{-- Redesigned "Data Terminal" Cards --}}
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- Card 1: Most Assists --}}
                <div class="relative isolate flex flex-col justify-between rounded-2xl bg-black p-6 ring-1 ring-white/10 overflow-hidden">
                    {{-- Background Watermark Stat --}}
                    <div class="absolute -bottom-8 -right-4 text-[10rem] font-black text-white/5 tabular-nums leading-none">
                        {{ $highestAssister->assists }}
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold leading-7 text-brand-accent">Most Assists</h3>
                        <div class="mt-4 flex items-center gap-x-4">
                            {{-- Player Image with "Scanner" Ring --}}
                            <div class="relative h-16 w-16 flex-none">
                                <div class="absolute inset-0 rounded-full ring-1 ring-inset ring-white/10"></div>
                                <div class="absolute inset-2 rounded-full ring-1 ring-inset ring-white/10"></div>
                                <img src="{{ $highestAssister->player->detail->photo }}" alt="{{ $highestAssister->player->first_name }}" class="h-full w-full rounded-full object-cover">
                            </div>
                            <div>
                                <div class="text-base font-semibold leading-6 text-white">{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }}</div>
                                <p class="text-sm text-gray-400">{{ $highestAssister->player->detail->team->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-white/10 pt-4">
                        <p class="text-3xl font-bold tracking-tight text-white">{{ $highestAssister->assists }} <span class="text-base font-normal text-gray-400">Total Assists</span></p>
                    </div>
                </div>


                {{-- Card 2: Golden Boot (Most Goals) - The "Star" Card --}}
                <div class="relative isolate flex flex-col justify-between rounded-2xl bg-brand-accent/10 p-6 ring-2 ring-brand-accent overflow-hidden">
                    {{-- Background Watermark Stat --}}
                    <div class="absolute -bottom-8 -right-4 text-[10rem] font-black text-brand-accent/10 tabular-nums leading-none">
                        {{ $highestGoalScorer->goals_scored }}
                    </div>
                    {{-- Corner Badge --}}
                    <div class="absolute top-0 right-0 p-3">
                        <span class="inline-flex items-center rounded-md bg-brand-accent/10 px-2 py-1 text-xs font-medium uppercase text-brand-accent ring-1 ring-inset ring-brand-accent/20">
                            Golden Boot
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold leading-7 text-brand-accent">Most Goals</h3>
                        <div class="mt-4 flex items-center gap-x-4">
                            {{-- Player Image with "Scanner" Ring --}}
                            <div class="relative h-16 w-16 flex-none">
                                <div class="absolute inset-0 rounded-full ring-1 ring-inset ring-brand-accent/20"></div>
                                <div class="absolute inset-2 rounded-full ring-1 ring-inset ring-brand-accent/20"></div>
                                <img src="{{ $highestGoalScorer->player->detail->photo }}" alt="{{ $highestGoalScorer->player->first_name }}" class="h-full w-full rounded-full object-cover">
                            </div>
                            <div>
                                <div class="text-base font-semibold leading-6 text-white">{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }}</div>
                                <p class="text-sm text-gray-400">{{ $highestGoalScorer->player->detail->team->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-brand-accent/20 pt-4">
                        <p class="text-3xl font-bold tracking-tight text-white">{{ $highestGoalScorer->goals_scored }} <span class="text-base font-normal text-gray-400">Goals Scored</span></p>
                    </div>
                </div>


                {{-- Card 3: Most Clean Sheets --}}
                <div class="relative isolate flex flex-col justify-between rounded-2xl bg-black p-6 ring-1 ring-white/10 overflow-hidden">
                    {{-- Background Watermark Stat --}}
                    <div class="absolute -bottom-8 -right-4 text-[10rem] font-black text-white/5 tabular-nums leading-none">
                        {{ $highestCleanSheets->clean_sheets }}
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold leading-7 text-brand-accent">Most Clean Sheets</h3>
                        <div class="mt-4 flex items-center gap-x-4">
                            {{-- Player Image with "Scanner" Ring --}}
                            <div class="relative h-16 w-16 flex-none">
                                <div class="absolute inset-0 rounded-full ring-1 ring-inset ring-white/10"></div>
                                <div class="absolute inset-2 rounded-full ring-1 ring-inset ring-white/10"></div>
                                <img src="{{ $highestCleanSheets->player->detail->photo }}" alt="{{ $highestCleanSheets->player->first_name }}" class="h-full w-full rounded-full object-cover">
                            </div>
                            <div>
                                <div class="text-base font-semibold leading-6 text-white">{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }}</div>
                                <p class="text-sm text-gray-400">{{ $highestCleanSheets->player->detail->team->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-white/10 pt-4">
                        <p class="text-3xl font-bold tracking-tight text-white">{{ $highestCleanSheets->clean_sheets }} <span class="text-base font-normal text-gray-400">Clean Sheets</span></p>
                    </div>
                </div>

            </div>
        </x-layout.container>

    </div>


    <div class="bg-black">
        <x-layout.container class="py-24 sm:py-32">
            <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl">
                    Performance Analytics
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-400">
                    Diving deep into the underlying performance metrics.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @php
                    $chartCardClasses = "p-6 bg-black ring-1 ring-inset ring-white/10 rounded-lg shadow-lg";
                @endphp

                <div class="{{ $chartCardClasses }}">
                    <h3 class="font-semibold text-white">Expected Goals (xG)</h3>
                    <div id="xg-chart" class="mt-4"></div>
                </div>
                <div class="{{ $chartCardClasses }}">
                    <h3 class="font-semibold text-white">Expected Assists (xA)</h3>
                    <div id="xa-chart" class="mt-4"></div>
                </div>
                <div class="{{ $chartCardClasses }}">
                    <h3 class="font-semibold text-white">Expected Goal Involvements (xGI)</h3>
                    <div id="gi-chart" class="mt-4"></div>
                </div>
            </div>
        </x-layout.container>
    </div>


    {{--
        Latest Intelligence Section - Updated with Green Dots of Mist

        - Added the same "dots of mist" effect for a cohesive page design.
        - Updated the background to solid black to match the other sections.
        - Harmonized the article hover-effect and button colors to use the 'brand-accent'.
    --}}
    <div class="relative isolate bg-black">

        <div class="absolute -z-10 h-[25rem] w-[25rem] -translate-y-1/2 rounded-full bg-gradient-to-r from-brand-accent to-transparent opacity-15 blur-3xl top-1/4 -left-20"></div>
        <div class="absolute -z-10 h-[30rem] w-[30rem] translate-y-1/2 rounded-full bg-gradient-to-r from-brand-accent to-transparent opacity-10 blur-3xl bottom-0 -right-20"></div>
        <x-layout.container class="py-24 sm:py-32">
            <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl">
                    Latest Intelligence
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-400">
                    The latest news and updates from around the league.
                </p>
            </div>

            {{-- Redesigned "Split-View" Blog Cards --}}
            <x-blog.container>
                @foreach ($recentNews as $post)
                    <article class="group relative flex flex-col overflow-hidden rounded-xl bg-black ring-1 ring-inset ring-white/10 md:flex-row">
                        
                        {{-- Image Panel (Left Side) --}}
                        <div class="relative w-full md:w-2/5">
                            <img src="{!! $post->images[0]->link !!}" alt="" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            {{-- Decorative accent line --}}
                            <div class="absolute right-0 top-0 h-full w-px bg-gradient-to-b from-transparent via-brand-accent/50 to-transparent transition-opacity duration-500 group-hover:opacity-0"></div>
                        </div>

                        {{-- Content Panel (Right Side) --}}
                        <div class="relative flex w-full flex-col p-6 md:w-3/5">
                            <div class="flex-1">
                                {{-- Date/Meta Info --}}
                                <div class="text-sm font-semibold text-gray-400">
                                    <time datetime="{{ $post->created_at->toDateTimeString() }}">{{ $post->created_at->format('M d, Y') }}</time>
                                </div>

                                {{-- Headline --}}
                                <h3 class="mt-2 text-lg font-semibold leading-6 text-white">
                                    <a href="{!! $post->link !!}">
                                        <span class="absolute inset-0 z-10 md:left-auto md:w-3/5"></span>
                                        {!! $post->headline !!}
                                    </a>
                                </h3>

                                {{-- Description --}}
                                <p class="mt-4 line-clamp-2 text-sm leading-6 text-gray-400">{!! $post->description !!}</p>
                            </div>
                            
                            {{-- "Read More" CTA --}}
                            <div class="mt-6 flex-none">
                                  <p class="text-sm font-semibold text-brand-accent">
                                    Read More <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1 inline-block">&rarr;</span>
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </x-blog.container>



            <div class="mt-16 text-center">
                {{-- Updated button colors to brand-accent --}}
                <a href="{{ route('news.view') }}" class="rounded-md bg-brand-accent px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-accent transition-all">
                    View All News
                </a>
            </div>
        </x-layout.container>
    </div>


    <div class="bg-black">
        <x-layout.container class="py-24 sm:py-32">
             <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl">
                    Gameweek {{ $gameweek->id }} Dream Team
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-400">
                    The absolute elite performers from the current gameweek.
                </p>
            </div>

            {{-- Redesigned "Holographic Player Card" Dream Team Cards --}}
            <x-layout.gameweek.grid>
                @foreach ($dreamTeam as $player)
                    <div class="group relative aspect-[3/4] overflow-hidden rounded-xl bg-black ring-1 ring-inset ring-white/10 transition-shadow duration-300 hover:shadow-2xl hover:shadow-brand-accent/20">
                        {{-- Background Elements --}}
                        <div class="absolute inset-0 z-0 opacity-50 [mask-image:radial-gradient(ellipse_at_center,black_40%,transparent_80%)]">
                            <div class="absolute inset-0 bg-brand-accent/10 transition-transform duration-500 group-hover:scale-110"></div>
                        </div>

                        {{-- Card Content --}}
                        <div class="relative z-10 flex h-full flex-col p-6">
                            {{-- Top Section: Player Info --}}
                            <div class="flex-none">
                                <h3 class="font-bold text-white text-lg">{!! $player->player->first_name !!} {!! $player->player->second_name !!}</h3>
                                <p class="text-sm text-gray-400">{!! $player->player->detail->team->name !!}</p>
                            </div>

                            {{-- Middle Section: Holographic Player Image --}}
                            <div class="relative flex-1">
                                <img src="{{ $player->player->detail->photo }}" alt="{!! $player->player->first_name !!}" class="absolute inset-0 h-full w-full object-contain [mask-image:linear-gradient(black_60%,transparent)] transition-transform duration-500 group-hover:scale-105">
                            </div>

                            {{-- Bottom Section: Points --}}
                            <div class="flex-none border-t border-white/10 pt-4 text-center">
                                <p class="text-xs font-semibold text-brand-accent">POINTS</p>
                                <p class="text-5xl font-black tracking-tight text-white tabular-nums">{{ $player->points }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-layout.gameweek.grid>


        </x-layout.container>
    </div>

    <footer class="bg-black border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <h3 class="text-2xl font-bold text-white">MyFPL</h3>
                    <p class="text-sm leading-6 text-gray-300">The ultimate companion for your fantasy football season.</p>
                </div>
            </div>
            <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-400">&copy; {{ date('Y') }} MyFPL, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

</div>

{{--
    IMPORTANT: For the charts to look good on a dark theme,
    you must configure ApexCharts with a dark theme option in your controller.
--}}
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
