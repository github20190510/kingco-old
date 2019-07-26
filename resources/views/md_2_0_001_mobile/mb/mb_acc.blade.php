<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="acc_data">
            <div class="loading container-fluid d-flex align-items-center" v-if="show_mb_loading == 1" id="div_mb_loading">
                <div class="content">
                    <div class="ball">
                    </div>
                    <div class="ball1">
                    </div>
                </div>
            </div>
            <main role="main" class="container main account-main">
                <section class="user-data-bar d-flex flex-row">
                    <div class="user-icon c-alpha-gold"><i class="far fa-user fa-3x"></i></div>
                    <div class="user-data row flex-grow-1 justify-content-between">
                        <div class="col d-flex flex-column justify-content-between">
                            <span id="user_name"></span>
                            <button type="button" class="btn btn-sm transfer-btn" @click="fast_get_money">{{ __('msg_dt_1.one_click_out') }}</button>
                        </div>
                        <div class="col d-flex flex-column text-right" id="acc_bag_money">
                            <span>{{ __('msg_dt_1.account_money') }}</span>
                            <h3 id="acc_money_h3">0.00</h3>
                        </div>
                    </div>
                </section>            
                <section class="btn-group btn-block access-bar" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary c-alpha-gold mr-1" onclick="location.href='/mb/deposit'">{{ __('msg_dt_1.saving_money') }}</button>
                    <button type="button" class="btn btn-secondary c-alpha-gold mr-1" onclick="location.href='/mb/withdraw'">{{ __('msg_dt_1.geting_money') }}</button>
                    <button type="button" class="btn btn-secondary c-alpha-gold" onclick="location.href='/mb/bank_card'">{{ __('msg_dt_1.bank_card') }}</button>
                </section>
                <section class="mt-3">
                    <ul class="row d-flex flex-wrap justify-content-between" v-if="loading_game_finishing == 1">
                        <li class="platform c-alpha-gold ZBLIVE" v-for="(game,index) in games" >
                            <h6 class="name">@{{ game.name }}</h6>
                            <div class="amount">@{{ formatMoney(game.point) }}</div>
                            <button type="button" class="btn text-white mx-0 login-btn" @click="fast_set_money(game.gametype,index)">{{ __('msg_dt_1.flash_in') }}</button>
                            <button type="button" class="btn text-white mx-0 login-btn" data-toggle="modal" data-target="#set_money" :data-stuff="[game.name,game.gametype]" @click="set_game_index(index)">{{ __('msg_dt_1.trans_in') }}</button>
                            <button type="button" class="btn text-white mx-0 login-btn" data-toggle="modal" data-target="#get_money" :data-stuff="[game.name,game.gametype]" @click="set_game_index(index)">{{ __('msg_dt_1.trans_out') }}</button>
                        </li>
                    </ul>
                    <div v-else class="text-center ">
                        <div class="lds-facebook " >
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </section>
                <div class="d-flex flex-wrap justify-content-sm-start"></div>
            </main>
            <!--go to top-->
            <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
                <i class="fas fa-angle-up fa-lg"></i>
            </a>
            <!--Footer Menu-->
            @include($footer_name)
            <!-- Modal 转入转出-->        
            <div class="modal fade mem-modal" id="set_money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white  border-0">
                        <input type="hidden" ref="hid_set_gametype" id="hid_set_gametype"/>
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_dt_1.trans_in') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row">
                                <label for="money" class="col-3 col-form-label">{{ __('msg_dt_1.amount') }}:</label>
                                <div class="col-9">
                                    <input type="number" class="form-control" id="set_money_val" ref="set_money_val" placeholder="0" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0"> 
                            <button type="button" class="btn btn-lh m-auto btn-dark c-gold border-0" @click="set_money();">{{ __('msg_dt_1.confirm_trans_in') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade mem-modal" id="get_money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white  border-0">
                        <input type="hidden" ref="hid_get_gametype" id="hid_get_gametype"/>
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_dt_1.trans_out') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="get_money_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row">
                                <label for="money" class="col-3 col-form-label">{{ __('msg_dt_1.amount') }}:</label>
                                <div class="col-9">
                                    <input type="number" class="form-control" id="get_money_val" ref="get_money_val" placeholder="0" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0"> 
                            <button type="button" class="btn btn-lh m-auto btn-dark c-gold border-0" @click="get_money();">{{ __('msg_dt_1.confirm_trans_out') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
                    var target = $(this).data('target');
                    $(target).on('shown.bs.modal',function(){
                        $('body').addClass('modal-open');

                    });
                });
                var set_modal = $("#set_money");
                set_modal.on("show.bs.modal", function(e){
                    var btn = $(e.relatedTarget),
                    id = btn.data("stuff").split(','); 
                    $('#set_monty_title').html('<?php echo __("msg_dt_1.trans_in"); ?> ' + id[0]);
                    $('#hid_set_gametype').val(id[1]);
                    setTimeout(function(){
                          $('#set_money_val').focus();
                    }, 420);
                });

                var get_modal = $("#get_money");
                get_modal.on("show.bs.modal", function(e){            
                    var btn = $(e.relatedTarget),
                    id = btn.data("stuff").split(','); 
                    $('#get_monty_title').html('<?php echo __("msg_dt_1.trans_out"); ?> ' + id[0]);
                    $('#hid_get_gametype').val(id[1]);
                    setTimeout(function(){
                          $('#get_money_val').focus();
                    }, 420);
                });
            });

            var acc_data = new Vue({
                el : '#acc_data',
                data : {
                    games: [],
                    acc_money: '0.00',
                    userinfo: {},
                    show_mb_loading: 0,
                    game_index: -1,
                    loading_game_finishing: 0,
                },
                created: function(){
                    
                    var self = this;
                    $.each(arr_Games[game_list_key], function(k, v){
                        if(v['status'] == 1){
                            self.games.push(v);
                        }
                    });
                    var loading_height = screen.height;
                    $('#div_mb_loading').height(loading_height);

                    setTimeout(function(){
                        var session_data = "<?php echo session('login_eid')?>";
                        if(session_data != ''){
                            self.get_all_money();
                        }
                    }, 500);
                    

                },
                methods: {
                    set_game_index: function(index){
                        this.game_index = index;
                    },
                    get_all_money: function(){

                        //this.getbagmoney();
                        var ApiURL = API_Host + '/game/gamebalancesall_acc';
                        var arrInfo = [];

                        Vue.prototype.$http = axios;

                        var self = this;
                        self.loading_game_finishing = 0;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                self.loading_game_finishing = 1;
                                $.each(this.json['info'], function(k, v){
                                    arrInfo[v['gametype']] = v;
                                });

                                self.setVal(arrInfo);

                            }else{
                                self.alertinfo('<?php echo __("msg_dt_1.login_first"); ?>', '/');
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    get_user_info: function(){

                        var ApiURL = API_Host + '/mb/user_info';
                        Vue.prototype.$http = axios;
                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                self.userinfo = this.json['info'];
                            }else{
                                self.alertinfo(this.json['info'], '/');
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    setVal: function(arrInfo){

                        var self = this;
                        /*$.each(this.games, function(key, value){
                            value['point'] = arrInfo[value['gametype']];
                            if(value['point'] == '' || value['point'] == undefined){
                                value['point'] = '0.00';
                            }
                        });*/
                        $.each(this.games, function(key, value){

                            if(arrInfo[value['gametype']] != undefined  && arrInfo[value['gametype']].gamebalance != ''){
                                value['point'] = arrInfo[value['gametype']].gamebalance;
                            }else{
                                value['point'] = '0.00';
                            }

                        });

                    },
                    set_money: function(){

                        $("#set_money_close").click();
                        //document.body.style.overflow = 'hidden';
                        this.get_scroll_top();

                        var gtype = this.$refs.hid_set_gametype.value;
                        var money = this.$refs.set_money_val.value;
                        if(gtype != '' && money != '' && money > 0){
                            var ApiURL = API_Host + '/game/setmoney/' + gtype + '/' + money;
                            Vue.prototype.$http = axios;
                            var session_data = "<?php echo session('login_eid')?>";

                            var self = this;
                            this.$http.get(ApiURL, {cancelToken: source.token})
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] == '1'){
                                    self.setshowbagmony(formatMoney(this.json['info']['balance']),'<?php echo __("msg_dt_1.balance"); ?> ');
                                    self.games[self.game_index].point = this.json['info']['gameBalance'];
                                    self.alertinfo('<?php echo __("msg_dt_1.trans_in_succ"); ?>');
                                }else{
                                    self.alertinfo(this.json['info'], '/mb/acc');
                                }
                                // self.get_all_money();
                                // self.getbagmoney(session_data, '<?php echo __("msg_dt_1.balance"); ?> ', '<?php echo __("msg_dt_1.account_money"); ?>');
                                self.$refs.set_money_val.value = '';
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                                return;
                            })
                            .catch(function (error) {
                                console.log(error);
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                            });
                        }else{
                            this.alertinfo('<?php echo __("msg_dt_1.trans_in_err"); ?>', '/mb/acc');
                            return;
                        }

                    },
                    get_money: function(){

                        $("#get_money_close").click();
                        //document.body.style.overflow = 'hidden';
                        this.get_scroll_top();

                        var gtype = this.$refs.hid_get_gametype.value;
                        var money = this.$refs.get_money_val.value;
                        if(gtype != '' && money != '' && money > 0){
                            var ApiURL = API_Host + '/game/getmoney/' + gtype + '/' + money;
                            Vue.prototype.$http = axios;
                            var session_data = "<?php echo session('login_eid')?>";

                            var self = this;
                            this.$http.get(ApiURL, {cancelToken: source.token})
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] == '1'){
                                    self.setshowbagmony(formatMoney(this.json['info']['balance']),'<?php echo __("msg_dt_1.balance"); ?> ');
                                    self.games[self.game_index].point = this.json['info']['gameBalance'];
                                    self.alertinfo('<?php echo __("msg_dt_1.trans_out_succ"); ?>');
                                    // self.get_all_money();
                                    // self.getbagmoney(session_data, '<?php echo __("msg_dt_1.balance"); ?> ', '<?php echo __("msg_dt_1.account_money"); ?>');
                                    self.$refs.get_money_val.value = '';                            
                                }else{
                                    self.alertinfo(this.json['info'], '/mb/acc');
                                }
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                                return;
                            })
                            .catch(function (error) {
                                console.log(error);
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                            });
                        }else{
                            this.alertinfo('<?php echo __("msg_dt_1.trans_out_err"); ?>', '/mb/acc');
                            return;
                        }

                    },
                    fast_set_money: function(gtype,index){

                        //document.body.style.overflow = 'hidden';
                        this.get_scroll_top();
                       
                        var money = $('#acc_money_h3').html().replace(',', '');
                        if(gtype != '' && money != '' && money > 0){
                            var ApiURL = API_Host + '/game/setmoney/' + gtype + '/' + money;
                            Vue.prototype.$http = axios;
                            var session_data = "<?php echo session('login_eid')?>";

                            var self = this;
                            this.$http.get(ApiURL, {cancelToken: source.token})
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] == '1'){
                                    self.setshowbagmony(formatMoney(this.json['info']['balance']),'<?php echo __("msg_dt_1.balance"); ?> ');
                                    self.games[index].point = this.json['info']['gameBalance'];
                                    self.alertinfo('<?php echo __("msg_dt_1.trans_in_succ"); ?>');                                    
                                }else{
                                    self.alertinfo(this.json['info']);
                                }
                                // self.get_all_money();
                                // self.getbagmoney(session_data, '<?php echo __("msg_dt_1.balance"); ?> ', '<?php echo __("msg_dt_1.account_money"); ?>');
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                                return;
                            })
                            .catch(function (error) {
                                console.log(error);
                                self.show_mb_loading = 0;
                                //document.body.style.overflow = 'visible';
                            });
                        }else{
                            this.alertinfo('<?php echo __("msg_dt_1.trans_in_err"); ?>', '/mb/acc');
                            return;
                        }

                    },
                    fast_get_money: function(){

                        $.each(this.games, function(key, value){
                            value['point'] = '';
                        });

                        //document.body.style.overflow = 'hidden';
                        this.get_scroll_top();
                        var session_data = "<?php echo session('login_eid')?>";

                        var ApiURL = API_Host + '/game/downintegralallgame';
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                self.alertinfo('<?php echo __("msg_dt_1.trans_out_succ"); ?>');
                                self.get_all_money();
                                self.getbagmoney(session_data, '<?php echo __("msg_dt_1.balance"); ?> ', '<?php echo __("msg_dt_1.account_money"); ?>');
                            }else{
                                self.alertinfo(this.json['info'], '/mb/acc');
                            }
                            self.show_mb_loading = 0;
                            //document.body.style.overflow = 'visible';
                            return;
                        })
                        .catch(function (error) {
                            console.log(error);
                            self.show_mb_loading = 0;
                            //document.body.style.overflow = 'visible';
                        });

                    },
                    get_scroll_top: function(){

                        this.show_mb_loading = 1;
                        var bodyTop = 0;
                        if (typeof window.pageYOffset != "undefined") {
                            bodyTop = window.pageYOffset;

                        } else if (typeof document.compatMode != "undefined"
                        && document.compatMode != "BackCompat") {
                            bodyTop = document.documentElement.scrollTop;

                        } else if (typeof document.body != "undefined") {
                            bodyTop = document.body.scrollTop;
                        }
                        
                        setTimeout(function(){
                            $('#div_mb_loading').css('top', bodyTop+'px');
                        }, 100);

                    }
                }
            });
        </script>
    </body>
</html>
