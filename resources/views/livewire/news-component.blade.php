<div>

    <x-blog.container title="News" subheading="The latest player news of the season">

        @foreach ($news as $new)

            <x-blog.item
                title="{{ $new->player->first_name }} {{ $new->player->second_name }}"
                description="{{ $new->news }}"
                image="https://resources.premierleague.com/premierleague/photos/players/110x140/p{{ $new->player->code }}.png"
                date="{{ date('D d M Y', strtotime($new->created_at)) }}"
                link="" />

        @endforeach

    </x-blog.container>

    {{ $news->links() }}

</div>