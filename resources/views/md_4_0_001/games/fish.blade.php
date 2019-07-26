<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_fish"></div>
        </div>
        <div class="container main" id="fish_game_list">
            <div id="fish-btn" class="fish-btn" @click='click_into_prepare'><!-- <a href="{{ action('Game_Controller@into_game', ['gid'=>'SAGame', 'gtype'=>'FishermenGold']) }}" ref="fish_game" target="_blank"></a> --></div>
            <div id="gg-btn" class="gg-btn" @click='click_into_prepare'><!-- <a href="{{ action('Game_Controller@into_game', ['gid'=>'TCGGGame', 'gtype'=>'G00009']) }}" target="_blank"></a> --></div>
        </div>
        @include($footer_name)
        
    </body>
    <script>
        var app = new Vue({
            el : '#fish_game_list',
            methods : {
                click_into_prepare: function(){
                    alert("<?php echo __('msg_dt_1.game_prepare'); ?>");
                }
            }
        });
    </script>
</html>
