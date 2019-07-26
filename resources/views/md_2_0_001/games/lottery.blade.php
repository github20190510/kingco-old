<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_lottery"></div>
        </div>
        <div class="container main" id="game_list">            
            <div id="lottery_818" class="lottery-ad lottery_818" @click="chk_game_login('818Game_CP')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'818Game', 'gtype'=>'CP']) }}" ref="818Game_CP" target="_blank"></a></div>
            <div id="lottery_vr" class="lottery-ad lottery_vr" @click="chk_game_login('VRGame_CP')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'VRGame', 'gtype'=>'CP']) }}" ref="VRGame_CP" target="_blank"><!--VR--></a></div>
            <div id="lottery_lixin" class="lottery-ad lottery_lixin" @click="chk_game_login('LXGame_CP')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'LXGame', 'gtype'=>'CP']) }}" ref="LXGame_CP" target="_blank"><!--利鑫--></a></div>
            <!-- <div id="lottery_sg" class="lottery-ad lottery_sg" @click="chk_game_login('SGGame_CP')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'SGGame', 'gtype'=>'CP']) }}" ref="SGGame_CP" target="_blank"></a></div> --><!--SG-->
            <div id="lottery_idc" class="lottery-ad lottery_idc" @click="chk_game_login('IDCGame_CP')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'IDCGame', 'gtype'=>'CP']) }}" ref="IDCGame_CP" target="_blank"><!--IDC--></a></div>
            <div id="lottery_tcg" class="lottery-ad lottery_tcg" style="display:none"><a href=""><!--天天彩--></a></div>
            <!--<div lottery_tcg class="lottery_tcg" @click="chk_game_login('CQ9Game_1')"><a href="{{ action('Game_Controller@into_game', ['gid'=>'CQ9Game', 'gtype'=>'1']) }}" ref="CQ9Game_1" target="_blank"></a></div>-->
        </div>
        @include($footer_name)
    </body>
    <script>
        var app = new Vue({
            el : '#game_list',
        });
    </script>
</html>
