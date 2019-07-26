<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body style="height:100%">
        <header></header>
        @include($head_name)
        <!--輪播 Start-->
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
        </div>
        <!--輪播 End-->
        <!--公告-->
        <div class="notice-module d-flex align-items-center c-black" id="notic">
            <span class="mr-2 msg-icon"></span>
            <marquee class="marquee m-0">
                <a v-for="(notice,index) in notic_data">
                    @{{index+1}}.@{{ notice.content }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                </a>
            </marquee>
        </div>
        <main role="main" class="main container-fluid index-main" id="game_list">
            <a :href="game_href" target="_blank" ref="gamelink"></a>
            <!--真人-->
            <section class="game-casino">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseCasino" aria-expanded="false" aria-controls="collapseCasino" @click="close_all_game('collapseCasino')"></button>
                </div>
                <div class="collapse" id="collapseCasino">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-og" style="display:none"></li>
                        <li class="game-logo logo-ab" style="display:none"></li>
                        <li class="game-logo logo-ag" style="display:none"></li>
                        <li class="game-logo logo-sunbet" style="display:none"></li>
                        <li class="game-logo logo-mg" style="display:none"></li>
                        <li class="game-logo logo-pt" style="display:none"></li>
                        <li class="game-logo logo-bbin" style="display:none"></li>
                        <li class="game-logo logo-bg" style="display:none"></li>
                        <li class="game-logo logo-ebet" style="display:none"></li>
                        <li class="game-logo logo-sa" @click="trans_into_game('SAGame', 'SX')" style="display:none"></li>
                        <li class="game-logo logo-gd" style="display:none"></li>
                        <li class="game-logo logo-dg" style="display:none" @click="trans_into_game('DreamGame', 'SX')"></li>
                        <li class="game-logo logo-rtg" style="display:none"></li>
                        <li class="game-logo logo-n2" @click="trans_into_game('N2Live', 'SX')"></li>
                        <li class="game-logo logo-ibo" @click="trans_into_game('IBOGame', 'SX')"></li>
                        <li class="game-logo logo-wm" @click="trans_into_game('WMGame', 'SX')"></li>
                        <li class="game-logo logo-queenco" @click="trans_into_game('QueencoGame', 'SX')" style="display:none"></li>
                    </ul>
                </div>
            </section>
            <!--彩票-->
            <section class="game-lottery">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseLottery" aria-expanded="false" aria-controls="collapseLottery" @click="close_all_game('collapseLottery')"></button>
                </div>
                <div class="collapse" id="collapseLottery">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-818" @click="trans_into_game('818Game', 'CP')"></li>
                        <li class="game-logo logo-bbin" style="display:none"></li>
                        <li class="game-logo logo-ky" style="display:none"></li>
                        <li class="game-logo logo-ig" style="display:none"></li>
                        <li class="game-logo logo-vr" @click="trans_into_game('VRGame', 'CP')"></li>
                        <li class="game-logo logo-lixin" @click="trans_into_game('LXGame', 'CP')"></li>
                        <!-- <li class="game-logo logo-sgwin" @click="trans_into_game('SGGame', 'CP')"></li> -->
                        <li class="game-logo logo-idc" @click="trans_into_game('IDCGame', 'CP')"></li>
                    </ul>
                </div>
            </section>
             <!--電子-->
            <section class="game-slot">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseSlot" aria-expanded="false" aria-controls="collapseSlot" @click="close_all_game('collapseSlot')"></button>
                </div>
                <div class="collapse" id="collapseSlot">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-cq9" @click="goto_game('comCQ9')"></li>
                        <li class="game-logo logo-pt" style="display:none"></li>
                        <li class="game-logo logo-ag" style="display:none"></li>
                        <li class="game-logo logo-bbin" style="display:none"></li>
                        <li class="game-logo logo-qt" style="display:none"></li>
                        <li class="game-logo logo-pg" @click="goto_game('comPG')" style="display:none"></li>
                        <li class="game-logo logo-ab" style="display:none"></li>
                        <li class="game-logo logo-sky" @click="goto_game('comSW')" style="display:none"></li>
                        <li class="game-logo logo-im" style="display:none"></li>
                        <li class="game-logo logo-mg" style="display:none"></li>
                        <li class="game-logo logo-yo" style="display:none"></li>
                        <li class="game-logo logo-mw" @click="goto_game('comMW')"></li>
                        <li class="game-logo logo-sg" style="display:none"></li>
                        <li class="game-logo logo-gns" @click="goto_game('comGenesis')"></li>
                        <li class="game-logo logo-sa" @click="goto_game('comSA')" style="display:none"></li>
                        <li class="game-logo logo-vt" @click="goto_game('comVT')"></li>
                        <li class="game-logo logo-rtg" @click="goto_game('comRTG')" ></li>
                    </ul>
                </div>
            </section>
            <!--棋牌-->
            <section class="game-card">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseCard" aria-expanded="false" aria-controls="collapseCard" @click="close_all_game('collapseCard')"></button>
                </div>
                <div class="collapse" id="collapseCard">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-cq9" style="display:none"></li>
                        <li class="game-logo logo-818" style="display:none"></li>
                        <li class="game-logo logo-le" style="display:none"></li>
                        <li class="game-logo logo-ky" style="display:none"></li>
                        <li class="game-logo logo-vg" style="display:none"></li>
                        <li class="game-logo logo-kg" style="display:none"></li>
                        <li class="game-logo logo-leg" @click="goto_game('comLEG')"></li>
                        <li class="game-logo logo-as" @click="trans_into_game('ASGame', 'SX')"></li>
                    </ul>
                </div>
            </section>
            <!--體育-->
            <section class="game-sport">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseSport" aria-expanded="false" aria-controls="collapseSport" @click="close_all_game('collapseSport')"></button>
                </div>
                <div class="collapse" id="collapseSport">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-3raise" style="display:none"></li>
                        <li class="game-logo logo-crown" style="display:none"></li>
                        <li class="game-logo logo-sb" style="display:none"></li>
                        <li class="game-logo logo-bbin" style="display:none"></li>
                        <li class="game-logo logo-im" style="display:none"></li>
                        <li class="game-logo logo-cmd" style="display:none"></li>
                        <li class="game-logo logo-bl" @click="trans_into_game('BLinkGame', 'TY')" style="display:none"></li>
                        <li class="game-logo logo-ysb" @click="trans_into_game('YSBGame', 'TY')"></li>
                    </ul>
                </div>
            </section>
            <!--釣魚-->
            <section class="game-fishing">
                <div class="card bg-transparent">
                    <button class="btn game-banner" type="button" data-toggle="collapse" data-target="#collapseFishing" aria-expanded="false" aria-controls="collapseFishing" @click="close_all_game('collapseFishing')"></button>
                </div>
                <div class="collapse" id="collapseFishing">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo logo-sa" @click="trans_into_game('SAGame', 'FishermenGold')" style="display:none"></li>
                        <li class="game-logo logo-gg" @click="trans_into_game('TCGGGame', 'G00009')" style="display:none"></li>
                    </ul>
                </div>
            </section>
           
            <span class="enabled" data-toggle="modal" data-target="#into_game_dialog" id="open_dialog"></span>
            <div class="modal fade mem-modal" id="into_game_dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white border-0">
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_dt_1.money_not_enough') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display:none"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_dt_1.confirm_into_game') }}</label>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="trans_point_page" id="trans_point_page">{{ __('msg_dt_1.into_point_page') }}</button>
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="confirm_into_game">{{ __('msg_dt_1.into_game') }}</button>
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="auto_trans_point('{{ __('msg_dt_1.trans_in_succ') }}', '{{ __('msg_dt_1.click_into_game_button') }}', '{{ __('msg_dt_1.trans_in_err') }}', '{{ __('msg_dt_1.bag_money_not_enough') }}', '{{ __('msg_dt_1.into_game') }}')" id="auto_trans_point">{{ __('msg_dt_1.auto_trans_point') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Footer Menu-->
        @include($footer_name)
    </body>
    <script>
        $(document).ready(function(){
            $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
                var target = $(this).data('target');
                $(target).on('shown.bs.modal',function(){
                    $('body').addClass('modal-open');

                });
            });
        });

        var notic = new Vue({
            el: '#notic',
            data: {
                notic_data : ''
            },
            created: function(){

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
        });

        var game_list = new Vue({
            el: '#game_list',
            data : {
                game_href : '#',
                g_id : '',
                g_type : ''
            },
            methods: {
                confirm_into_game: function(){

                    this.game_href = '/game/intogame/' + this.g_id + '/' + this.g_type;
                    var self = this;
                    setTimeout(function(){
                        self.$refs['gamelink'].click();
                    }, 500);
                    setTimeout(function(){
                        location.href = '/';
                    }, 1000);

                },
                close_all_game: function(obj_id){
                    $('.collapse').each(function(k,v){
                        if(v.id != obj_id){
                            $('#'+v.id).collapse('hide');
                        }
                        
                    });
                    if (obj_id == "collapseFishing" && document.getElementById("collapseFishing").className == "collapse"){
                         $('html, body').animate({scrollTop:document.body.scrollHeight}, 500,"linear");
                    }
                },
                trans_into_game: function(gid, gtype){

                    this.into_game(gid, gtype, '{{ __('msg_dt_1.click_into_game_button') }}', '{{ __('msg_dt_1.into_game') }}');

                }
            }
        });
    </script>
</html>
