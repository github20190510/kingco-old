<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_deposit">
            <main role="main" class="container main bank-main">
                <form class="needs-validation" novalidate onSubmit="return false;">
                    <section class="input-group register-input dropdown-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-bars fa-fw mr-1"></i>{{ __('msg_fcs_1.select_payment_type') }}</label>
                        </div>
                        <select class="custom-select bank-select" id="inputGroupSelect01" v-model="select_payment_type" >
                            <option  class="text-center">{{ __('msg_fcs_1.select_thirdpartys_type') }}...</option>
                            <!-- <option value="offline" v-if="if_have_bind_bank_card != undefined">{{ __('msg_fcs_1.offline_payment_type') }}</option> --><!-- 先移除線下支付的部分-->
                            <option value="online">{{ __('msg_fcs_1.online_payment_type') }}</option>
                        </select>
                    </section>
                    <div v-if="select_payment_type == 'offline'">
                        <section class="input-group register-input dropdown-box">
                            
                            <div class="input-group-prepend dropdown-left">
                                <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-globe fa-fw mr-1"></i> {{ __('msg_fcs_1.select_payment_way') }}</label>
                            </div>
                            
                            <select class="custom-select bank-select" id="inputGroupSelect01" v-model="offline_index" @change="show_money()">
                                <option value="" class="text-center">{{ __('msg_fcs_1.select_thirdpartys_type') }}...</option>
                                <option v-for="(emp_card,index) in emp_cards" :value="index" >@{{emp_card.bankname}}</option>
                            </select>
                        </section>
                    </div>
                    <div v-if="select_payment_type == 'online'">
                        <section class="input-group register-input dropdown-box">
                            
                            <div class="input-group-prepend dropdown-left">
                                <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-globe fa-fw mr-1"></i> {{ __('msg_fcs_1.select_payment_way') }}</label>
                            </div>
                            <!--<div class="input-group-append dropdown-right">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnBank">{{ __('msg_fcs_1.select_thirdpartys_type') }}</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" v-for="thirdparty in thirdpartys" @click="show_money(thirdparty.bankname, thirdparty.minmoney, thirdparty.maxmoney, thirdparty.paymenttypebankcode, thirdparty.enterprisethirdpartycode, thirdparty.id, thirdparty.bankcode)">@{{thirdparty.bankname}}(@{{thirdparty.bank_name}})</a>
                                </div>
                            </div>-->
                            <select class="custom-select bank-select" id="inputGroupSelect01" v-model="online_index" @change="show_money()">
                                <option value="" class="text-center">{{ __('msg_fcs_1.select_thirdpartys_type') }}...</option>
                                <option v-for="(thirdparty,index) in thirdpartys" :value="index" >@{{thirdparty.bankname}}</option>
                            </select>
                        </section>
                    </div>
                    <!--<section class="input-group register-input dropdown-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-university fa-fw mr-1"></i> 网银支付</label>
                        </div>
                        <div class="input-group-append dropdown-right">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">选择银行</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">銀行A</a>
                                <a class="dropdown-item" href="#">銀行B</a>
                            </div>
                        </div>
                    </section>-->
                    <section class="input-group register-input money-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect2"><i class="fas fa-sort-amount-up fa-fw mr-1 text-white"></i> {{ __('msg_fcs_1.money_limit') }}</label>
                        </div>
                        <input type="text" class="form-control bg-transparent bank-imit" :placeholder="strMoneyMsg" readonly="readonly" >
                    </section>
                    <section class="input-group register-input money-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-dollar-sign fa-fw mr-1 text-white"></i> {{ __('msg_fcs_1.save_amount') }}</label>
                        </div>
                        <input type="number" class="form-control bg-transparent money-input" placeholder="" v-model="save_money">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-outline-secondary minus-btn" type="button" @click="less_count"></button>
                            <button class="btn btn-outline-secondary add-btn" type="button" @click="add_count"></button>
                            <button class="btn btn-outline-secondary" :class="[currency == '1' ? 'thousand-btn' : 'hundred-btn']" type="button" @click="change_money_currency"></button>
                        </div>
                    </section> 
                    <section class="mb-3">
                        <div class="row d-flex flex-wrap justify-content-start m-auto money-btn ">
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(50)">50{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(100)">100{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(200)">200{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(500)">500{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(1000)">1000{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(2000)">2000{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(5000)">5000{{ __('msg_fcs_1.dollars') }}</button>
                            <button type="button" class="btn c-alpha-gold" @click="fast_save(10000)">10000{{ __('msg_fcs_1.dollars') }}</button>
                            <a style="display:none" href="#" ref="pay_link" target="_blank"></a>
                        </div>
                    </section>
                    <button type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn mb-3" @click="confirm_save">{{ __('msg_fcs_1.confirm_ok') }}</button>
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
        var mb_deposit = new Vue({
            el: '#mb_deposit', 
            data: {
                emp_cards: [],
                select_payment_type: '',
                thirdpartys: [],
                strMoneyMsg: '<?php echo __("msg_fcs_1.please_select_payment_type"); ?>',
                bankcode: '',
                paymentbankcode: '',
                thirdcode: '',
                thirdid: '',
                min_money: 0,
                max_money: 0,
                save_money: 0,
                money_unit: 100,
                payment_type: 0,
                qrtype: 0,
                currency: 0,
                online_index: -1,
                offline_index: -1,
                if_have_bind_bank_card: undefined,


            },
            created: function(){

                var ApiURL = API_Host + '/system/get_ethirdpartys/H5';
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    var json = response.data;
                    self.show_thirdpartys(json);
                    self.get_emp_card();
                    self.get_card_data();
                    
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
                /*show_money: function(mname, min, max, paymenttypebankcode, enterprisethirdpartycode, id, bankcode){

                    this.bankcode = bankcode;
                    this.paymentbankcode = paymenttypebankcode;
                    this.thirdcode = enterprisethirdpartycode;
                    this.max_money = max;
                    this.min_money = min;
                    this.thirdid = id;
                    //$('#btnBank').html(mname);


                    this.strMoneyMsg = mname + '：' + min + '-' + max;

                },*/
                show_money: function(mname, min, max, paymenttypebankcode, enterprisethirdpartycode, id, bankcode){
                    var self = this;
                    if ( self.select_payment_type == "online" && self.online_index != undefined){
                        var thirdparty = self.thirdpartys[self.online_index];
                        self.thirdid = thirdparty['id'];
                        self.bankcode = thirdparty['bankcode'];
                        self.paymentbankcode = thirdparty['paymenttypebankcode'];
                        self.thirdcode = thirdparty['enterprisethirdpartycode'];
                        self.max_money = thirdparty['maxmoney'];
                        self.min_money = thirdparty['minmoney'];
                        //self.thirdid = v['id'];
                        self.strMoneyMsg = thirdparty['bank_name'] + '：' + self.min_money + '-' + self.max_money;
                        self.payment_type = 3;
                    }else if ( self.select_payment_type == "offline" && self.offline_index != undefined){
                        this.go_to_bank_card_or_not();
                        var emp_card = self.emp_cards[self.offline_index];
                        self.bankcode = emp_card['bankcode'];
                        self.paymentbankcode = emp_card['paymenttypebankcode'];
                        self.thirdcode = emp_card['enterprisethirdpartycode'];
                        self.change_emp_code(emp_card['enterpriseinformationcode'],emp_card['bankcode'],emp_card['openningbank'],emp_card['bankname']);
                        
                    }
                    

                },
                confirm_save: function(){
                    //自行輸入
                    this.confirm_amount(this.save_money);
                   
                },
                fast_save: function(smoney){
                    //快捷鍵
                    this.confirm_amount(smoney);

                },
                check_thirdparty_select: function(){

                    if(this.bankcode != '' && this.thirdcode != '' && this.thirdid != '' && this.paymentbankcode != ''){
                        return true;
                    }else{
                        return false;
                    }

                },
                confirm_amount: function(money){
                    if(this.payment_type == 0){

                        this.alertinfo('<?php echo __("msg_fcs_1.please_select_payment_type"); ?>');
                        return;

                    }else if(this.payment_type == 1){

                        if(money >= this.min_money && money <= this.max_money){
                            var elem = this.$refs.pay_link;
                            elem.href = "/system/show_payment/" + money + '/' + this.thirdid;

                            elem.click();
                        }else{
                            this.alertinfo('<?php echo __("msg_fcs_1.amount_not_in_rule"); ?>');
                            return;
                        }

                    }else if(this.payment_type == 2){

                        if(money >= this.min_money && money <= this.max_money){
                            var elem = this.$refs.pay_link;
                            elem.href = "/system/offline_payment/" + money + '/' + this.qrtype + '/' + this.offline_account;

                            elem.click();
                        }else{
                            this.alertinfo('<?php echo __("msg_fcs_1.amount_not_in_rule"); ?>');
                            return;
                        }

                    }else{

                        if(this.check_thirdparty_select() == true){
                            if(money >= this.min_money && money <= this.max_money){
                                if(confirm('<?php echo __("msg_fcs_1.confirm_amount"); ?>' + money + '<?php echo __("msg_fcs_1.dollars"); ?>?')){
                                   
                                    var elem = this.$refs.pay_link;
                                    elem.href = "/system/into_payment/" + money + '/' + this.thirdcode + '/' + this.paymentbankcode + '/' + this.bankcode;

                                    elem.click();
                                }
                            }else{
                                this.alertinfo('<?php echo __("msg_fcs_1.amount_not_in_rule"); ?>');
                                return;
                            }
                        }else{
                            this.alertinfo('<?php echo __("msg_fcs_1.please_select_payment_type"); ?>');
                            return;
                        }

                    }
                    

                },
                add_count: function(){

                    if(this.save_money != ''){
  
                        if( (/^(\+|-)?\d+$/.test(this.save_money)) && this.save_money > 0){  
                            this.save_money = parseInt(this.save_money) + parseInt(this.money_unit);                            
                        }else{
                            this.save_money = this.money_unit;
                        }
                    }else{
                        this.save_money = this.money_unit;
                    };

                },
                less_count: function(){

                    if(this.save_money != ''){

                        if( (/^(\+|-)?\d+$/.test(this.save_money)) && this.save_money > 0){  
                            this.save_money = parseInt(this.save_money) - parseInt(this.money_unit);
                            if(this.save_money < 0){
                                this.save_money = 0;
                            }
                        }else{
                            this.save_money = 0;
                        }                      
                    }else{
                        this.save_money = 0;
                    };

                },
                change_money_currency: function(){

                    if(this.currency == 0){
                        this.currency = 1;
                        this.money_unit = 1000;
                    }else{
                        this.currency = 0;
                        this.money_unit = 100;
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
                change_emp_code: function(emp_id, bankcode, account, bank_name){
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
                        this.alertinfo('<?php echo __("msg_fcs_1.please_bind_bank_card_first"); ?>');
                        location.href="/mb/bank_card";
                        return;
                    }
                }
            }
        });
        </script>        
    </body>
</html>
