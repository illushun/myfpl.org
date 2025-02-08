<div>
<div class="max-w-screen-xl mx-auto px-4 md:px-8">

    <div class="items-start justify-between md:flex">
        <div class="max-w-lg">
            <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">Stats</h3>
            <p class="text-gray-400 mt-2">{{ $player->first_name }} {{ $player->second_name }}'s stats each gameweek</p>
        </div>
    </div>
    <div class="mt-12 relative h-max overflow-auto">
        <table class="w-full table-auto text-sm text-left">
            <thead class="text-gray-600 font-medium border-b">
                <tr>
                    <th class="py-3 pr-6"></th>
                    <th class="py-3 pr-6">goals</th>
                    <th class="py-3 pr-6">assists</th>
                    <th class="py-3 pr-6">clean sheets</th>
                    <th class="py-3 pr-6">goals conceeded</th>
                    <th class="py-3 pr-6">own goals</th>
                    <th class="py-3 pr-6">pens missed</th>
                    <th class="py-3 pr-6">pens saved</th>
                    <th class="py-3 pr-6">yellow cards</th>
                    <th class="py-3 pr-6">red cards</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 divide-y">
                @foreach ($player->stats as $stat)
                        <tr>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->gameweek->fpl_id }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->goals_scored }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->assists }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->clean_sheets }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->goals_conceded }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->own_goals }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->penalties_missed }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->penalties_saved }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->yellow_cards }}</td>
                            <td class="pr-6 py-4 whitespace-nowrap">{{ $stat->red_cards }}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
