<div>
    {{-- The large landing section from your original design --}}
    <x-large-landing />

    {{-- New "Top Performers" Section --}}
    <div class="bg-gray-900 py-20">
        <x-layout.container>
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Season Leaders
                </h2>
                <p class="mt-4 text-lg text-gray-400">
                    The top performers in the Premier League so far.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Most Goals Card --}}
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <img class="h-24 w-24 rounded-full object-cover" src="{{ $highestGoalScorer->player->detail->photo }}" alt="{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }}">
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-white">Most Goals</h3>
                                <p class="text-3xl font-bold text-green-400">{{ $highestGoalScorer->goals_scored }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-lg font-semibold text-white">{{ $highestGoalScorer->player->first_name }} {{ $highestGoalScorer->player->second_name }}</p>
                            <p class="text-md text-gray-400">{{ $highestGoalScorer->player->detail->team->name }}</p>
                            <p class="text-sm text-gray-500">{{ $highestGoalScorer->player->role->singular_name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Most Assists Card --}}
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <img class="h-24 w-24 rounded-full object-cover" src="{{ $highestAssister->player->detail->photo }}" alt="{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }}">
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-white">Most Assists</h3>
                                <p class="text-3xl font-bold text-blue-400">{{ $highestAssister->assists }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-lg font-semibold text-white">{{ $highestAssister->player->first_name }} {{ $highestAssister->player->second_name }}</p>
                            <p class="text-md text-gray-400">{{ $highestAssister->player->detail->team->name }}</p>
                            <p class="text-sm text-gray-500">{{ $highestAssister->player->role->singular_name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Most Clean Sheets Card --}}
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <img class="h-24 w-24 rounded-full object-cover" src="{{ $highestCleanSheets->player->detail->photo }}" alt="{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }}">
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-white">Most Clean Sheets</h3>
                                <p class="text-3xl font-bold text-purple-400">{{ $highestCleanSheets->clean_sheets }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-lg font-semibold text-white">{{ $highestCleanSheets->player->first_name }} {{ $highestCleanSheets->player->second_name }}</p>
                            <p class="text-md text-gray-400">{{ $highestCleanSheets->player->detail->team->name }}</p>
                            <p class="text-sm text-gray-500">{{ $highestCleanSheets->player->role->singular_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-layout.container>
    </div>

    {{-- "Expected Performers" Section with Tabs --}}
    <div class="bg-gray-900 py-20" x-data="{ tab: 'xg' }">
        <x-layout.container>
            <x-layout.container.title title="Expected Performers"
                                        subtitle="Highest expected performing players of the season" />

            <div class="mt-8">
                <div class="flex justify-center border-b border-gray-700">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a href="#" @click.prevent="tab = 'xg'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'xg', 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500': tab !== 'xg' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Expected Goals (xG)
                        </a>
                        <a href="#" @click.prevent="tab = 'xa'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'xa', 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500': tab !== 'xa' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Expected Assists (xA)
                        </a>
                        <a href="#" @click.prevent="tab = 'gi'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'gi', 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500': tab !== 'gi' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Goal Involvements (xGI)
                        </a>
                    </nav>
                </div>
            </div>

            <div class="mt-8">
                <div x-show="tab === 'xg'">
                    <div id="xg-chart"></div>
                </div>
                <div x-show="tab === 'xa'">
                    <div id="xa-chart"></div>
                </div>
                <div x-show="tab === 'gi'">
                    <div id="gi-chart"></div>
                </div>
            </div>
        </x-layout.container>
    </div>

    {{-- Combined "Dream Team" and "News" Section --}}
    <div class="bg-gray-900 py-20">
        <x-layout.container>
            <div class="grid lg:grid-cols-3 gap-12">
                {{-- Dream Team --}}
                <div class="lg:col-span-2">
                    <x-layout.container.title title="Gameweek {{ $gameweek->id }} Dream Team"
                                                subtitle="The most in-form players from the current gameweek" />

                    <div class="mt-8 grid gap-8 sm:grid-cols-2">
                        @foreach ($dreamTeam as $player)
                            <x-layout.gameweek.item
                                title="{!! $player->player->first_name !!} {!! $player->player->second_name !!}"
                                subheading="{!! $player->player->detail->team->name !!}"
                                points="{{ $player->points }}"
                                image="{{ $player->player->detail->photo }}" />
                        @endforeach
                    </div>
                </div>

                {{-- Recent News --}}
                <div class="lg:col-span-1">
                    <x-layout.container.title title="Recent News"
                                                subtitle="The latest news regarding players" />
                    <div class="mt-8 space-y-6">
                        @foreach ($recentNews as $post)
                            <x-blog.item
                                title="{!! $post->headline !!}"
                                description="{!! $post->description !!}"
                                image="{!! $post->images[0]->link !!}"
                                date="{{ date('D d M Y - H:i:s', strtotime($post->created_at)) }}"
                                link="{!! $post->link !!}"
                                alt="" />
                        @endforeach
                    </div>
                    <div class="mt-8">
                         <x-button.outline-rounded-link-icon text="View All"
                                                            link="{{ route('news.view') }}" />
                    </div>
                </div>
            </div>
        </x-layout.container>
    </div>

    {{-- New Footer --}}
    <footer class="bg-gray-800 text-gray-400">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img class="h-10" src="https://assets.website-files.com/6458c625291a94a195e6cf3a/6458c625291a94d6f4e6cf96_Group%2047874-3.png" alt="Company name">
                    <p class="text-gray-400 text-base">
                        A clean, intuitive and data-driven UI for the Fantasy Premier League.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase">Solutions</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Player Stats</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Team Stats</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Live Scores</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase">Support</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Pricing</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Docs</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">API Status</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase">Company</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">About</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Blog</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Jobs</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase">Legal</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Claim</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Privacy</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 xl:text-center">&copy; {{ date('Y') }} myfpl.org. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new ApexCharts(document.querySelector("#xg-chart"), {
            {!! $xg_chart !!}
        }).render();

        new ApexCharts(document.querySelector("#xa-chart"), {
            {!! $xa_chart !!}
        }).render();

        new ApexCharts(document.querySelector("#gi-chart"), {
            {!! $gi_chart !!}
        }).render();
    });
</script>