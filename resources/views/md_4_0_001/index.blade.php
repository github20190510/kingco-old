<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <script type="text/javascript">
        $(function(){
             $('.coverflow').css('max-width',$('.coverflow img').width());
        });

        $('.carousel').carousel({
            interval: 2000
        });
    </script>
    <body class="INDEX">
        <div class="header-area m-auto">
            @include($head_name)        
        <!--Main Start-->
        <!--跑馬燈-->
        <div class="notice-module d-flex align-items-center m-auto" id="notic_bar">
            <span class="mr-2"><i class="fas fa-volume-up text-white fa-lg"></i></span>
            <marquee class="marquee m-0">
                <a v-for="(notice,index) in notic_data">
                    @{{index+1}}.@{{ notice.content }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </a>
            </marquee>
        </div>        
        <!--Slots Start-->
        <div class="main game-module" id="index_data">
            
            <div class="content">
                <div class="games cardgame animated bounce" title="{{ __('msg_dt_1.cardgame2') }}" @click="into_game_card"></div>
                <div class="games sport animated heartBeat" title="{{ __('msg_dt_1.sport') . __('msg_dt_1.betting') }}" @click="into_game_sport"></div>
                <div class="games casino animated jello" title="{{ __('msg_dt_1.real_casino') }}" @click="into_game_casino"></div>
                <div class="games fishing animated tada" title="{{ __('msg_dt_1.fishing') . __('msg_dt_1.zone') }}" @click="into_game_fish"></div>
                <div class="games lottery animated jello" title="{{ __('msg_dt_1.lottery') . __('msg_dt_1.zone') }}" @click="into_game_lottery"></div>
                <div class="games movie animated jello" title="{{ __('msg_dt_1.movie_link') }}" @click="into_movie_act"></div>
                <div class="games slots animated rubberBand" title="{{ __('msg_dt_1.slots2') }}" @click="into_game_cq9"></div>
            </div>
        </div>
        <!--Main End-->
        @include($footer_name)
        <!--<div id="affixBox" class="affix-module text-white" v-if="show_box === 1">
            <div class="aff-inner">
                <div class="boxes register"><a href='{{ url('mb/register') }}'></a></div>
                <div class="boxes service"><a href=""></a></div>
                <div class="boxes app"><a href="" target="_blank"></a></div>
                <div class="affix-close" @click="close_box"></div>
            </div>
        </div>-->
        </div>
    </body>
    <script>
        var app = new Vue({
            el : '#index_data',
            data : {
                img1_isShow : 1,
                img2_isShow : 0,
                img3_isShow : 0,
                currentView : 'comCQ9',
                gameCQ9_active : 1,
                game818_active : 0,
                notic_data : '',
                show_box : 1
            },
            created: function(){

            },
            methods: {
                
                into_game_list: function(gtype){

                    location.href = "/game/" + gtype;

                },
                into_game_lottery: function(){

                    location.href = "/game/lottery";

                },
                into_game_casino: function(){

                    location.href = "/game/casino";

                },
                into_game_sport: function(){

                    location.href = "/game/sport";

                },
                into_game_fish: function(){

                    location.href = "/game/fish";

                },
                into_game_cq9: function(){

                    location.href = "/game/cq9list";

                },
                into_game_card: function(){

                    location.href = "/game/card";

                },
                into_movie_act: function(){

                    document.getElementById('movie').click();

                },
                show_img1: function(){

                    this.img1_isShow = 1;
                    this.img2_isShow = 0;
                    this.img3_isShow = 0;

                },
                show_img2: function(){

                    this.img1_isShow = 0;
                    this.img2_isShow = 1;
                    this.img3_isShow = 0;

                },
                show_img3: function(){

                    this.img1_isShow = 0;
                    this.img2_isShow = 0;
                    this.img3_isShow = 1;

                },
                show_game: function(com_name){

                    this.currentView = com_name;
                    switch(com_name){
                        case 'comCQ9':
                            this.gameCQ9_active = 1;
                            this.game818_active = 0;
                        break;
                        case 'com818':
                            this.gameCQ9_active = 0;
                            this.game818_active = 1;
                        break;
                    }

                },
                
            }
        });

        var affixBox = new Vue({
            el: '#affixBox',
            data:{
                show_box: 1
            },
            methods: {
                close_box: function(){
                    this.show_box = 0;
                }
            }
        });
    </script>
</html>
