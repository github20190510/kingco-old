<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_bankcards">
            <main role="main" class="container main bank-main">
                <form class="needs-validation" novalidate onSubmit="return false;">                    
                    <div class="input-group register-input dropdown-box">
                        <div class="input-group-prepend dropdown-left">
                            <label class="input-group-text c-alpha-gold text-white border-0" for="inputGroupSelect01"><i class="fas fa-university fa-fw mr-1"></i> {{ __('msg_zy_1.new_back') }}</label>
                        </div>
                        <!--<div class="input-group-append dropdown-right">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btn_bank">{{__('msg_zy_1.sel_bank')}}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-for="(val, key) in banks" :value="val.bankcode" href="#" @click="change_select_bank(val.bankname, val.bankcode)">@{{val.bankname}}</a>
                            </div>
                        </div>-->
                        <select class="custom-select bank-select" id="inputGroupSelect01" v-model="bankno">
                            <option value="nodata" class="text-center">{{__('msg_zy_1.sel_bank')}}...</option>
                            <option v-for="(val, key) in banks" :value="val.bankcode">@{{val.bankname}}</option>
                        </select>
                    </div>
                    
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user fa-fw"></i></span>
                        </div>
                            <label type="text" class="form-control border-left-0 bg-transparent" id="nameAccount" placeholder="{{ __('msg_zy_1.input_acc_name') }}" v-if="whether_card_change == 0" style="color: white">@{{mb_head.nick_name}}</label>
                            <input type="text" class="form-control border-left-0 bg-transparent" id="nameAccount" placeholder="{{ __('msg_zy_1.input_acc_name') }}" v-if="whether_card_change == 1">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_acc_name') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-credit-card fa-fw"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 bg-transparent" id="bankid" placeholder="{{ __('msg_zy_1.openning_bank_name') }}：{{ __('msg_zy_1.input_openning_bank_name') }}" required v-model="openning_bank">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_openning_bank_name') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-credit-card fa-fw"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 bg-transparent" id="bankid" placeholder="{{ __('msg_zy_1.bank_card_no') }}：{{ __('msg_zy_1.input_bank_card_no') }}" required v-model="mb_cardno">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_bank_card_no') }}
                        </div>
                    </div>
                    
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 bg-transparent" id="password" placeholder="{{ __('msg_zy_1.pay_pass') }}：{{ __('msg_zy_1.input_pay_pass') }}" required v-model="mb_paypwd">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_pay_pass') }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn" @click="save_card_data">{{ __('msg_zy_1.save_bank_card') }}</button>
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

        var mb_bankcards = new Vue({
            el: '#mb_bankcards',
            data: {
                banks: {},
                bankno: 'nodata',
                openning_bank: '',
                mb_cardno: '',
                mb_paypwd: '',
                card_id: '',
                card_datas: {},
                whether_card_change:0,
            },
            created: function(){
                
               //取回銀行資料
               var self = this;
               setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_bank_data();
                    }
                }, 500);

            },
            methods: {
                get_bank_data: function(){

                    var ApiURL = API_Host + '/system/banks';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.banks = this.json['info'];
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                save_card_data: function(){

                    if(this.bankno == 'nodata'){
                        this.alertinfo('<?php echo __("msg_zy_1.sel_bank2"); ?>');
                        return false;
                    }
                    if(mb_head.nick_name == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.input_acc_name"); ?>');
                        return false;
                    }
                    if(this.mb_cardno.trim() == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.input_bank_card_no"); ?>');
                        return false;
                    }else{
                        if(isNaN(this.mb_cardno)){
                            this.alertinfo('<?php echo __("msg_zy_1.card_no_err"); ?>');
                            return false;
                        }else{
                            if(this.mb_cardno.length <= 15 || this.mb_cardno.length >= 20){
                                this.alertinfo('<?php echo __("msg_zy_1.length_err"); ?>');
                                return false;
                            }
                        }
                    }

                    if(this.mb_paypwd.trim() == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.input_pay_pass"); ?>');
                        return false;
                    }

                    var ApiURL = API_Host + '/mb/addubankcard/' + this.mb_cardno + '/' + mb_head.nick_name + '/' + this.openning_bank + '/' + this.bankno + '/' + this.mb_paypwd;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_zy_1.insert_succ"); ?>', '/mb/bank_card');
                        }else{
                            self.alertinfo(this.json['info'], '/mb/bank_card');
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                change_select_bank: function(strbank, bankcode){

                    $('#btn_bank').html(strbank);
                    this.bankno = bankcode;

                }
            }
        });
    </script>
        
    </body>
</html>
