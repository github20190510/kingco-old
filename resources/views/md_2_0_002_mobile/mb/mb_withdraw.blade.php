<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_withdraw">
            <main role="main" class="container main bank-main">
                <form class="needs-validation" novalidate onSubmit="return false;">
                    <section class="input-group register-input dropdown-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-university fa-fw mr-1"></i> {{ __('msg_zy_1.new_back') }}</label>
                        </div>
                        <div class="input-group-append dropdown-right">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btn_bank">{{ __('msg_zy_1.select_bank_card') }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" v-for="(val, key) in bank_datas" @click="change_select_bank(val, key)">@{{val}}</a>
                            </div>
                        </div>
                    </section>
                    
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-hand-holding-usd fa-fw"></i></span>
                        </div>
                        <input type="number" class="form-control border-left-0 bg-transparent" id="bankid" placeholder="{{ __('msg_zy_1.withdrawal') . __('msg_zy_1.amount') }} : {{ __('msg_zy_1.input_wd_amount') }}" required v-model="get_money">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_wd_amount') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 bg-transparent" id="password" placeholder="{{ __('msg_zy_1.pay_pwd') }} : {{ __('msg_zy_1.input_pay_pass') }}" required v-model="pay_pwd">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_pay_pass') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-comment-dots fa-fw"></i></span>
                        </div>
                        <textarea class="form-control border-left-0 bg-transparent" id="msg" placeholder="{{ __('msg_zy_1.mb_comments') }} : {{ __('msg_zy_1.input_mb_comments') }}" v-model="pay_msg" aria-label="With textarea"></textarea>
                    </div>                     
                    <div v-if="bln_can_send == 0" style="color:red">{{ __('msg_zy_1.should_bet') }}：@{{int_should_money}} {{ __('msg_zy_1.already_bet') }}：@{{int_bet_money}}</div>   
                    <button v-if="bln_can_send == 1" type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn mb-3" @click="get_money_account" :disabled="if_send_or_not == true">@{{button_string}}</button>
                </form>
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
                button_string: '<?php echo __("msg_zy_1.submit"); ?>',
                bln_can_send: 0,
                int_should_money: 0,
                int_bet_money: 0
            },
            created: function(){

                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_withdraw_data();
                    }
                }, 500);

            },
            watch: {
                if_send_or_not: function(val){
                    if (val){
                        var count = 0;
                        mb_withdraw.button_string = '<?php echo __("msg_zy_1.dealing_with_deposit_order"); ?>';
                        mb_withdraw.loading_id = setInterval(function(){
                            if (count < 3){
                                mb_withdraw.button_string +=".";
                                count += 1;
                            }else{
                                count = 0;
                                mb_withdraw.button_string = '<?php echo __("msg_zy_1.dealing_with_deposit_order"); ?>';
                            }
                        },300)
                    }else{
                        mb_withdraw.button_string = '<?php echo __("msg_zy_1.submit"); ?>';
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
                        this.alertinfo('<?php echo __("msg_zy_1.input_wd_amount"); ?>!');
                        return false;
                    }

                    if(this.pay_pwd == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.input_pay_pass"); ?>');
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
                            self.alertinfo('<?php echo __("msg_zy_1.waiting_review") ?>', '/mb/mb_index');
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
                change_select_bank: function(strbank, bankcode){

                    $('#btn_bank').html(strbank);
                    this.bank_value = bankcode;

                },
                get_withdraw_data: function(){

                    var ApiURL = API_Host + '/mb/ubankcards';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length == 0){
                                self.alertinfo('<?php echo __("msg_zy_1.no_binding_card"); ?>!', '/mb/bank_card');
                                return;
                            }else{
                                rtn_data = {};
                                $.each(this.json['info'], function(k, v){
                                    if(v['status'] == '1'){
                                        rtn_data[v['informationcode']] = v['bankname'] + '_' + v['paymentaccount'];
                                        if(self.bank_value == ''){
                                            self.bank_value = v['informationcode'];
                                        }else{
                                            if(v['infomationcomment'] == '<?php echo __('msg_zy_1.default'); ?>'){
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
    </body>
</html>
