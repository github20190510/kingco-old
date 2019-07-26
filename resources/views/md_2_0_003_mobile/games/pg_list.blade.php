<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <header></header>
        @include($head_name)
        <!--登入後使用者名稱-->
        @include($game_list)
        <!--Game carousl End-->
        <div id="pglist">
           <!--  <section class="container-fluid text-center slot-nav-bar">
                <div class="slot-type d-flex align-items-center justify-content-center">
                    <button type="button" class="btn slot-type-btn"> <input type="checkbox" checked autocomplete="off"> {{ __('msg_fcs_1.prize_pool') . __('msg_fcs_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn active">{{ __('msg_fcs_1.all') . __('msg_fcs_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.hot') . __('msg_fcs_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.classic_slot_machine') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.horn_slot_machine') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.video_poker') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.video_poker') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_fcs_1.scratch') }}</button>
                </div>
                <div class="input-group input-group-sm search-btn">
                    <input type="text" class="form-control bg-transparent" placeholder="{{ __('msg_fcs_1.search'). __('msg_fcs_1.game') }}" aria-label="Recipient's username" aria-describedby="button-addon2" v-model="search_word">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon2" @click="search_data()"><i class="fas fa-search text-white"></i></button>
                    </div>
                </div>
            </section> -->
            <main role="main" class="container-fluid main slot-main">
                <div class="game-box d-flex flex-wrap align-content-start justify-content-center">
                    <div class="game flex-column" :class="{'disabled': v['status'] === false, 'enabled': v['status'] === true}" v-for="(v, k) in gamedatas">
                        <div class="cover">{{ __('msg_fcs_1.in_maintenance') }}</div>
                        <div class="gameImg"><!--<a :href="'/game/intogame/PGGame/' + v['gameid']" target="_blank">--><img class="load"  alt="" :src="'{{asset('/css/')}}/' + MODEL_NAME + v['img']" @click="into_game('PGGame', v['gameid'], '{{ __('msg_fcs_1.click_into_game_button') }}', '{{ __('msg_fcs_1.into_game') }}')"><!--</a>--></div>
                        <div class="gameName">@{{v['gamename']}}</div>
                    </div>
                </div>
            </main>
            <a :href="game_href" target="_blank" ref="gamelink" style="display:none"></a>
            <span class="enabled" data-toggle="modal" data-target="#into_game_dialog" id="open_dialog"></span>
            <div class="modal fade mem-modal" id="into_game_dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white border-0">
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_fcs_1.money_not_enough') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display:none"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_fcs_1.confirm_into_game') }}</label>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="trans_point_page" id="trans_point_page">{{ __('msg_fcs_1.into_point_page') }}</button>
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="confirm_into_game">{{ __('msg_fcs_1.into_game') }}</button>
                            <button type="button" class="btn border-0 btn-dark c-gold" @click="auto_trans_point('{{ __('msg_fcs_1.trans_in_succ') }}', '{{ __('msg_fcs_1.click_into_game_button') }}', '{{ __('msg_fcs_1.trans_in_err') }}', '{{ __('msg_fcs_1.bag_money_not_enough') }}', '{{ __('msg_fcs_1.into_game') }}')" id="auto_trans_point">{{ __('msg_fcs_1.auto_trans_point') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer Menu-->
        @include($footer_name)
        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <!--表單驗證-->
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();

        var json_data = new Array();

        readTextFile('{{asset("js/games/pg_list.js")}}', function(text){

            json_data = JSON.parse(text);
            for_data = json_data['pg_game_data'];
            var app = new Vue({
                el : '#pglist',
                data : {
                    gamedatas : new Array(),                    
                    def_lang: 'zh_cn',                    
                    search_word: '',
                    game_href : '#',
                    g_id : '',
                    g_type : '',
                    corp_name: 'pg',
                    MODEL_NAME : 'game_img/mobile'
                },
                created: function(){

                    this.def_lang = '<?php echo $lang; ?>';
                    this.get_games();

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

                    }
                }
            });
        });
        </script>
    </body>
</html>
