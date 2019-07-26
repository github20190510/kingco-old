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
        <div class="container" id="mb_deposit">
            <div class="main_member">
                @include($mb_info_head)
                <div class="container user-bd">
                    <div class="row">
                        @include($mb_info_left)
                        <div class="col-md-10 middle text-left mt-2">
                            <div class="deposit-module">
                                <div class="deposit-box">
                                    <div class="box-hd">
                                        <div class="tips">
                                            <div>
                                                <div class="mem-info-title">
                                                    <h5 class="d-flex align-items-center"><i class="far fa-credit-card mr-2 fa-fw"></i> {{ __('msg_dt_1.emp_card') }}</h5>
                                                </div>
                                                <div class="grid-bd mr-2">
                                                    <div class="row mb-3 d-flex" v-if="if_have_bind_bank_card != undefined">
                                                        <div class="col-3 mb-3" v-for="emp_card in emp_cards">
                                                            <div class="btn btn-light bank-btn" :class="{selected: emp_card.enterpriseinformationcode == thirdid}" @click="change_emp_code(emp_card.enterpriseinformationcode, emp_card.bankcode, emp_card.openningbank, emp_card.bankname)"><span class="circle-icon"><i class="fas fa-dollar-sign bank-icon"></i></span>@{{emp_card.bankname}}</div>
                                                        </div>
                                                        <!--
                                                            原本要拿來接Cloud qrcode用的api 後來整合至取銀行卡的api 3/19
                                                        -->
                                                        <!-- <div class="col-3 mb-3" v-for="offline_pay in offline_pays">
                                                            <div v-if="offline_pay.qrtype == 1" class="btn btn-light bank-btn" :class="{selected: offline_pay.lsh == thirdid}" @click="change_emp_code(offline_pay.lsh,2,1)"><span class="circle-icon"><i class="fas fa-dollar-sign bank-icon"></i></span>{{ __('msg_dt_1.wechat') }}</div>
                                                            <div v-if="offline_pay.qrtype == 2" class="btn btn-light bank-btn" :class="{selected: offline_pay.lsh == thirdid}" @click="change_emp_code(offline_pay.lsh,2,2)"><span class="circle-icon"><i class="fas fa-dollar-sign bank-icon"></i></span>{{ __('msg_dt_1.alipay') }}</div>
                                                        </div> -->
                                                        <!--
                                                            原本要拿來接Cloud qrcode用的api 後來整合至取銀行卡的api 3/19
                                                        -->
                                                    </div>

                                                </div>
                                            </div>
                                            <div>
                                                <div class="mem-info-title">
                                                    <h5 class="d-flex align-items-center"><i class="far fa-credit-card mr-2 fa-fw"></i> {{ __('msg_dt_1.payment_type') }}</h5>
                                                </div>
                                                <div class="grid-bd mr-2">
                                                    <div class="row mb-3 d-flex">
                                                        <div class="col-3 mb-3" v-for="thirdparty in thirdpartys">
                                                            <div class="btn btn-light bank-btn" :class="{selected: thirdparty.id == thirdid}" @click="show_money(thirdparty.bankname, thirdparty.minmoney, thirdparty.maxmoney, thirdparty.paymenttypebankcode, thirdparty.enterprisethirdpartycode, thirdparty.id, thirdparty.bankcode)"><span class="circle-icon"><i class="fas fa-dollar-sign bank-icon"></i></span>@{{thirdparty.bankname}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mem-info-title mt-0 mb-3 ml-1">
                                                <h6 class="d-flex align-items-center">{{ __('msg_dt_1.payment_type_escription') }}</h6>
                                            </div>
                                            <div class="row ml-1 mb-3" id="div_typs">
                                                @{{strMoneyMsg}}<br/><br/>
                                            </div>
                                            <div class="money-input">
                                                <div class="input-group input-group-lg w-50 mb-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text deposit-label" id="inputGroup-sizing-lg">$ {{ __('msg_dt_1.save_amount') }}</span>
                                                    </div>
                                                    <input type="number" class="form-control mem_input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="{{ __('msg_dt_1.input_amount') }}"  v-model="save_money">
                                                    <button type="button" class="btn btn-warning px-5" @click="confirm_save">{{ __('msg_dt_1.submit') }}</button>
                                                </div>
                                            </div>
                                            <div class="money-select">
                                                <div class="quick-input d-flex flex-wrap">
                                                    <!-- <div id="cash-50" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(50)" :class="{selected: click_mnoney == 50}">50{{ __('msg_dt_1.dollars') }}</div> -->
                                                        <div id="cash-100" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(100)" :class="{selected: click_mnoney == 100}">100{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-200" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(200)" :class="{selected: click_mnoney == 200}">200{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-500" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(500)" :class="{selected: click_mnoney == 500}">500{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-1000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(1000)" :class="{selected: click_mnoney == 1000}">1000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-2000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(2000)" :class="{selected: click_mnoney == 2000}">2000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-5000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(5000)" :class="{selected: click_mnoney == 5000}">5000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-10000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(10000)" :class="{selected: click_mnoney == 10000}">10000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-20000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(20000)" :class="{selected: click_mnoney == 20000}">20000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-30000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(30000)" :class="{selected: click_mnoney == 30000}">30000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-40000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(40000)" :class="{selected: click_mnoney == 40000}">40000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-50000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(50000)" :class="{selected: click_mnoney == 50000}">50000{{ __('msg_dt_1.dollars') }}</div>
                                                        <div id="cash-100000" class="btn btn-light cash-btn rounded-0" role="button" aria-pressed="true" @click="fast_save(100000)" :class="{selected: click_mnoney == 100000}">100000{{ __('msg_dt_1.dollars') }}</div>
                                                        
                                                        <a style="display:none" href="#" ref="pay_link" target="_blank"></a>
                                                    </div>
                                                </div>
                                                <!-- <div class="savbtn w-50 text-right">
                                                    <button type="button" class="btn btn-warning px-5" @click="fast_save_submit">{{ __('msg_dt_1.fast').__('msg_dt_1.submit') }}</button>
                                                </div> -->
                                            </div>
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
        <script>
            var mb_deposit = new Vue({
                el: '#mb_deposit', 
                data: {
                    thirdpartys: [],
                    emp_cards: [],
                    offline_pays: [],
                    strMoneyMsg: '<?php echo __("msg_dt_1.please_select_payment_type"); ?>',
                    bankcode: '',
                    paymentbankcode: '',
                    thirdcode: '',
                    thirdid: '',
                    min_money: 0,
                    max_money: 0,
                    save_money: '',
                    click_mnoney: 0,
                    qrtype: 0,
                    payment_type: 0,
                    offline_account: '',
                    if_have_bind_bank_card: undefined,

                },
                created: function(){

                    var ApiURL = API_Host + '/system/get_ethirdpartys/PC';
                    Vue.prototype.$http = axios;
                    
                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {

                        var json = response.data;
                        self.show_thirdpartys(json);
                        self.get_emp_card();
                        self.get_card_data();
                        // self.get_ali_we_pay();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                methods: {
                    show_thirdpartys: function(arrData){

                        var inti = 0;
                        var strHtml = '';
                        var cnt = arrData['cnt'];
                        var arrtemp = [];
                        var arrTmpData = [];

                        if(cnt > 0){

                            $.each(arrData['info'], function(key, value){

                                $.each(value, function(k, v){

                                    if(arrTmpData.hasOwnProperty(v['bankcode']) == false){
                                        arrTmpData[v['bankcode']] = new Array();
                                    }

                                    arrTmpData[v['bankcode']].push(v);

                                });
                                
                                /*var intCnt = '0';
                                $.each(value, function(k, v){
                                    
                                    if(value.length > 1){
                                        intCnt++;
                                    }

                                    v['bankname'] += (intCnt == 0 ? '' : intCnt);
                                    arrtemp.push(v);

                                });*/
                            });

                            Object.keys(arrTmpData).map(function(objectKey, index) {
                                
                                var value = arrTmpData[objectKey];

                                $.each(value, function(k, v){

                                    v['bankname'] += (k == 0 ? '' : k);

                                    arrtemp.push(v);

                                });
                            });

                        }

                        this.thirdpartys = arrtemp;
 
                    },
                    show_money: function(mname, min, max, paymenttypebankcode, enterprisethirdpartycode, id, bankcode){

                        this.bankcode = bankcode;
                        this.paymentbankcode = paymenttypebankcode;
                        this.thirdcode = enterprisethirdpartycode;
                        this.max_money = max;
                        this.min_money = min;
                        this.thirdid = id;
                        this.payment_type = 3;


                        this.strMoneyMsg = mname + '：' + min + '-' + max;

                    },
                    confirm_save: function(){
                        //自行輸入
                        this.confirm_amount(this.save_money);
                       
                    },
                    fast_save: function(smoney){
                        //選擇金額動作
                        this.click_mnoney = smoney;
                        this.fast_save_submit();

                    },
                    fast_save_submit: function(){
                        //快捷鍵送出動作
                        this.confirm_amount(this.click_mnoney);
                    },
                    check_thirdparty_select: function(){

                        if(this.bankcode != '' && this.thirdcode != '' && this.thirdid != '' && this.paymentbankcode != ''){
                            return true;
                        }else{
                            return false;
                        }

                    },

                    confirm_amount: function(money){
                        //payment_type = 1 線下銀行支付
                        //payment_type = 2 線下微信支付寶支付
                        //payment_type = 3 第三方第四方支付
                        if(this.payment_type == 0){

                            this.alertinfo('<?php echo __("msg_dt_1.please_select_payment_type"); ?>');
                            return;

                        }else if(this.payment_type == 1){

                            if(money >= this.min_money && money <= this.max_money){
                                var elem = this.$refs.pay_link;
                                elem.href = "/system/show_payment/" + money + '/' + this.thirdid;

                                elem.click();
                            }else{
                                this.alertinfo('<?php echo __("msg_dt_1.amount_not_in_rule"); ?>');
                                return;
                            }
                            

                        }else if(this.payment_type == 2){

                            if(money >= this.min_money && money <= this.max_money){
                                var elem = this.$refs.pay_link;
                                elem.href = "/system/offline_payment/" + money + '/' + this.qrtype + '/' + this.offline_account;

                                elem.click();
                            }else{
                                this.alertinfo('<?php echo __("msg_dt_1.amount_not_in_rule"); ?>');
                                return;
                            }
                            

                        }else{

                            if(this.check_thirdparty_select() == true){
                                if(money >= this.min_money && money <= this.max_money){
                                    //if(confirm('<?php echo __("msg_dt_1.confirm_amount"); ?>' + money + '<?php echo __("msg_dt_1.dollars"); ?>?')){
                                       
                                        var elem = this.$refs.pay_link;
                                        elem.href = "/system/into_payment/" + money + '/' + this.thirdcode + '/' + this.paymentbankcode + '/' + this.bankcode;

                                        elem.click();
                                    //}
                                }else{
                                    this.alertinfo('<?php echo __("msg_dt_1.amount_not_in_rule"); ?>');
                                    return;
                                }
                            }else{
                                this.alertinfo('<?php echo __("msg_dt_1.please_select_payment_type"); ?>');
                                return;
                            }

                        }

                    },
                    get_emp_card: function(){

                        var ApiURL = API_Host + '/system/ebankcards';
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                self.emp_cards = this.json['info'];
                            }else{
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    //原本要拿來接Cloud qrcode用的api 後來整合至取銀行卡的api 3/19

                    // get_ali_we_pay: function(qrtype){
                        
                    //     var ApiURL = API_Host + '/system/aliwepay/alltype/1';
                    //     Vue.prototype.$http = axios;

                    //     var self = this;
                    //     this.$http.get(ApiURL, {cancelToken: source.token})
                    //     .then(function (response) {
                    //         this.json = response.data;
                    //         if(this.json['code'] == '1'){
                    //             console.log(this.json['info']);
                    //             self.offline_pays = this.json['info'];
                    //         }else{
                    //             return;
                    //         }
                    //     })
                    //     .catch(function (error) {
                    //         console.log(error);
                    //     });

                    // },
                    //原本要拿來接Cloud qrcode用的api 後來整合至取銀行卡的api 3/19

                    // bankcode=B020 支付寶  
                    // bankcode=B019 微信 
                    change_emp_code: function(emp_id, bankcode, account, bank_name){

                        this.go_to_bank_card_or_not();
                        this.thirdid = emp_id;
                        this.strMoneyMsg = '';
                        //this.min_money = 0;
                        //this.max_money = 9999999;
                        
                        if ( bankcode == "B020" ){
                            this.qrtype = 2;
                            this.payment_type = 2;
                            this.offline_account = account;
                            //給予最大最小值
                            this.max_money = 3000;
                            this.min_money = 100;
                            this.strMoneyMsg = bank_name + '：100-3000';
                        }else if (bankcode == "B019"){
                            this.qrtype = 1;
                            this.payment_type = 2;
                            this.offline_account = account;
                            //給予最大最小值
                            this.max_money = 3000;
                            this.min_money = 100;
                            this.strMoneyMsg = bank_name + '：100-3000';
                        }else{
                            this.payment_type = 1;
                            //給予最大最小值
                            this.max_money = 20000;
                            this.min_money = 100;
                            this.strMoneyMsg = bank_name + '：100-20000';
                        }

                    },
                    get_card_data: function(){

                        var ApiURL = API_Host + '/mb/ubankcards';
                        Vue.prototype.$http = axios;
                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                var count = this.json['info'].length;
                                if (count > 0){
                                    self.if_have_bind_bank_card = true;
                                }else{
                                    self.if_have_bind_bank_card = false;
                                }
                            }else{
                                self.if_have_bind_bank_card = false;
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    go_to_bank_card_or_not: function(){

                        if (!this.if_have_bind_bank_card){
                            this.alertinfo('<?php echo __("msg_dt_1.please_bind_bank_card_first"); ?>');
                            location.href="/mb/bank_card";
                            return;
                        }

                    }
                }
            });
        </script>
    </body>
</html>
