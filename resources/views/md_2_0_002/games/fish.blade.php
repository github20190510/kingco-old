<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_fish"></div>
        </div>
        <div class="container main" id="fish_game_list">
            <div id="fish-btn" class="fish-btn" ><a href="{{ action('Game_Controller@into_game', ['gid'=>'SAGame', 'gtype'=>'FishermenGold']) }}" ref="fish_game" target="_blank"></a></div>
            <div id="gg-btn" class="gg-btn"><a href="{{ action('Game_Controller@into_game', ['gid'=>'TCGGGame', 'gtype'=>'G00009']) }}" target="_blank"></a></div>
        </div>
        @include($footer_name)
        <div id="affixBox" class="affix-module text-white">
            <div class="aff-inner">
                <div class="boxes register"><a href='{{ url('mb/register') }}'> </a></div>
                <div class="boxes service"><a href=""></a></div>
                <div class="boxes app"><a href="" target="_blank"></a></div>
                <div class="affix-close"></div>
            </div>
        </div>
    </body>
    <script>
        var app = new Vue({
            el : '#fish_game_list',
        });
    </script>
</html>
