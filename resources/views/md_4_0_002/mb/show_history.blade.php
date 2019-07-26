<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>
        <div class="main membe-box" id="show_records">
            <div class="content">
                <div class="main_member">
                    @include($mb_info_head)
                    <div class="container user-bd">
                        <div class="row">
                            @include($mb_info_left)
                            <div class="col-md-10 middle-history text-left mt-2">
                                <div class="user-edit-module">
                                    <div class="mem-data-title">
                                        <h5 class="d-flex align-items-center"><i class="far fa-file-alt mr-2"></i> {{ __('msg_zy_1.betting') . __('msg_zy_1.record') }}</h5>
                                    </div>
                                    <div>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <select class="custom-select custom-select-sm mr-sm-2" v-model="gname" @change="change_game_type()">
                                                    <option v-for="gamename in gamenames" v-bind:value="gamename.id">@{{ gamename.name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-auto my-1">
                                                <select class="custom-select custom-select-sm mr-sm-2" v-model="gtype" @change="change_game_type()">
                                                    <option value="nodata" selected>{{ __('msg_zy_1.game') . __('msg_zy_1.type') }}</option>
                                                    <option value="SX">{{ __('msg_zy_1.real_casino') }}</option>
                                                    <option value="DZ">{{ __('msg_zy_1.slots') }}</option>
                                                    <option value="TY">{{ __('msg_zy_1.sport') }}</option>
                                                    <option value="CP">{{ __('msg_zy_1.lottery') }}</option>
                                                    <option value="QP">{{ __('msg_zy_1.cardgame') }}</option>
                                                    <option value="BY">{{ __('msg_zy_1.fishing').__('msg_zy_1.game') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-auto my-1">
                                                <div class="ant-calendar-picker-input ant-input-sm">
                                                    <vue-datepicker-local v-model="range" placeholder="{{ __('msg_zy_1.start') . __('msg_zy_1.date') }}"  tabindex="-1" style="color:initial" @input="change_date()" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                                    <span class="ant-calendar-picker-icon"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto my-1">
                                                <button type="submit" class="btn btn-warning btn-sm" @click="only_win()" v-if="onlywin === 0">{{ __('msg_zy_1.only_win') }}</button>
                                                <button type="submit" class="btn btn-warning btn-sm" @click="all_data()" v-if="onlywin === 1">{{ __('msg_zy_1.view_all') }}</button>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-auto my-1 text-gold">
                                                {{ __('msg_zy_1.single_page_bet_money') }}：@{{record_page_bet_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_zy_1.single_page_net_money') }}：@{{record_page_net_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_zy_1.total_count') }}：@{{record_total_count}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_zy_1.total_bet_money') }}：@{{record_bet_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_zy_1.total_net_money') }}：@{{record_net_total}}
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="10%">{{ __('msg_zy_1.platform') }}</th>
                                                    <th scope="col" width="15%">{{ __('msg_zy_1.note_no') }}</th>
                                                    <th scope="col" width="15%">{{ __('msg_zy_1.game') }}</th>
                                                    <th scope="col" width="10%">{{ __('msg_zy_1.type') }}</th>
                                                    <th scope="col" width="10%">{{ __('msg_zy_1.betting') . __('msg_zy_1.amount') }}</th>
                                                    <th scope="col" width="10%">{{ __('msg_zy_1.winning') }}</th>
                                                    <th scope="col" width="10%">{{ __('msg_zy_1.total_amount') }}</th>
                                                    <th scope="col" width="15%">{{ __('msg_zy_1.time') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody ref="showList">
                                                <tr v-if="hasdata === 1" v-for="gamedata in gamedatas">
                                                    <td>@{{ gamedata.gamePlatform }}</td>
                                                    <td style="word-wrap: break-word;word-break: break-all;">@{{ gamedata.orderId }}</td>
                                                    <td style="word-wrap: break-word;word-break: break-all;">@{{ gamedata.gamename }}</td>
                                                    <td>@{{ gamedata.gameBigType }}</td>
                                                    <td style="text-align: right">@{{ gamedata.betMoney }}</td>
                                                    <td style="text-align: right">@{{ gamedata.netMoney }}</td>
                                                    <td style="text-align: right">@{{ gamedata.settleamount }}</td>
                                                    <td>@{{ gamedata.betDay }}</td>
                                                </tr>
                                                <tr v-if="hasdata === 0">
                                                    <td colspan="8" scope="row" class="text-center border-bottom">No data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--   分頁 -->
                                    <nav aria-label="Page navigation example" class="slot-page">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item" :class="{'disabled': show_first === 0}">
                                                <a class="page-link" href="#" aria-label="Previous" @click="go_first('show_history')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-left fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_zy_1.first_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item" :class="{'disabled': show_pre === 0}">
                                                <a class="page-link" href="#" aria-label="Previous" @click="go_pre('show_history')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-left fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_zy_1.previous_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item" :class="{'disabled': pg === pg1}"><a class="page-link" href="#" ref="pg1" @click="go_page(pg1, 'show_history')" v-if="show_pg1 === 1">@{{ pg1 }}</a></li>
                                            <li class="page-item" :class="{'disabled': pg === pg2}"><a class="page-link" href="#" ref="pg2" @click="go_page(pg2, 'show_history')">@{{ pg2 }}</a></li>
                                            <li class="page-item" :class="{'disabled': pg === pg3}"><a class="page-link" href="#" ref="pg3" @click="go_page(pg3, 'show_history')" v-if="show_pg3 === 1">@{{ pg3 }}</a></li>
                                            <li class="page-item" :class="{'disabled': show_next === 0}">
                                                <a class="page-link" href="#" aria-label="Next" @click="go_next('show_history')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-right fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_zy_1.next_page') }}</span>
                                                </a>
                                            </li>                                                                      
                                            <li class="page-item" :class="{'disabled': show_last === 0}">
                                                <a class="page-link" href="#" aria-label="Next" @click="go_last('show_history')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                                                    <span class="sr-only">{{ __('msg_zy_1.last_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item">
                                                <select @change="select_go_page('show_history')" v-model="ddl_page" class="form-control mt-2 ml-2">
                                                    <option :value="v" v-for="v in maxPage">第@{{v}}頁</option>                                
                                                </select>
                                            </li>
                                        </ul>
                                    </nav>
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
        var app = new Vue({
            el : '#show_records',
            data : {
                gamenames : [
                    {
                        id: 'nodata',
                        name: '<?php echo __("msg_zy_1.game") . __("msg_zy_1.platform"); ?>'
                    }
                ],
                gamedatas : [],
                range: [new Date(), new Date()],
                local : {
                    hourTip: '<?php echo __("msg_zy_1.sel_hours"); ?>',
                },
                gname: 'nodata',
                gtype: 'nodata',
                hasdata: 0,
                perpage: 15,
                minPage: 1,
                maxPage: 1,
                show_first: 0,
                show_pre: 0,
                show_pg1: 0,
                show_pg3: 0,
                show_next: 0,
                show_last: 0,
                pg: 1,
                pg1: 1,
                pg2: 2,
                pg3: 3,
                onlywin: 0,
                ddl_page : 1,
                record_bet_total : 0,
                record_net_total : 0,
                record_page_bet_total : 0,
                record_page_net_total : 0,
                record_total_count : 0
            },
            created: function(){

                this.range = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_game_type();
                        self.show_records_data();
                        self.getPage('show_history');
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
                change_game_type: function(){

                    this.set_default();
                    this.show_records_data();

                },
                change_date: function(){

                    this.set_default();
                    this.show_records_data();

                },
                show_records_data: function(){

                    this.record_total_count = 0;
                    this.record_bet_total = 0;
                    this.record_net_total = 0;
                    this.record_page_bet_total = 0;
                    this.record_page_net_total = 0;

                    var dt1 = this.formateDate(this.range[0]);
                    var dt2 = this.formateDate(this.range[1]);
                    this.gamedatas = [];
                    var data_start = (this.pg - 1) * this.perpage;
                    var ApiURL = API_Host + '/game/get_recordsall/' + data_start + '/' + this.perpage + '/' + this.gname + '/' + this.gtype + '/' + dt1 + '/' + dt2 + '/' + this.onlywin;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            var rtnData = this.json['info'];
                            if(rtnData['count'] > 0){

                                self.record_total_count = numFormat(rtnData['count']);
                                self.record_bet_total = (rtnData['betMoneyAll']);
                                self.record_net_total = (rtnData['netMoneyAll']);

                                self.maxPage = Math.ceil(rtnData['count'] / self.perpage);
                                self.hasdata = 1;

                                var tmp_betMoney = 0;
                                var tmp_netMoney = 0;
                                var tmp_settleamount = 0;

                                $.each(rtnData['record'], function(key, value){
                                    var bigType = '';
                                    switch(value['gamebigtype']){
                                        case 'SX':
                                            bigType = '<?php echo __("msg_zy_1.real_casino"); ?>';
                                            break;
                                        case 'DZ':
                                            bigType = '<?php echo __("msg_zy_1.slots"); ?>';
                                            break;
                                        case 'TY':
                                            bigType = '<?php echo __("msg_zy_1.sport"); ?>';
                                            break;
                                        case 'CP':
                                            bigType = '<?php echo __("msg_zy_1.lottery"); ?>';
                                            break;
                                        case 'QP':
                                            bigType = '<?php echo __("msg_zy_1.cardgame"); ?>';
                                            break;
                                        case 'BY':
                                            bigType = '<?php echo __("msg_zy_1.fishing").__("msg_zy_1.game"); ?>';
                                            break;
                                    }

                                    if(value['status'] == '未結算'){
                                        tmp_settleamount = '未結算';
                                    }else{
                                        tmp_settleamount = value['settleamount'];
                                    }
                                    
                                    self.gamedatas.push({gamePlatform: value['gametype'], orderId: value['orderId'], gameBigType: bigType, betMoney: formatMoney(value['betmoney']), netMoney: formatMoney(value['netmoney']), betDay: value['bettime'], gamename: value['gamename'], settleamount: tmp_settleamount});

                                    tmp_betMoney += parseFloat(value['betmoney']);
                                    tmp_netMoney += parseFloat(value['netmoney']);
                                });

                                self.record_page_bet_total = formatMoney(tmp_betMoney);
                                self.record_page_net_total = formatMoney(tmp_netMoney);
                            }else{
                                self.hasdata = 0;
                                self.maxPage = 1;                                
                            }
                            self.getPage('show_history');
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                formateDate: function(date){

                    var rtndata = '';

                    var d = new Date(date), month = '' + (d.getMonth() + 1), day = '' + d.getDate(), year = d.getFullYear(), hours = d.getHours(), minutes = d.getMinutes(), seconds = d.getSeconds();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    rtndata = [year, month, day].join('-');
                    rtndata += ' ' + [hours, minutes, seconds].join(':');;

                    return rtndata;

                },
                formatDateDefault: function(range_type){

                    var rtndata = '';

                    var d = new Date(), month = '' + (d.getMonth() + 1), day = '' + d.getDate(), year = d.getFullYear();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    rtndata = [year, month, day].join('/');
                    if(range_type == 's'){
                        rtndata += ' 00:00:00';
                    }else{
                        rtndata += ' 23:59:59';
                    }
                    
                    return rtndata;

                },
                only_win: function(){

                    this.onlywin = 1;
                    this.pg = 1;
                    this.show_records_data();

                },
                all_data: function(){

                    this.onlywin = 0;
                    this.pg = 1;
                    this.show_records_data();

                },
                set_default: function(){

                    this.record_total_count = 0;
                    this.record_bet_total = 0;
                    this.record_net_total = 0;
                    this.record_page_bet_total = 0;
                    this.record_page_net_total = 0;
                    this.hasdata = 0;
                    this.maxPage = 1;
                    this.show_first = 0;
                    this.show_pre = 0;
                    this.show_pg1 = 0;
                    this.show_pg3 = 0;
                    this.show_next = 0;
                    this.show_last = 0;
                    this.pg = 1;
                    this.onlywin = 0;
                    this.ddl_page = 1;

                }
            }
        });
    </script>
</html>
