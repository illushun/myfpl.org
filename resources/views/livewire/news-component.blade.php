<div>

    <x-blog.container title="League News" subheading="The latest news of the season">

        @foreach ($league_news as $post)

            <x-blog.item
                title="{!! $post->headline !!}"
                description="{!! $post->description !!}"
                image="{!! $post->images[0]->link !!}"
                date="{{ date('D d M Y - H:i:s', strtotime($post->created_at)) }}"
                link="{!! $post->link !!}"
                alt="" />

        @endforeach

    </x-blog.container>

    {{ $league_news->links() }}

</div>
