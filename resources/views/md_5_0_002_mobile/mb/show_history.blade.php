<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($head_name)
        <div id="show_records">
            <header class="login-header navbar-dark">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn back-btn" onclick="history.go(-1)"></button>
                    <div class="header-title m-auto">{{ __('msg_zy_1.betting') . __('msg_zy_1.record') }}</div>
                </div>
            </header>
            <main role="main" class="container main bank-main">
                <section class="btn-group w-100 funds-menu mb-2" role="group">
                    <div class="btn-group w-30" role="group">
                        <button id="btnGroupDrop-funds" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref="game_name">
                            <i class="fas fa-dice"></i> {{ __('msg_zy_1.game') . __('msg_zy_1.platform') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" v-for="gamename in gamenames" @click="change_game(gamename.id, gamename.name)">@{{ gamename.name }}</a>
                            <!--<a class="dropdown-item" href="#">B</a>-->
                        </div>
                    </div>

                    <div class="btn-group w-30" role="group">
                        <button id="btnGroupDrop-type" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref="game_type">
                            <i class="fas fa-gamepad"></i> {{ __('msg_zy_1.game') . __('msg_zy_1.type') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" @click="change_game_type('nodata', '{{ __('msg_zy_1.game') . __('msg_zy_1.type') }}')">{{ __('msg_zy_1.game') . __('msg_zy_1.type') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('SX', '{{ __('msg_zy_1.real_casino') }}')">{{ __('msg_zy_1.real_casino') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('DZ', '{{ __('msg_zy_1.slots') }}')">{{ __('msg_zy_1.slots') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('TY', '{{ __('msg_zy_1.sport') }}')">{{ __('msg_zy_1.sport') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('CP', '{{ __('msg_zy_1.lottery') }}')">{{ __('msg_zy_1.lottery') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('QP', '{{ __('msg_zy_1.cardgame') }}')">{{ __('msg_zy_1.cardgame') }}</a>
                            <a class="dropdown-item" href="#" @click="change_game_type('BY', '{{ __('msg_zy_1.fishing').__('msg_zy_1.game') }}')">{{ __('msg_zy_1.fishing').__('msg_zy_1.game') }}</a>
                        </div>
                    </div>
                    
                    <div class="btn-group w-30" role="group">
                        <button id="btnGroupDrop-date" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref="game_date">
                            <i class="far fa-calendar-alt"></i> {{ __('msg_zy_1.select_time') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                            <!--<a class="dropdown-item" href="#" @click="change_date('0', '{{ __('msg_zy_1.all_time') }}')">{{ __('msg_zy_1.all_time') }}</a>-->
                            <a class="dropdown-item" href="#" @click="change_date('1', '{{ __('msg_zy_1.today') }}')">{{ __('msg_zy_1.today') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('2', '{{ __('msg_zy_1.yesterday') }}')">{{ __('msg_zy_1.yesterday') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('3', '{{ __('msg_zy_1.last_week') }}')">{{ __('msg_zy_1.last_week') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('4', '{{ __('msg_zy_1.last_30_days') }}')">{{ __('msg_zy_1.last_30_days') }}</a>
                        </div>
                    </div>
                </section>
                <section class="mb-2 sum-data">
                    <div class="row">
                        <div class="col text-left "><em class="far fa-list-alt"></em> {{ __('msg_zy_1.total_count') }}: <strong class="text-primary">@{{ data_count }}</strong></div>
                        <div class="col text-right"><i class="fas fa-coins"></i> {{ __('msg_zy_1.total_money') }}: <strong class="text-success">@{{ formatMoney(data_bet) }}</strong></div>
                    </div>
                </section>
                <section class="funds-table mb-2" v-if="hasdata === 1" v-for="gamedata in gamedatas">
                    <div class="row funds-date">
                        <div class="col">{{ __('msg_zy_1.time') }} : <span>@{{ gamedata.betDay }}</span></div>
                    </div>
                    <div class="row funds-1">
                        <div class="col">{{ __('msg_zy_1.note_no') }} : <span class="order">@{{ gamedata.orderId }}c</span></div>
                    </div>
                    <div class="row funds-1">
                        <div class="col">{{ __('msg_zy_1.game') }} :<span>@{{ gamedata.gamePlatform }}</span>-<span>@{{ gamedata.gameBigType }}</span>-<strong>@{{ gamedata.gamename }}</strong></div>
                    </div>
                    <div class="row funds-2">
                        <div class="col-6">{{ __('msg_zy_1.betting') . __('msg_zy_1.amount') }} : <strong class="text-success">@{{ formatMoney(gamedata.betMoney) }}</strong></div>
                        <div class="col-6 text-right">{{ __('msg_zy_1.winning') }} : <strong class="text-win">@{{ formatMoney(gamedata.netMoney) }}</strong></div>
                    </div>
                </section>
                <section class="nodata d-flex flex-column justify-content-center align-items-center" v-if="hasdata == 0">
                    <div class="round-out"><i class="fas fa-flag fa-lg"></i></div>
                    <div class="mt-1">No data</div>
                </section>
                <button type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn mb-3" v-if="bln_no_more == 1" @click="add_count"><i class="fas fa-sync-alt"></i> {{ __('msg_zy_1.load_more') }}</button>
            </main>
        </div>
         <!--go to top-->
        <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
            <i class="fas fa-angle-up fa-lg"></i>
        </a>
        <!--Footer Menu-->
        @include($footer_name)
        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script>
            $(document).ready(function(){
                $(window).scroll(function(){
                    if($(this).scrollTop() > 50){
                        $('#back-to-top').fadeIn();
                    }else{
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function(){
                    $('#back-to-top').tooltip('hide');
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

                $('#back-to-top').tooltip('show');

            });

            var app = new Vue({
                el : '#show_records',
                data : {
                    gamenames : [
                        {
                            id: 'nodata',
                            name: '{{ __("msg_zy_1.all_game") }}'
                        }
                    ],
                    gamedatas : [],
                    mdate: 'nodata',
                    sdate: 'nodata',
                    edate: 'nodata',
                    gname: 'nodata',
                    gtype: 'nodata',
                    hasdata: 0,
                    perpage: 15,
                    start_idx: 0,
                    bln_no_more: 0,
                    data_count: 0,
                    data_bet: 0,
                    data_win: 0
                },
                created: function(){

                    var self = this;
                    setTimeout(function(){
                        var session_data = "<?php echo session('login_eid')?>";
                        if(session_data != ''){
                            self.change_date('1', '{{ __("msg_zy_1.today") }}');
                            self.get_game_type();
                        }
                    }, 500);

                },
                methods: {
                    get_game_type: function(){

                        var ApiURL = API_Host + '/game/ebrandgame';
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                $.each(this.json['info']['game'], function(key, value) {
                                    self.gamenames.push({id: value['gametype'], name: value['gamename']});
                                });
                            }else{
                                self.alertinfo(this.json['info']);
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    show_records_data: function(){

                        this.data_count = 0;
                        this.data_bet = 0;
                        this.data_win = 0;

                        this.gamedatas = [];

                        var ApiURL = API_Host + '/game/get_recordsall/' + this.start_idx + '/' + this.perpage + '/' + this.gname + '/' + this.gtype + '/' + this.sdate + '/' + this.edate + '/0';
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                var rtnData = this.json['info'];
                                if(rtnData['count'] > 0){
                                    self.hasdata = 1;
                                    if(rtnData['count'] <= (self.start_idx + self.perpage)){
                                        self.bln_no_more = 0;
                                    }else{
                                        self.bln_no_more = 1;
                                    }

                                    var tmp_settleamount = 0;

                                    self.data_count = rtnData['count'];
                                    self.data_bet = rtnData['betMoneyAll'];
                                    self.data_win = rtnData['netMoneyAll'];
                                    $.each(rtnData['record'], function(key, value){
                                        var bigType = '';
                                        var int_win = 0;
                                        switch(value['gamebigtype']){
                                            case 'SX':
                                                bigType = '{{ __("msg_zy_1.real_casino") }}';
                                                break;
                                            case 'DZ':
                                                bigType = '{{ __("msg_zy_1.slots") }}';
                                                break;
                                            case 'TY':
                                                bigType = '{{ __("msg_zy_1.sport") }}';
                                                break;
                                            case 'CP':
                                                bigType = '{{ __("msg_zy_1.lottery") }}';
                                                break;
                                            case 'QP':
                                                bigType = '{{ __("msg_zy_1.cardgame") }}';
                                                break;
                                            case 'BY':
                                                bigType = '{{ __("msg_zy_1.fishing").__("msg_zy_1.game") }}';
                                                break;
                                        }

                                        if(parseFloat(value['netMoney']) > 0){
                                            int_win = 1;
                                        }

                                        if(value['status'] == '未結算'){
                                            tmp_settleamount = '未結算';
                                        }else{
                                            tmp_settleamount = value['settleamount'];
                                        }

                                        self.gamedatas.push({gamePlatform: value['gametype'], orderId: value['orderId'], gameBigType: bigType, betMoney: value['betmoney'], netMoney: value['netmoney'], betDay: value['bettime'], intwin: int_win, gamename: value['gamename'], settleamount: tmp_settleamount});
                                    });
                                }else{
                                    self.hasdata = 0;
                                    self.bln_no_more = 0;
                                }
                            }else{
                                self.alertinfo(this.json['info']);
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    change_date: function(date_mode, str_status){

                        this.start_idx = 0;

                        this.$refs.game_date.innerHTML = '<i class="far fa-calendar-alt"></i> ' + str_status;

                        this.change_date_act(date_mode);
                        
                        this.show_records_data();

                    },
                    change_game: function(game_id, game_name){

                        this.start_idx = 0;
                        this.$refs.game_name.innerHTML = '<i class="fas fa-dice"></i> ' + game_name;
                        this.gname = game_id;
                        this.show_records_data();

                    },
                    change_game_type: function(type_id, type_name){

                        this.start_idx = 0;
                        this.$refs.game_type.innerHTML = '<i class="fas fa-gamepad"></i>' + type_name;
                        this.gtype = type_id;
                        this.show_records_data();

                    },
                    add_count: function(){

                        this.start_idx = this.start_idx + this.perpage;
                        
                        var ApiURL = API_Host + '/game/get_recordsall/' + this.start_idx + '/' + this.perpage + '/' + this.gname + '/' + this.gtype + '/' + this.sdate + '/' + this.edate + '/0';
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                var rtnData = this.json['info'];
                                if(rtnData['count'] > 0){
                                    if(rtnData['count'] <= (self.start_idx + self.perpage)){
                                        self.bln_no_more = 0;
                                    }else{
                                        self.bln_no_more = 1;
                                    }

                                    var tmp_settleamount = 0;

                                    $.each(rtnData['record'], function(key, value){
                                        var bigType = '';
                                        var int_win = 0;
                                        switch(value['gameBigType']){
                                            case 'SX':
                                                bigType = '{{ __("msg_zy_1.real_casino") }}';
                                                break;
                                            case 'DZ':
                                                bigType = '{{ __("msg_zy_1.slots") }}';
                                                break;
                                            case 'TY':
                                                bigType = '{{ __("msg_zy_1.sport") }}';
                                                break;
                                            case 'CP':
                                                bigType = '{{ __("msg_zy_1.lottery") }}';
                                                break;
                                            case 'QP':
                                                bigType = '{{ __("msg_zy_1.cardgame") }}';
                                                break;
                                            case 'BY':
                                                bigType = '{{ __("msg_zy_1.fishing").__("msg_zy_1.game") }}';
                                                break;
                                        }

                                        if(parseFloat(value['netMoney']) > 0){
                                            int_win = 1;
                                        }

                                        if(value['status'] == '未結算'){
                                            tmp_settleamount = '未結算';
                                        }else{
                                            tmp_settleamount = value['settleamount'];
                                        }

                                        self.gamedatas.push({gamePlatform: value['gamePlatform'], orderId: value['orderId'], gameBigType: bigType, betMoney: value['betMoney'], netMoney: value['netMoney'], betDay: value['betDay'], intwin: int_win, gamename: value['gamename'], settleamount: tmp_settleamount});
                                    });
                                }else{
                                    self.bln_no_more = 0;
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
        </script>
    </body>
</html>
