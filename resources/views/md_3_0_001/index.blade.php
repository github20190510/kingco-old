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
        @include($head_name)        
        <!--Main Start-->
       <div class="main game-module" id="index_data">
            
            <div class="content">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class=" col">
                                <div class="games cardgame" @click="into_game_card">
                                    <span class="sr-only">{{ __('msg_dt_1.cardgame2') . __('msg_dt_1.zone') }}</span>
                                    <span class="games-up"></span>
                                    <span class="games-out"></span>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <div class="games sport" @click="into_game_sport">
                                    <span class="sr-only">{{ __('msg_dt_1.sport') . __('msg_dt_1.betting') }}</span>
                                    <span class="games-up"></span>
                                    <span class="games-out"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                                <div class="games casino" @click="into_game_casino">
                                    <span class="sr-only">{{ __('msg_dt_1.real_casino') }}</span>
                                    <span class="games-up"></span>
                                    <span class="games-out"></span>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <div class="games fishing" @click="into_game_fish">
                                    <span class="sr-only">{{ __('msg_dt_1.fishing') . __('msg_dt_1.zone') }}</span>
                                    <span class="games-up"></span>
                                    <span class="games-out"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                            <div class="games lottery" @click="into_game_lottery">
                                <span class="sr-only">{{ __('msg_dt_1.lottery') . __('msg_dt_1.zone') }}</span>
                                <span class="games-up"></span>
                                <span class="games-out"></span>
                                </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                            <div class="games slots" @click="into_game_cq9">
                                <span class="sr-only">{{ __('msg_dt_1.slots2') }}</span>
                                <span class="games-up"></span>
                                <span class="games-out"></span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
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
