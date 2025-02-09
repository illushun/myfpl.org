<div>

    <x-blog.container class="mt-12">

        <div>
            <h6>Most Goals</h6>
            <div id="goal-scorers-chart"></div>
        </div>

        <div>
            <h6>Most Assists</h6>
            <div id="assisters-chart"></div>
        </div>

        <div>
            <h6>Most Saves</h6>
            <div id="saves-chart"></div>
        </div>

    </x-blog.container>

</div>

<script>
    new ApexCharts(document.querySelector("#goal-scorers-chart"), {
        {!! $gs_chart !!}
    }).render();

    new ApexCharts(document.querySelector("#assisters-chart"), {
        {!! $as_chart !!}
    }).render();

    new ApexCharts(document.querySelector("#saves-chart"), {
        {!! $saves_chart !!}
    }).render();
</script>
