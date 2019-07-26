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
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="carouselExampleIndicators" class="carousel slide coverflow" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <!-- <li data-target="#carouselExampleIndicators" data-slide-to="3"></li> -->
                <!--<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>-->
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item header-carousel-item carousel-1 active"></div>
                <!-- <div class="carousel-item header-carousel-item carousel-2"></div> -->
                <div class="carousel-item header-carousel-item carousel-3"></div>
                <div class="carousel-item header-carousel-item carousel-4"></div>
                <!-- <div class="carousel-item header-carousel-item carousel-5"></div> -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--Main Start-->
        <div class="container sun_firstPanel" id="index_data">
            
            <div class="content">
                <div class="notice-module d-flex align-items-center">
					<span class="mr-2"><i class="fas fa-volume-up text-gold"></i> {{ __('msg_dt_1.latest_news') }}</span>
                    <marquee class="marquee m-0">
                        <a v-for="(notice,index) in notic_data">
                            @{{index+1}}.@{{ notice.content }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                        </a>
                    </marquee>
                </div>
            </div>
            <!--Slots Start-->
            <div class="game-module-tab2">
                <div class="content">
                    <!--Game carousel Start-->
                    <section id="game-menu" class="game-menu">
                        <div class="row">
                            <div class="col columns">
                                <ul class="owl-carousel owl-theme" >
                                    <li v-for="v in platform" class="item" :class="v['class_name']" @click="goto_game(v['act_name'])"></li>
                                    <!--<li class="item item-2" @mouseover="show_game('com818')" @click="goto_game('com818')">--><!--PT電子--><!--</li>-->
                                    <!--<li class="item item-3">--><!--AG電子--><!--</li>-->
                                    <!--<li class="item item-4">--><!--BBIN電子--><!--</li>-->
                                    <!--<li class="item item-5">--><!--QT電子--><!--</li>-->
                                    <!--<li class="item item-7">--><!--AB電子--><!--</li>-->
                                    <!--<li class="item item-9">--><!--IM--><!--</li>-->
                                    <!--<li class="item item-10">--><!--MG--><!--</li>-->
                                    <!--<li class="item item-11">--><!--YP--><!--</li>-->
                                    <!--<li class="item item-13">--><!--SG--><!--</li>-->
                                </ul>
                            </div>
                        </div>
                    </section>
                    <!--Game carousl End-->
                    <div class="game-container d-flex">
                        <div class="disInline adBox" @click="into_game_fish"></div>
                        <div class="disInline gameList">
                            <my-component :is="currentView"></my-component>
                        </div>
                        <!--<div class="disInline prize">
                            <div class="prize-module ">
                                <div class="p-content">
                                    <div class="top">
                                        <div class="jackPot">
                                            <h3>{{ __('msg_dt_1.jack_pot_desc') }}</h3>
                                            <p id="num">8790558</p>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <div class="title">{{ __('msg_dt_1.game_msater') }}</div>
                                        <div class="winner run">
                                            <ul>
                                                <li style="height: 22px;"><span class="user">bc***sf</span><span class="game">辛巴达金航记</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">r3***x</span><span class="game">狂暴4</span><span class="money">32000元</span></li>
                                                <li style="height: 22px;"><span class="user">ro***35</span><span class="game">辛巴达金航记</span><span class="money">78000元</span></li>
                                                <li style="height: 22px;"><span class="user">werwt***d</span><span class="game">众神时代</span><span class="money">11000元</span></li>
                                                <li style="height: 22px;"><span class="user">s9q***m</span><span class="game">不朽情缘</span><span class="money">46000元</span></li>
                                                <li style="height: 22px;"><span class="user">syr***o</span><span class="game">糖果派对</span><span class="money">66000元</span></li>
                                                <li style="height: 22px;"><span class="user">zuje***w</span><span class="game">狂暴4</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">iog***s</span><span class="game">万圣节财富</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">bdw***k</span><span class="game">众神时代</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">jk***13</span><span class="game">不朽情缘</span><span class="money">32000元</span></li>
                                                <li style="height: 22px;"><span class="user">oc***1235</span><span class="game">糖果派对</span><span class="money">78000元</span></li>
                                                <li style="height: 22px;"><span class="user">wer***d</span><span class="game">狂暴4</span><span class="money">11000元</span></li>
                                                <li style="height: 22px;"><span class="user">hl***mw</span><span class="game">擺脫</span><span class="money">46000元</span></li>
                                                <li style="height: 22px;"><span class="user">ie***xw</span><span class="game">万圣节财富</span><span class="money">66000元</span></li>
                                                <li style="height: 22px;"><span class="user">vuy***xd</span><span class="game">众神时代</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">adv***86</span><span class="game">狂欢节</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">ssy***it4</span><span class="game">万圣节财富</span><span class="money">45000元</span></li>
                                                <li style="height: 22px;"><span class="user">sef***f34</span><span class="game">狂暴4</span><span class="money">32000元</span></li>
                                                <li style="height: 22px;"><span class="user">mtw***1235</span><span class="game">糖果派对</span><span class="money">78000元</span></li>
                                                <li style="height: 22px;"><span class="user">w***d</span><span class="game">众神时代</span><span class="money">11000元</span></li>
                                                <li style="height: 22px;"><span class="user">e***5</span><span class="game">擺脫</span><span class="money">46000元</span></li>
                                                <li style="height: 22px;"><span class="user">efdw***xs</span><span class="game">糖果派对</span><span class="money">66000元</span></li>
                                                <li style="height: 22px;"><span class="user">sfes***987</span><span class="game">狂暴4</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">bc***sf</span><span class="game">辛巴达金航记</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">r3***x</span><span class="game">狂暴4</span><span class="money">32000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">ro***35</span><span class="game">辛巴达金航记</span><span class="money">78000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">werwt***d</span><span class="game">众神时代</span><span class="money">11000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">s9q***m</span><span class="game">不朽情缘</span><span class="money">46000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">syr***o</span><span class="game">糖果派对</span><span class="money">66000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">zuje***w</span><span class="game">狂暴4</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">iog***s</span><span class="game">万圣节财富</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">bdw***k</span><span class="game">众神时代</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">jk***13</span><span class="game">不朽情缘</span><span class="money">32000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">oc***1235</span><span class="game">糖果派对</span><span class="money">78000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">wer***d</span><span class="game">狂暴4</span><span class="money">11000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">hl***mw</span><span class="game">擺脫</span><span class="money">46000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">ie***xw</span><span class="game">万圣节财富</span><span class="money">66000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">vuy***xd</span><span class="game">众神时代</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">adv***86</span><span class="game">狂欢节</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">ssy***it4</span><span class="game">万圣节财富</span><span class="money">45000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">sef***f34</span><span class="game">狂暴4</span><span class="money">32000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">mtw***1235</span><span class="game">糖果派对</span><span class="money">78000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">w***d</span><span class="game">众神时代</span><span class="money">11000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">e***5</span><span class="game">擺脫</span><span class="money">46000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">efdw***xs</span><span class="game">糖果派对</span><span class="money">66000元</span></li>
                                                <li class="clone" style="height: 22px;"><span class="user">sfes***987</span><span class="game">狂暴4</span><span class="money">45000元</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="more">
                        <div class="text">{{ __('msg_dt_1.index_desc') }}</div>
                        <div class="btn m-btn" @click="into_game_list('cq9list')">MORE GAME++</div>
                    </div>
                </div>
            </div>
            <!--Slots End-->
            <!--Sport Start-->
            <div class="content2 mt-2">
                <div class="main">
                    <!--<h2 class="slogan">塑造完美娱乐 让您钱程无忧</h2>-->
                    <div class="kind">
                        <div class="kind-item sport" @mouseover="show_img1()" @click="into_game_sport"></a></div>
                        <div class="kind-item casino" @mouseover="show_img2()" @click="into_game_casino"> </div>
                        <div class="kind-item bingo now" @click="into_game_lottery" @mouseover="show_img3()"> </div>
                    </div>
                    <!--此處顯示由程式控制-->
                    <div class="games">
                        <h2 class="title">{{ __('msg_dt_1.hot_game') }} | HOT GAMES</h2>
                        <div class="items">
                            <div class="items s-item" v-if="img1_isShow === 1" @click="into_game_sport"></div>
                            <div class="items c-item" v-if="img2_isShow === 1" @click="into_game_casino"></div>
                            <div class="items b-item" v-if="img3_isShow === 1" @click="into_game_lottery"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Sport End-->
        </div>
        <!--Main End-->
        
        @include($footer_name)
        <!-- 舊客服 -->
        <!-- <div id="affixBox" class="affix-module text-white" v-if="show_box === 1">
            <div class="aff-inner">
                <div class="boxes register"><a href='{{ url('mb/register') }}'></a></div>
                <div class="boxes service"><a href=""></a></div>
                <div class="boxes app"><a href="" target="_blank"></a></div>
                <div class="affix-close" @click="close_box"></div>
            </div>
        </div> -->
        <!-- 舊客服 -->
    </body>
    <script>

        var app = new Vue({
            el : '#index_data',
            components: {
                comCQ9 : {
                    template: '<ul class="ag-tab d-flex flex-wrap justify-content-between">' +
                        '<li><a href="/game/intogame/CQ9Game/1" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/1.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">亚瑟王</span><span class="game-hot">人气：58547</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/7" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/7.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">爱丽丝大冒险</span><span class="game-hot">人气：86514</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/16" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/16.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">战火风云</span><span class="game-hot">人气：52547</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/18" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/18.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">疯狂德州</span><span class="game-hot">人气：44514</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/2" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/2.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">亚瑟王</span><span class="game-hot">人气：58547</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/3" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/3.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">爱丽丝大冒险</span><span class="game-hot">人气：86514</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/4" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/4.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">战火风云</span><span class="game-hot">人气：52547</span></div>' +
                        '</a></li>' +
                        '<li><a href="/game/intogame/CQ9Game/5" target="_blank">' +
                            '<div class="pic" style="background-image: url({{asset("css/game_img/pc/cq9/$lang/5.jpg")}};"></div>' +
                            //'<div class="box"></div>' +
                            //'<div class="txt"><span class="game-txt">疯狂德州</span><span class="game-hot">人气：44514</span></div>' +
                        '</a></li>' +
                       '</ul>'
                },
                /*com818 : {
                    template: '<ul class="lottery-tab d-flex flex-wrap justify-content-between">' +
                                '<li><a href="/game/lottery" target="_blank">' +
                                '<div class="pic"></div>' +
                                '<div class="box"></div>' +
                                '<div class="txt"><span class="game-txt">818</span><span class="game-hot"><!--人气：68547--></span></div>' +
                                '</a></li>' +
                            '</ul>'
                }*/
            },
            data : {
                img1_isShow : 1,
                img2_isShow : 0,
                img3_isShow : 0,
                currentView : 'comCQ9',
                gameCQ9_active : 1,
                game818_active : 0,
                notic_data : [],
                show_box : 1,
                platform : []
            },
            created: function(){
                this.get_new_notic();
                var self = this;
                $.each(Elec_Platform['original'], function(k, v){
                    if(v['status'] == 1){
                        self.platform.push(v);
                    }
                });
                //因為目前遊戲數量不夠，所以多放一個迴圈讓輪播效果正常
                // $.each(Elec_Platform['original'], function(k, v){
                //     if(v['status'] == 1){
                //         self.platform.push(v);
                //     }
                // });

                var ApiURL = API_Host + '/system/ebankcards';
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                        // console.log(this.json['info']);
                    }else{
                        //self.alertinfo(this.json['info']);
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                
                get_new_notic: function(){

                    var ApiURL = API_Host + '/system/notic/0/99';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length > 0){
                                self.notic_data = this.json['info']; 
                            }
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                }
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
