<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>        
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_cardgame"></div>
        </div>    
        <div class="main card-main" id="card_game">
            <a :href="game_href" target="_blank" ref="gamelink"></a>
            <div class="content">
                <div id="cardgame-ky" class="cardgame-ky" @click="click_into_prepare" ><a href=""><!--開元--></a></div><!--onclick="location.href='{{ url('game/card_list') }}'" -->
                <div id="cardgame-leg" class="cardgame-leg" onclick="location.href='{{ url('game/card_leg') }}'"><a href=""><!--樂遊--></a></div>
                <div id="cardgame-as" class="cardgame-as" @click="into_game('ASGame', 'SX')"><a href=""><!--AS--></a></div>
                <!--<div id="cardgame-cq9" class="cardgame-cq9" onclick="location.href='{{ url('game/card_list') }}'"><a href="">--><!--CQ9--><!--</a></div>-->
                <!--<div id="cardgame-818" class="cardgame-818"><a href="">--><!--818--><!--</a></div>-->
            </div>
        </div>
        @include($footer_name)
    </body>
     <script>
        var card_game = new Vue({
            el : '#card_game',
            data : {
                game_href : '#'
            },
            methods : {
                click_into_prepare: function(){
                    alert("<?php echo __('msg_dt_1.game_prepare'); ?>");
                }
            }
        });
    </script>
</html>
