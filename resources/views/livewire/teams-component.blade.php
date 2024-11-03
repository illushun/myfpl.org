<div>


<x-collection.filtering.container title="Teams" subheading="Current Premier League {{ date('Y') }} Team List">

    @include('livewire.teams.components.filters')

    @foreach ($teams as $team)

        <x-collection.item
            title="{!! $team->name !!}"
            image="https://resources.premierleague.com/premierleague/badges/70/t{{ $team->code }}.png"
            position="{{ $team->id }}"
            strength="{{ $team->strength }}" />

    @endforeach

</x-collection.filtering.container>

{{ $teams->links() }}

</div>
