<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>    
        <div class="container" id="acc_data">
            <div class="loading container-fluid d-flex align-items-center" v-if="show_mb_loading == 1" id="div_mb_loading">
                <div class="content">
                    <div class="ball">
                    </div>
                    <div class="ball1">
                    </div>
                </div>
            </div>
            <div class="main_member">
                @include($mb_info_head)
                <div class="container user-bd">
                    <div class="row">
                        @include($mb_info_left)
                        <div class="col-md-10 middle-history text-left mt-2">
                            <div class="user-edit-module">
                                <div class="mem-info-title">
                                    <h5 class="d-flex align-items-center"><i class="fas fa-info-circle mr-2"></i> {{ __('msg_fcs_1.my_assets') }}</h5>
                                </div>
                                <div class="summary-module">
                                    <div class="content asset">
                                        <div class="detail">
                                            <ul>
                                                <li class="total">
                                                    <div class="userItems account">
                                                        <div class="account-balance"><span class="label">{{ __('msg_fcs_1.acc_bal') }}</span><span class="money money-1"> <strong class="h4" id="mb_acc_money">@{{ acc_money }}</strong> {{ __('msg_fcs_1.dollars') }}</span><span class="money money-2" style="display: none;"> <strong class="h3">@{{ acc_money }}</strong> {{ __('msg_fcs_1.dollars') }}</span></div>
                                                        <button type="button" id="deposit_btn" class="btn btn-danger btn-sm" onclick="location.href='{{ url('mb/deposit') }}'">{{ __('msg_fcs_1.recharge') }}</button>
                                                        <button type="button" id="withdraw_btn" class="btn btn-light btn-sm" onclick="location.href='{{ url('mb/withdraw') }}'">{{ trans_choice('msg_fcs_1.withdraw', 0) }}</button>
                                                        <button type="button" id="enabled_btn" class="btn btn-light btn-sm" @click="fast_get_money()">{{ __('msg_fcs_1.one_click_out') }}</button>
                                                    </div>
                                                </li>
                                                <li class="platform" v-for="(game,index) in games">
                                                    <div class="name">@{{ game.name }}</div>
                                                    <div class="amount">@{{ formatMoney(game.point) }}</div>
                                                    <div class="action" v-if="loading_game_finishing == 1">
                                                        <span class="enabled" data-toggle="modal" data-target="#set_money" :data-stuff="[game.name,game.gametype]" @click="set_game_index(index)">{{ __('msg_fcs_1.trans_in') }}</span>
                                                        <span class="enabled" data-toggle="modal" data-target="#get_money" :data-stuff="[game.name,game.gametype]" @click="set_game_index(index)">{{ __('msg_fcs_1.trans_out') }}</span>
                                                    </div>
                                                    <div class="mask" v-if="loading_game_finishing == 1">
                                                        <span class="enabled" @click="fast_set_money(game.gametype,index)">{{ __('msg_fcs_1.flash_in') }}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="clear: both; margin-bottom: 30px;"></div>
                                    <div class="mem-info-title mt-5">
                                        <h5 class="d-flex align-items-center"><i class="fas fa-info-circle mr-2"></i> {{ __('msg_fcs_1.my_inf') }} <a href="{{ url('mb/edata') }}"><span class="small ml-2 text-warning">{{ __('msg_fcs_1.update') }}</span></a></h5>
                                    </div>
                                    <div class="row">
                                        <div class="content col-6 text-left memberName">
											<div class="row">
												<div class="col-4"><span class="inputname">{{ __('msg_fcs_1.account') }}&nbsp;:</span></div>
												<div class="col-8"><span class="membertxt">@{{ userinfo.loginaccount }}</span></div>
											</div>
											<div class="row"><!-- 原nickname -->
												<div class="col-4"><span class="inputname">{{ __('msg_fcs_1.real_name') }}&nbsp;:</span></div>
												<div class="col-8"><span class="membertxt">{{ userinfo.displayalias != '' ? hide_string("name",userinfo.displayalias) : '<?php echo __("msg_fcs_1.modified"); ?>'}}</span></div>
											</div><!-- 原nickname -->
											<!-- <div class="row">
												<div class="col-4"><span class="inputname">{{ __('msg_fcs_1.real_name') }}&nbsp;:</span></div>
												<div class="col-8"><span class="membertxt">{{ __('msg_fcs_1.modified') }}</span></div>
											</div> -->
											<div class="row">
													<!--<div class="col-3"><span class="inputname">推广地址&nbsp;:</span></div>
													<div class="col-9"><span class="membertxt small text-warning font-weight-light" style=" word-wrap: break-word;">https://d16999.net/register?recommendUserId=&amp;channel=
													</span></div>-->
											</div>
                                        </div>
                                        <div class="col-6 text-left memberPhoto">
                                            <div class="row">
												<div class="col-4"><span class="inputname"><span class="memicon phone-icon"></span>{{ __('msg_fcs_1.mobile') }} :</span></div>
												<div class="col-8"><span class="membertxt">{{ userinfo.phoneno != '' ? hide_string("phone",userinfo.phoneno) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                            <div class="row">
												<div class="col-4"><span class="memicon mail-icon"></span><span class="inputname">{{ __('msg_fcs_1.email') }} :</span></div>
												<div class="col-8"><span class="membertxt">{{ userinfo.email != '' ? hide_string("email",userinfo.email) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                            <div class="row">
												<div class="col-4"><span class="memicon qq-icon"></span><span class="inputname">{{ __('msg_fcs_1.qq') }} :</span></div>
												<div class="col-8"><span class="membertxt">{{ userinfo.qq != '' ? hide_string("qq",userinfo.qq) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                            <div class="row">
												<div class="col-4"><span class="memicon wechat-icon"></span><span class="inputname">{{ __('msg_fcs_1.wechat') }} :</span></div>
												<div class="col-8"><span class="membertxt">{{ userinfo.wechat != '' ? hide_string("wechat",userinfo.wechat) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><span class="memicon"></span><span class="inputname">{{ __('msg_fcs_1.line') }} :</span></div>
                                                <div class="col-8"><span class="membertxt">{{ userinfo.line != '' ? hide_string("line",userinfo.line) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4"><span class="memicon"></span><span class="inputname">{{ __('msg_fcs_1.skype') }} :</span></div>
                                                <div class="col-8"><span class="membertxt">{{ userinfo.skype != '' ? hide_string("skype",userinfo.skype) : '<?php echo __('msg_fcs_1.modified'); ?>'}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade mem-modal" id="set_money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <input type="hidden" ref="hid_set_gametype" id="hid_set_gametype"/>
                                        <div class="modal-header text-white brown">
                                            <h5 class="modal-title" id="set_monty_title">{{ __('msg_fcs_1.trans_in') }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <div class="modal-body mt-4">
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label" style="color:black">{{ __('msg_fcs_1.amount') }}:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="set_money_val" ref="set_money_val" placeholder="0" min="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer"> 
                                            <button type="button" class="btn btn-lh m-auto" @click="set_money();">{{ __('msg_fcs_1.confirm_trans_in') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade mem-modal" id="get_money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <input type="hidden" ref="hid_get_gametype" id="hid_get_gametype"/>
                                        <div class="modal-header text-white brown">
                                            <h5 class="modal-title" id="get_monty_title">{{ __('msg_fcs_1.trans_out') }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="get_money_close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <div class="modal-body mt-4">
                                            <div class="form-group row">
                                                <label for="exampleInputPassword1" class="col-sm-3 col-form-label" style="color:black">{{ __('msg_fcs_1.amount') }}:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="get_money_val" ref="get_money_val" placeholder="0" min="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer"> 
                                            <button type="button" class="btn btn-lh m-auto" @click="get_money();">{{ __('msg_fcs_1.confirm_trans_out') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
<script>
    // 修正 Modal 小錯誤
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
            $('#set_monty_title').html('<?php echo __("msg_fcs_1.trans_in"); ?> ' + id[0]);
            $('#hid_set_gametype').val(id[1]);
            setTimeout(function(){
                  $('#set_money_val').focus();
            }, 420);
        });

        var get_modal = $("#get_money");
        get_modal.on("show.bs.modal", function(e){            
            var btn = $(e.relatedTarget),
            id = btn.data("stuff").split(','); 
            $('#get_monty_title').html('<?php echo __("msg_fcs_1.trans_out"); ?> ' + id[0]);
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
            acc_money: 0.0,
            userinfo: {},
            show_mb_loading: 0,
            show_loading: 0,
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
                    self.get_user_info();
                }
            }, 500);
            

        },
        methods: {
            set_game_index: function(index){
                this.game_index = index;
            },
            get_all_money: function(){

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
                        self.alertinfo('<?php echo __("msg_fcs_1.login_first"); ?>', '/');
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
                document.body.style.overflow = 'hidden';
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
                            self.setshowbagmony(formatMoney(this.json['info']['balance']));
                            self.games[self.game_index].point = this.json['info']['gameBalance'];
                            self.alertinfo('<?php echo __("msg_fcs_1.trans_in_succ"); ?>');
                        }else{
                            self.alertinfo(this.json['info'], '/mb/acc');
                        }
                        // self.get_all_money();
                        // self.getbagmoney(session_data);
                        self.$refs.set_money_val.value = '';
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                    });
                }else{
                    this.alertinfo('<?php echo __("msg_fcs_1.trans_in_err"); ?>', '/mb/acc');
                    return;
                }

            },
            get_money: function(){

                $("#get_money_close").click();
                document.body.style.overflow = 'hidden';
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
                            self.setshowbagmony(formatMoney(this.json['info']['balance']));
                            self.games[self.game_index].point = this.json['info']['gameBalance'];
                            self.alertinfo('<?php echo __("msg_fcs_1.trans_out_succ"); ?>');
                            // self.get_all_money();
                            // self.getbagmoney(session_data);
                            self.$refs.get_money_val.value = '';                            
                        }else{
                            self.alertinfo(this.json['info'], '/mb/acc');
                        }
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                    });
                }else{
                    this.alertinfo('<?php echo __("msg_fcs_1.trans_out_err"); ?>', '/mb/acc');
                    return;
                }

            },
            fast_set_money: function(gtype,index){
                this.game_index = index;
                document.body.style.overflow = 'hidden';
                this.get_scroll_top();
               
                var money = $('#mb_acc_money').html().replace(',', '');
                if(gtype != '' && money != '' && money > 0){
                    var ApiURL = API_Host + '/game/setmoney/' + gtype + '/' + money;
                    Vue.prototype.$http = axios;
                    var session_data = "<?php echo session('login_eid')?>";

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.setshowbagmony(formatMoney(this.json['info']['balance']));
                            self.games[self.game_index].point = this.json['info']['gameBalance'];
                            self.alertinfo('<?php echo __("msg_fcs_1.trans_in_succ"); ?>');                            
                        }else{
                            self.alertinfo(this.json['info']);
                        }
                        // self.get_all_money();
                        // self.getbagmoney(session_data);
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.show_mb_loading = 0;
                        document.body.style.overflow = 'visible';
                    });
                }else{
                    this.alertinfo('<?php echo __("msg_fcs_1.trans_in_err"); ?>', '/mb/acc');
                    return;
                }

            },
            fast_get_money: function(){

                $.each(this.games, function(key, value){
                    value['point'] = '';
                });

                document.body.style.overflow = 'hidden';
                this.get_scroll_top();
                var session_data = "<?php echo session('login_eid')?>";

                var ApiURL = API_Host + '/game/downintegralallgame';
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                        self.alertinfo('<?php echo __("msg_fcs_1.trans_out_succ"); ?>');
                        self.get_all_money();
                        self.getbagmoney(session_data);
                    }else{
                        self.alertinfo(this.json['info'], '/mb/acc');
                    }
                    self.show_mb_loading = 0;
                    document.body.style.overflow = 'visible';
                    return;
                })
                .catch(function (error) {
                    console.log(error);
                    self.show_mb_loading = 0;
                    document.body.style.overflow = 'visible';
                });

            },
            hide_string: function(type,string){
                    var new_string = "";
                    var phone_string_need = 4;      // 需要的電話號碼位數
                    var china_phone_length = 11;    //大陸電話號碼長度
                    var mail_min_length = 3;        //mail需要的最短長度
                    var mail_common_length = 5;     //mail一般長度
                    var qq_min_length = 5;          //qq需要的最短長度
                    var qq_need_length = 3;         //qq一般長度

                    var count_string = 0;
                    if (string != "" && string != undefined){
                        var length = string.length;
                        if (type == "name"){
                                new_string = string.substr(0,1);
                                while (count_string < length){
                                    new_string += "*";
                                    count_string++;
                                }
                        }else if (type == "phone"){
                            while (count_string < length-phone_string_need){
                                new_string += "*";
                                count_string++;
                            }
                            new_string += string.substr(-(phone_string_need),phone_string_need);
                        }else if (type == "email" || type == "skype" || type == "line"){
                            var account_list = string.split("@");
                            length = account_list[0].length;
                            string = account_list[0];
                            if (length <= mail_min_length){
                                while (count_string < mail_common_length-length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string.substr(-(length),length);
                            }else{
                                while (count_string < length-mail_min_length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string.substr(-(mail_min_length),mail_min_length);
                            }
                            if (account_list[1] != undefined){
                                new_string+="@"+account_list[1];
                            };
                            
                        }else if (type == "qq" || type == "wechat"){
                            if (length <= qq_min_length){
                                while (count_string < qq_min_length-length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string;
                            }else{
                                while (count_string < length - qq_min_length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string+=string.substr(-(qq_need_length),qq_need_length);
                            }
                        }
                    }
                    return new_string;
                },
        }
    });
</script>
</html>
