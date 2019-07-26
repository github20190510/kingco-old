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
        <div class="main membe-box" id="show_details">
            <div class="content">
                <div class="main_member">
                    @include($mb_info_head)
                    <div class="container user-bd">
                        <div class="row">
                            @include($mb_info_left)
                            <div class="col-md-10 middle-history text-left mt-2">
                                <div class="user-edit-module">
                                    <div class="msg-tab">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true" @click="set_default(0)"><i class="far fa-credit-card fa-sm  mr-1"></i> {{ __('msg_dt_1.acc_change') . __('msg_dt_1.record') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="set_default(1)"><i class="fas fa-money-check-alt fa-sm mr-1"></i> {{ __('msg_dt_1.recharge') . __('msg_dt_1.record') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex align-items-center" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" @click="set_default(2)"><i class="fas fa-hand-holding-usd fa-sm  mr-1"></i>{{ trans_choice('msg_dt_1.withdraw', 1) . __('msg_dt_1.record') }}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <!--帐变记录 Start-->
                                            <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                                                <div>
                                                    <div class="form-row my-2">
                                                        <div class="col-auto my-1">
                                                            <div class="ant-calendar-picker-input ant-input-sm">
                                                                <vue-datepicker-local v-model="range" placeholder="{{ __('msg_dt_1.start') . __('msg_dt_1.date') }}"  tabindex="-1" style="color:initial" @input="show_change_data" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto my-1">
                                                            <label class="mr-sm-2 sr-only">{{ __('msg_dt_1.acc_change') . __('msg_dt_1.type') }}</label>
                                                            <select class="custom-select custom-select-sm mr-sm-2" v-model="ddlchangetype" @change="show_change_data">
                                                                <option value="nodata">{{ __('msg_dt_1.acc_change') . __('msg_dt_1.type') }}</option>
                                                                <option value="8D37FD20D92043FA8D856590F0DFED0F">{{ __('msg_dt_1.deposit') }}</option>
                                                                <option value="8CD5E45210A44F3287CF2C0D7C61703E">{{ trans_choice('msg_dt_1.withdraw', 1) }}</option>
                                                                <option value="AF0B2F04CCA64E3197F047402FEE5832">{{ __('msg_dt_1.game_points_up') }}</option>
                                                                <option value="2BC2CB7FDD7B4720906B56812E075F94">{{ __('msg_dt_1.game_points_down') }}</option>
                                                                <option value="D6B0C11A0AC44EBBB1538BE69B004811">{{ __('msg_dt_1.promotion') }}</option>
                                                                <option value="1A53AEC4179E4E46AEE7EE752C16E3B1">{{ __('msg_dt_1.set_positive') }}</option>
                                                                <option value="831F252CEAE94DD0A740260EE151A437">{{ __('msg_dt_1.set_negative') }}</option>
                                                            </select>
                                                        </div>                                                    
                                                    </div>
                                                    <div>
                                                        <div class="col-auto my-1 text-gold">
                                                            {{ __('msg_dt_1.single_page_money') }}：@{{change_page_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_count') }}：@{{change_total_count}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_money') }}：@{{change_total}}
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-left">{{ __('msg_dt_1.date') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.reason') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.acc_change') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.balance') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.detail') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             <tr v-if="bln_has_change_data === 1" v-for="changedata in changedatas">
                                                                <td>@{{ changedata.moneychangedate }}</td>
                                                                <td>@{{ changedata.moneychangetypename }}</td>
                                                                <td style="text-align: right">@{{ formatMoney(changedata.moneychangeamount) }}</td>
                                                                <td style="text-align: right">@{{ formatMoney(changedata.afteramount) }}</td>
                                                                <td>@{{ changedata.moneyinoutcomment }}</td>
                                                            </tr>
                                                            <tr v-if="bln_has_change_data === 0">
                                                                <td colspan="5" scope="row" class="text-center border-bottom">No data</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--帐变记录 End-->
                                            <!--充值记录 Start-->
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div>
                                                    <div class="form-row my-2">
                                                        <div class="col-auto my-1">
                                                            <div class="ant-calendar-picker-input ant-input-sm">
                                                                <vue-datepicker-local v-model="range2" placeholder="{{ __('messate.start') . __('msg_dt_1.date') }}"  tabindex="-1" style="color:initial" @input="show_save_order" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto my-1">
                                                            <label class="mr-sm-2 sr-only">{{ __('msg_dt_1.order') . __('msg_dt_1.status') }}</label>
                                                            <select class="custom-select custom-select-sm mr-sm-2" v-model="ddlsavetype" @change="show_save_order">
                                                                <option value="1">{{ __('msg_dt_1.processing') }}</option>
                                                                <option value="2">{{ __('msg_dt_1.processed') }}</option>
                                                                <option value="3">{{ __('msg_dt_1.turn_down') }}</option>
                                                                <option value="4">{{ __('msg_dt_1.refuse') }}</option>
                                                                <option value="5">{{ __('msg_dt_1.pending_payment') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="col-auto my-1 text-gold">
                                                            {{ __('msg_dt_1.single_page_money') }}：@{{save_page_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_count') }}：@{{save_total_count}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_money') }}：@{{save_total}}
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-left">{{ __('msg_dt_1.date') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.order_no') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.amount') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.order') . __('msg_dt_1.remark') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-if="bln_has_save_data === 1" v-for="savedata in savedatas">
                                                                <th scope="row" class="text-left">@{{savedata.orderdate}}</th>
                                                                <td>@{{savedata.ordernumber}}</td>
                                                                <td style="text-align: right"><span class="font-weight-bold text-warning">@{{ formatMoney(savedata.orderamount) }}</span></td>
                                                                <td>@{{savedata.ordercomment}}</td>
                                                            </tr>
                                                            <tr v-if="bln_has_save_data === 0">
                                                                <td colspan="4" scope="row" class="text-center border-bottom">No data</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--充值记录 End-->
                                            <!--取款记录 Start-->
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                <div>
                                                    <div class="form-row my-2">
                                                        <div class="col-auto my-1">
                                                            <div class="ant-calendar-picker-input ant-input-sm">
                                                                <vue-datepicker-local v-model="range3" placeholder="{{ __('msg_dt_1.start') . __('msg_dt_1.date') }}"  tabindex="-1" style="color:initial" @input="show_take_order()" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto my-1">
                                                            <label class="mr-sm-2 sr-only">{{ __('msg_dt_1.order') . __('msg_dt_1.status') }}</label>
                                                            <select class="custom-select custom-select-sm mr-sm-2" v-model="ddltaketype" @change="show_take_order">
                                                                <option value="1">{{ __('msg_dt_1.processing') }}</option>
                                                                <option value="2">{{ __('msg_dt_1.processed') }}</option>
                                                                <option value="3">{{ __('msg_dt_1.turn_down') }}</option>
                                                                <option value="4">{{ __('msg_dt_1.refuse') }}</option>
                                                                <option value="5">{{ __('msg_dt_1.pending_payment') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="col-auto my-1 text-gold">
                                                            {{ __('msg_dt_1.single_page_money') }}：@{{take_page_total}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_count') }}：@{{take_total_count}}&nbsp;&nbsp;&nbsp;&nbsp;{{ __('msg_dt_1.total_money') }}：@{{take_total}}
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-left">{{ __('msg_dt_1.date') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.order_no') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.amount') }}</th>
                                                                <th scope="col">{{ __('msg_dt_1.order') . __('msg_dt_1.remark') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-if="bln_has_take_data === 1" v-for="takedata in takedatas">
                                                                <th scope="row" class="text-left">@{{takedata.orderdate}}</th>
                                                                <td>@{{takedata.ordernumber}}</td>
                                                                <td style="text-align: right"><span class="font-weight-bold text-warning">@{{ formatMoney(takedata.orderamount) }}</span></td>
                                                                <td>@{{takedata.ordercomment}}</td>
                                                            </tr>
                                                            <tr v-if="bln_has_take_data === 0">
                                                                <td colspan="4" scope="row" class="text-center border-bottom">No data</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--取款记录 End-->
                                        </div>
                                    </div>
                                    <!--   分頁 -->
                                    <nav aria-label="Page navigation example" class="slot-page">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item" :class="{'disabled': show_first === 0}">
                                                <a class="page-link" href="#" aria-label="Previous" @click="go_first('mb_details')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-left fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_dt_1.first_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item" :class="{'disabled': show_pre === 0}">
                                                <a class="page-link" href="#" aria-label="Previous" @click="go_pre('mb_details')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-left fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_dt_1.previous_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item" :class="{'disabled': pg === pg1}"><a class="page-link" href="#" ref="pg1" @click="go_page(pg1, 'mb_details')" v-if="show_pg1 === 1">@{{ pg1 }}</a></li>
                                            <li class="page-item" :class="{'disabled': pg === pg2}"><a class="page-link" href="#" ref="pg2" @click="go_page(pg2, 'mb_details')">@{{ pg2 }}</a></li>
                                            <li class="page-item" :class="{'disabled': pg === pg3}"><a class="page-link" href="#" ref="pg3" @click="go_page(pg3, 'mb_details')" v-if="show_pg3 === 1">@{{ pg3 }}</a></li>
                                            <li class="page-item" :class="{'disabled': show_next === 0}">
                                                <a class="page-link" href="#" aria-label="Next" @click="go_next('mb_details')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-right fa-lg"></i></span>
                                                    <span class="sr-only">{{ __('msg_dt_1.next_page') }}</span>
                                                </a>
                                            </li>                                                                      
                                            <li class="page-item" :class="{'disabled': show_last === 0}">
                                                <a class="page-link" href="#" aria-label="Next" @click="go_last('mb_details')">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                                                    <span class="sr-only">{{ __('msg_dt_1.last_page') }}</span>
                                                </a>
                                            </li>
                                            <li class="page-item">
                                                <select @change="select_go_page('mb_details')" v-model="ddl_page" class="form-control mt-2 ml-2">
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
        var show_details = new Vue({
            el: '#show_details',
            data: {
                changedatas: {},
                savedatas: {},
                takedatas:{},
                range: [new Date(), new Date()],
                range2: [new Date(), new Date()],
                range3: [new Date(), new Date()],
                bln_has_change_data: 0,
                bln_has_save_data: 0,
                bln_has_take_data: 0,
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
                ddlchangetype: 'nodata',
                show_type: 0,
                ddlsavetype: 1,
                ddltaketype: 1,
                ddl_page : 1,
                change_total : 0,
                change_page_total : 0,
                change_total_count : 0,
                save_total : 0,
                save_page_total : 0,
                save_total_count : 0,
                take_total : 0,
                take_page_total : 0,
                take_total_count : 0

            },
            created: function(){
                
                this.range = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                this.range2 = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                this.range3 = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.show_change_data();
                    }
                }, 500);

            },
            methods: {
                set_default: function(showtype){

                    this.pg = 1;
                    this.pg1 = 1;
                    this.pg2 = 1;
                    this.pg3 = 1;
                    this.maxPage = 1;
                    this.show_first = 0;
                    this.show_pre = 0;
                    this.show_next = 0;
                    this.show_last = 0;
                    this.show_pg1 = 0;
                    this.show_pg3 = 0;
                    this.range = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                    this.range2 = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                    this.range3 = [this.formatDateDefault('s'), this.formatDateDefault('e')];
                    this.ddlchangetype = 'nodata';
                    this.ddlsavetype = 1;
                    this.ddltaketype = 1;
                    this.changedatas = {};
                    this.savedatas = {};
                    this.takedatas = {};
                    this.change_total = 0;
                    this.change_page_total = 0;
                    this.change_total_count = 0;
                    this.save_total = 0;
                    this.save_page_total = 0;
                    this.save_total_count = 0;
                    this.take_total = 0;
                    this.take_page_total = 0;
                    this.take_total_count = 0;

                    switch(showtype){
                        case 1:
                            this.show_type = 1
                            this.show_save_order();
                        break;
                        case 2:
                            this.show_type = 2;
                            this.show_take_order();
                        break;
                        default:
                            this.show_type = 0;
                            this.show_change_data();
                        break;
                    }

                },
                show_change_data: function(){

                    this.change_total = 0;
                    this.change_page_total = 0;
                    this.change_total_count = 0;

                    var dt1 = this.formateDate(this.range[0]);
                    var dt2 = this.formateDate(this.range[1]);

                    var data_start = (this.pg - 1) * this.perpage;

                    var ApiURL = API_Host + '/mb/findaccountchange/' + data_start + '/' + this.perpage + '/' + dt1 + '/' + dt2 + '/' + this.ddlchangetype;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            var rtnData = this.json['info'];
                            var temp_money = 0;

                            self.change_total_count = numFormat(rtnData['count']);

                            if(rtnData['count'] != 0){
                                self.bln_has_change_data = 1;
                                self.changedatas = rtnData['record'];

                                $.each(self.changedatas, function(k, v){
                                    var need_substr = /\S+:\S+\s/g.exec(v['moneyinoutcomment']);
                                    
                                    if (need_substr != null) {
                                        self.changedatas[k]['moneyinoutcomment'] = v['moneyinoutcomment'].substr(need_substr[0].length);
                                    }else{
                                        var acc_substr = /\S+:egg/g.exec(v['moneyinoutcomment']);
                                        if (acc_substr != null) {
                                            var str = acc_substr[0];
                                            var count = v['moneyinoutcomment'].length - acc_substr[0].length;
                                            for(var i=0; i<count; i++ ) {
                                                str += '*';
                                            }
                                            self.changedatas[k]['moneyinoutcomment'] = str;
                                        }
                                    }
                                });

                                self.maxPage = Math.ceil(rtnData['count'] / self.perpage);

                                $.each(rtnData['record'], function(k, v){
                                    temp_money += v['moneychangeamount'];
                                });

                                self.change_total = formatMoney(rtnData['sumamount']);
                                self.change_page_total = formatMoney(temp_money);

                            }else{
                                self.bln_has_change_data = 0;
                                self.maxPage = 1;
                            }
                            self.getPage();
                        }else{
                            self.alertinfo(this.json['info'], '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                show_save_order: function(){

                    this.save_total = 0;
                    this.save_page_total = 0;
                    this.save_total_count = 0;

                    var dt1 = this.formateDate(this.range2[0]);
                    var dt2 = this.formateDate(this.range2[1]);

                    var data_start = (this.pg - 1) * this.perpage;

                    var ApiURL = API_Host + '/mb/saveorder/' + this.ddlsavetype + '/' + data_start + '/' + this.perpage + '/' + dt1 + '/' + dt2;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            var rtnData = this.json['info'];

                            var temp_money = 0;

                            self.save_total_count = numFormat(rtnData['count']);

                            if(rtnData['count'] != 0){
                                self.bln_has_save_data = 1;
                                self.savedatas = rtnData['record'];
                                self.maxPage = Math.ceil(rtnData['count'] / self.perpage);

                                $.each(rtnData['record'], function(k, v){
                                    temp_money += v['orderamount'];
                                });

                                self.save_total = formatMoney(rtnData['sumamount']);
                                self.save_page_total = formatMoney(temp_money);

                            }else{
                                self.bln_has_save_data = 0;
                                self.maxPage = 1;
                            }
                            self.getPage();
                        }else{
                            self.alertinfo(this.json['info'], '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                show_take_order: function(){

                    this.take_total = 0;
                    this.take_page_total = 0;
                    this.take_total_count = 0;

                    var dt1 = this.formateDate(this.range3[0]);
                    var dt2 = this.formateDate(this.range3[1]);

                    var data_start = (this.pg - 1) * this.perpage;

                    var ApiURL = API_Host + '/mb/takeorder/' + this.ddltaketype + '/' + data_start + '/' + this.perpage + '/' + dt1 + '/' + dt2;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            var rtnData = this.json['info'];

                            var temp_money = 0;

                            self.take_total_count = numFormat(rtnData['count']);

                            if(rtnData['count'] != 0){
                                self.bln_has_take_data = 1;
                                self.takedatas = rtnData['record'];
                                self.maxPage = Math.ceil(rtnData['count'] / self.perpage);

                                $.each(rtnData['record'], function(k, v){
                                    temp_money += v['orderamount'];
                                });

                                self.take_total = formatMoney(rtnData['sumamount']);
                                self.take_page_total = formatMoney(temp_money);

                            }else{
                                self.bln_has_take_data = 0;
                                self.maxPage = 1;
                            }
                            self.getPage();
                        }else{
                            self.alertinfo(this.json['info'], '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

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
                formateDate: function(date){

                    var rtndata = '';

                    var d = new Date(date), month = '' + (d.getMonth() + 1), day = '' + d.getDate(), year = d.getFullYear(), hours = d.getHours(), minutes = d.getMinutes(), seconds = d.getSeconds();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    rtndata = [year, month, day].join('-');
                    rtndata += ' ' + [hours, minutes, seconds].join(':');;

                    return rtndata;

                },
                get_data: function(){

                    switch(this.show_type){
                        case 1:
                            this.show_save_order();
                        break;
                        case 2:
                            this.show_take_order();
                        break;
                        default:
                            this.show_change_data();
                        break;
                    }

                }
            }
        });
    </script>
</html>
