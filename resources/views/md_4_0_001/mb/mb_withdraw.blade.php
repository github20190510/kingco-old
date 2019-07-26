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
        <div class="main membe-box" id="mb_withdraw">
            <div class="content">
                <div class="main_member">
                    @include($mb_info_head)
                    <div class="container user-bd">
                        <div class="row">
                            @include($mb_info_left)
                            <div class="col-md-10 middle text-left mt-2">
                                <div class="user-edit-module">
                                    <div class="mem-title">
                                        <h5 class="d-flex align-items-center"><span class="title-icon withdrawal-icon mr-2"></span><i class="fas fa-hand-holding-usd mr-2"></i> {{ trans_choice('msg_dt_1.withdraw', 1) }}</h5>
                                    </div>
                                    <div class="w-50">
                                        <div class="form-group row">
                                            <label for="bankAccount" class="col-sm-3 col-form-label">{{ __('msg_dt_1.new_back') }}:</label>
                                            <div class="col-sm-9">
                                                 <select class="custom-select my-1 mr-sm-2" id="bankAccount" v-model="bank_value">
                                                    <option v-for="(val, key) in bank_datas" :value="key">@{{val}}</option>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="branchBank" class="col-sm-3 col-form-label">{{ __('msg_dt_1.withdrawal') . __('msg_dt_1.amount') }}:</label>
                                            <div class="col-sm-9 my-1">
                                                <input type="number" class="form-control mem_input" id="branchBank" placeholder="{{ __('msg_dt_1.input_wd_amount') }}" min="0" v-model="get_money">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="paymentPassword" class="col-sm-3 col-form-label">{{ __('msg_dt_1.pay_pwd') }}:</label>
                                            <div class="col-sm-9 my-1">
                                                <input type="password" class="form-control mem_input" id="paymentPassword" placeholder="{{ __('msg_dt_1.input_pay_pass') }}" v-model="pay_pwd">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="paymentPassword" class="col-sm-3 col-form-label">{{ __('msg_dt_1.mb_comments') }}:</label>
                                            <div class="col-sm-9 my-1">
                                                <input type="text" class="form-control mem_input" id="paymentMsg" placeholder="{{ __('msg_dt_1.input_mb_comments') }}" v-model="pay_msg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="savbtn w-50 text-right" v-if="bln_can_send == 0" style="color:red">
                                        {{ __('msg_dt_1.should_bet') }}：@{{int_should_money}} {{ __('msg_dt_1.already_bet') }}：@{{int_bet_money}}
                                    </div>
                                    <div class="savbtn w-50 text-right" v-if="bln_can_send == 1">
                                        <button type="button" class="btn btn-warning px-5" @click="get_money_account" :disabled="if_send_or_not == true">@{{button_string}}</button>
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
        var mb_withdraw = new Vue({
            el: '#mb_withdraw',
            data:{
                bank_datas: {},
                bank_value: '',
                get_money: '',
                pay_pwd: '',
                pay_msg: '',
                if_send_or_not: false,
                loading_id: 0,
                button_string: '<?php echo __("msg_dt_1.submit"); ?>',
                bln_can_send: 0,
                int_should_money: 0,
                int_bet_money: 0
            },
            created: function(){

                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.show_take_order();
                    }
                }, 500);

            },
            watch: {
                if_send_or_not: function(val){
                    if (val){
                        var count = 0;
                        mb_withdraw.button_string = '<?php echo __("msg_dt_1.dealing_with_deposit_order"); ?>';
                        mb_withdraw.loading_id = setInterval(function(){
                            if (count < 3){
                                mb_withdraw.button_string +=".";
                                count += 1;
                            }else{
                                count = 0;
                                mb_withdraw.button_string = '<?php echo __("msg_dt_1.dealing_with_deposit_order"); ?>';
                            }
                        },300)
                    }else{
                        mb_withdraw.button_string = '<?php echo __("msg_dt_1.submit"); ?>';
                        if (mb_withdraw.loading_id != ""){
                            clearInterval(mb_withdraw.loading_id);
                            mb_withdraw.loading_id = "";
                        }
                    }
                }
            },
            methods: {
                get_money_account: function(){

                    var paymsg = '';

                    if(this.get_money == ''){
                        this.alertinfo('<?php echo __("msg_dt_1.input_wd_amount"); ?>!');
                        return false;
                    }

                    if(this.pay_pwd == ''){
                        this.alertinfo('<?php echo __("msg_dt_1.input_pay_pass"); ?>');
                        return false;
                    }

                    if(this.pay_msg == ''){
                        paymsg = 'nodata';
                    }else{
                        paymsg = this.pay_msg;
                    }

                    var ApiURL = API_Host + '/mb/takingmoney/' + this.get_money + '/' + paymsg + '/' + this.bank_value + '/' + this.pay_pwd;
                    Vue.prototype.$http = axios;
                    var self = this;
                    self.if_send_or_not = true;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.if_send_or_not = false;
                            self.alertinfo('<?php echo __("msg_dt_1.waiting_review") ?>');
                            self.getbagmoney();
                        }else{
                            self.if_send_or_not = false;
                            self.alertinfo(this.json['info']);
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                show_take_order: function(){

                    var ApiURL = API_Host + '/mb/ubankcards';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length == 0){
                                self.alertinfo('<?php echo __("msg_dt_1.no_binding_card"); ?>!', '/mb/bank_card');
                                return;
                            }else{
                                rtn_data = {};
                                $.each(this.json['info'], function(k, v){
                                    //rtn_data[v['informationcode']] = v['accountname'] + '_' + v['bankname'] + '_' + + v['paymentaccount'];
                                    if(v['status'] == '1'){
                                        rtn_data[v['informationcode']] = v['bankname'] + '_' + v['paymentaccount'];
                                        if(self.bank_value == ''){
                                            self.bank_value = v['informationcode'];
                                        }else{
                                            if(v['infomationcomment'] == '<?php echo __('msg_dt_1.default'); ?>'){
                                                self.bank_value = v['informationcode'];
                                            }
                                        }
                                    }
                                });
                                self.bank_datas = rtn_data;
                                self.get_inspection();

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
                get_inspection: function(){

                    var ApiURL = API_Host + '/mb/inspection';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
    
                            self.int_should_money = this.json['info']['needWager'];
                            self.int_bet_money = this.json['info']['totalBet'];
                            if(this.json['info']['remainder'] == '0' && self.int_should_money != '0'){
                                self.bln_can_send = 1;
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
</html>
