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
        <div class="container" id="mb_bankcards">
            <div class="main_member">
                @include($mb_info_head)
                <div class="container user-bd">
                    <div class="row">
                        @include($mb_info_left)
                        <div class="col-md-10 middle-history text-left mt-2">
                            <div class="user-edit-module">
                                <div class="mem-cash-title">
                                    <h5 class="d-flex align-items-center"><i class="far fa-file-alt mr-2"></i> {{ __('msg_fcs_1.bank_card') }}</h5>
                                </div>
                                <div class="content">
                                    <div class="bank-card">
                                        <div class="content">
                                            <ul>
                                                <li class="addCard" data-toggle="modal" data-target="#bankModal">
                                                    <div class="add-button">
                                                        <div class="add-icon"><i class="fas fa-plus fa-2x"></i></div>
                                                        <p>{{ __('msg_fcs_1.add_bank_card') }}</p>
                                                    </div>
                                                </li>
                                                <li class="newCard" v-for="card_data in card_datas" :class="{'enabled': card_data.infomationcomment == '<?php echo __("msg_fcs_1.default"); ?>'}">
                                                    <div class="card-data">
                                                        <h4>@{{card_data.bankname}}</h4>
                                                        <div class="card-number"><span>@{{hide_card_num(card_data.paymentaccount)}}</span></div>
                                                        <div class="card-name">{{ __('msg_fcs_1.acc_name') }}: @{{hide_name(card_data.accountname)}}</div>
                                                        <div class="openning_bank">{{ __('msg_fcs_1.openning_bank') }}: @{{card_data.openningbank}}</div>
                                                    </div>
                                                    <div class="edit-bar">
                                                        <!--<span class="btn btn-outline-warning btn-sm edit" data-toggle="modal" data-target="#bankModalEdit" v-if="card_data.status == 2" @click="edit_card_data(card_data.informationcode, card_data.bankcode, card_data.accountname, card_data.paymentaccount)">{{ __('msg_fcs_1.binding') }}</span>
                                                        <span class="btn btn-outline-warning btn-sm delete" v-if="card_data.status == 2">{{ __('msg_fcs_1.delete') }}</span>-->
                                                        <span class="btn btn-outline-warning btn-sm default" v-if="card_data.status == 1 && card_data.infomationcomment == ''" @click="set_default(card_data.informationcode)">{{ __('msg_fcs_1.set_preset') }}</span>
                                                    </div>
                                                    <div class="use-card"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade bank-modal" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('msg_fcs_1.binding_new_card') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnClose"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body my-1">
                            <div class="form-row">
                                <label for="bankAccount" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.new_back') }}:</label>
                                <div class="col-sm-9">
                                    <select class="custom-select my-1 mr-sm-2" id="bankAccount" v-model="bankno">
                                        <option value="nodata">{{__('msg_fcs_1.sel_bank')}}...</option>
                                        <option v-for="(val, key) in banks" :value="val.bankcode">@{{val.bankname}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="nameAccount" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.new_acc_name') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <label type="text" class="form-control" id="nameAccount" placeholder="{{ __('msg_fcs_1.input_acc_name') }}" v-if="whether_card_change == 0">@{{mb_info_head.user_info_name}}</label>
                                    <input type="text" class="form-control" id="nameAccount" placeholder="{{ __('msg_fcs_1.input_acc_name') }}" v-if="whether_card_change == 1">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="openning_bank" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.openning_bank_name') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="text" class="form-control" id="openning_bank" placeholder="{{ __('msg_fcs_1.input_openning_bank_name') }}" v-model="openning_bank">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="bankNumber" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.bank_card_no') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="text" class="form-control" id="bankNumber" placeholder="{{ __('msg_fcs_1.input_bank_card_no') }}" v-model="mb_cardno">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="paymentPassword" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.pay_pass') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="password" class="form-control" id="paymentPassword" placeholder="{{ __('msg_fcs_1.input_pay_pass') }}" v-model="mb_paypwd">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lh m-auto" @click="save_card_data">{{ __('msg_fcs_1.save_bank_card') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bank-modal" id="bankModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="exampleModalLabelEdit">{{ __('msg_fcs_1.binding_new_card') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnCloseEdit"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body my-1">
                            <div class="form-row">
                                <input type="hidden" :value="card_id">
                                <label for="bankAccount1" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.new_back') }}:</label>
                                <div class="col-sm-9">
                                    <select class="custom-select my-1 mr-sm-2" id="bankAccountEdit" v-model="bankno">
                                        <option v-for="(val, key) in banks" :value="key">@{{val}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="nameAccount" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.new_acc_name') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <label type="text" class="form-control" id="nameAccount" placeholder="{{ __('msg_fcs_1.input_acc_name') }}" v-if="whether_card_change == 0">@{{mb_info_head.user_info_name}}</label>
                                    <input type="text" class="form-control" id="nameAccount" placeholder="{{ __('msg_fcs_1.input_acc_name') }}" v-if="whether_card_change == 1">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="openning_bank" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.openning_bank_name') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="text" class="form-control" id="openningBankEdit" placeholder="{{ __('msg_fcs_1.input_openning_bank_name') }}" v-model="openning_bank">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="bankNumber" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.bank_card_no') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="text" class="form-control" id="bankNumberEdit" placeholder="{{ __('msg_fcs_1.input_bank_card_no') }}" v-model="mb_cardno">
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="paymentPassword" class="col-sm-3 col-form-label">{{ __('msg_fcs_1.pay_pass') }}:</label>
                                <div class="col-sm-9 my-1">
                                    <input type="password" class="form-control" id="paymentPasswordEdit" placeholder="{{ __('msg_fcs_1.input_pay_pass') }}" v-model="mb_paypwd">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lh m-auto" @click="update_card_data">{{ __('msg_fcs_1.save_bank_card') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
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
                        self.get_card_data();
                    }
                }, 500);

            },
            methods: {
                hide_card_num: function(val){
                    var str_length = val.length;
                    var string_first_4 = val.substr(0,4);
                    var string_last_4 = val.substr(-4,4);
                    var string_middle = '';
                    while (string_middle.length < (str_length-4)){
                        string_middle+="*";
                    }
                    return string_first_4 + string_middle + string_last_4;
                    
                },
                hide_name: function(val){

                    var count_string = 0;
                    new_string = val.substr(0, 1);
                    var length = val.length;

                    while (count_string < length){

                        new_string += "*";
                        count_string++;

                    }

                    return new_string;

                },
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
                get_card_data: function(){

                    this.card_datas = {};

                    var ApiURL = API_Host + '/mb/ubankcards';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.card_datas = this.json['info'];
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                            //location.href = '/';
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                save_card_data: function(){

                    if(this.bankno == 'nodata'){
                        this.alertinfo('<?php echo __("msg_fcs_1.sel_bank2"); ?>');
                        return false;
                    }
                    if(mb_info_head.user_info_name == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_acc_name"); ?>');
                        return false;
                    }
                    if(this.openning_bank.trim() == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_openning_bank_name"); ?>');
                        return false;
                    }
                    if(this.mb_cardno.trim() == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_bank_card_no"); ?>');
                        return false;
                    }else{
                        if(isNaN(this.mb_cardno)){
                            this.alertinfo('<?php echo __("msg_fcs_1.card_no_err"); ?>');
                            return false;
                        }else{
                            if(this.mb_cardno.length <= 15 || this.mb_cardno.length >= 20){
                                this.alertinfo('<?php echo __("msg_fcs_1.length_err"); ?>');
                                return false;
                            }
                        }
                    }

                    if(this.mb_paypwd.trim() == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_pay_pass"); ?>');
                        return false;
                    }

                    var ApiURL = API_Host + '/mb/addubankcard/' + this.mb_cardno + '/' + mb_info_head.user_info_name + '/' + this.openning_bank + '/' + this.bankno + '/' + this.mb_paypwd;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_fcs_1.insert_succ"); ?>');
                            self.clear_data();
                            self.get_card_data();
                            $('#btnClose').click();
                        }else{
                            self.alertinfo(this.json['info'], '/mb/bank_card');
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                /*edit_card_data: function(card_id, bank_code, acc_name, card_no){

                    this.mb_cardno = card_no;
                    this.mb_name = acc_name;
                    this.bankno = bank_code;
                    this.card_id = card_id;

                },*/
                update_card_data: function(){

                    if(this.card_id == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.program_err"); ?>');
                        return false;
                    }
                    if(this.bankno == 'nodata'){
                        this.alertinfo('<?php echo __("msg_fcs_1.sel_bank2"); ?>');
                        return false;
                    }
                    if(mb_info_head.user_info_name == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_acc_name"); ?>');
                        return false;
                    }
                    if(this.openning_bank.trim() == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_openning_bank_name"); ?>');
                        return false;
                    }
                    if(this.mb_cardno == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_bank_card_no"); ?>');
                        return false;
                    }else{
                        if(isNaN(this.mb_cardno)){
                            this.alertinfo('<?php echo __("msg_fcs_1.card_no_err"); ?>');
                            return false;
                        }else{
                            if(this.mb_cardno.length <= 15 || this.mb_cardno.length >= 20){
                                this.alertinfo('<?php echo __("msg_fcs_1.length_err"); ?>');
                                return false;
                            }
                        }
                    }

                    if(this.mb_paypwd == ''){
                        this.alertinfo('<?php echo __("msg_fcs_1.input_pay_pass"); ?>');
                        return false;
                    }

                    var ApiURL = API_Host + '/mb/editubankcard/' + this.card_id + '/' + this.mb_paypwd + '/' + this.mb_cardno + '/' + mb_info_head.user_info_name + '/' + this.openning_bank + '/' + this.bankno;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_fcs_1.update_succ"); ?>');
                            self.clear_data();
                            self.get_card_data();
                            $('#btnCloseEdit').click();
                        }else{
                            self.alertinfo(this.json['info'], '/mb/bank_card');
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                clear_data: function(){

                    this.mb_cardno = '';
                    this.bankno = '';
                    this.mb_paypwd = '';
                    this.card_id = '';
                    this.openning_bank ='';

                },
                set_default: function(cid){

                    var ApiURL = API_Host + '/mb/defaultubankcard/' + cid;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_fcs_1.setup_completed"); ?>');
                            self.clear_data();
                            self.get_card_data();
                        }else{
                            self.alertinfo(this.json['info'], '/mb/bank_card');
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                }
            }
        });
    </script>
</html>
