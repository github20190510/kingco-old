<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="main" id="payment_go">
            <div v-if="showStatus === 1"><font color='white' size="40">{{ __('msg_zy_1.loading') }}</font></div>
           
            <div class="container">
                <div class="main_member" style="width:60%">
                    <div class="container user-bd">
                        <div class="row">
                            <div class="col-md-12 middle text-left mt-2">
                                <div class="user-edit-module" id="mb_edit_data">
                                    <div class="mem-title">
                                        <h5><i class="far fa-address-card"></i>{{ __('msg_zy_1.complete_payment') }}</h5>
                                    </div>
                                    <div v-if="grepStatus == 1 " class="content" style="width:100%">
                                        <div  class="member-name">
                                            <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-if="{{$qrtype}} == 1">{{ __('msg_zy_1.wechat') }}{{ __('msg_zy_1.qr_name') }}</label>
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-else>{{ __('msg_zy_1.alipay') }}{{ __('msg_zy_1.qr_name') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="accountname">
                                                    @{{emp_qrcode.accountname}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_qrcode.accountname)">
                                                     {{ __('msg_zy_1.copy_to_clipboard') }}
                                                </button>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-if="{{$qrtype}} == 1">{{ __('msg_zy_1.wechat') }}{{ __('msg_zy_1.qr_id') }}</label>
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-else>{{ __('msg_zy_1.alipay') }}{{ __('msg_zy_1.qr_id') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="openningbank">
                                                    @{{emp_qrcode.openningbank}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_qrcode.openningbank)">
                                                     {{ __('msg_zy_1.copy_to_clipboard') }}
                                                </button>
                                            </div>
                                            <!-- <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right" >{{ __('msg_zy_1.bank_account') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="openningaccount">
                                                    @{{emp_qrcode.openningaccount}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_qrcode.openningaccount)">
                                                     {{ __('msg_zy_1.copy_to_clipboard') }}
                                                </button>
                                            </div> -->
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_zy_1.saving_amount') }}</label>
                                                <div class="col-sm-9 mem-data-text">
                                                    @{{amount}}
                                                </div>
                                            </div>
                                            <!-- <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-if="{{$qrtype}} == 1">{{ __('msg_zy_1.wechat') }}{{ __('msg_zy_1.qr_name') }}</label>
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-else>{{ __('msg_zy_1.alipay') }}{{ __('msg_zy_1.qr_name') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="inputrealname" placeholder="{{ __('msg_zy_1.write_down_name') }}" value="" v-model="openAccountName">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-if="{{$qrtype}} == 1">{{ __('msg_zy_1.wechat') }}{{ __('msg_zy_1.qr_id') }}</label>
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" v-else>{{ __('msg_zy_1.alipay') }}{{ __('msg_zy_1.qr_id') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="inputrealname" placeholder="{{ __('msg_zy_1.write_down_account') }}" value="" v-model="openAccount">
                                                </div>
                                            </div> -->
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_zy_1.comment') }}</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control mem_input" id="exampleTextarea" rows="3" v-model="comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else-if="grepStatus == 0">
                                        {{ __('msg_zy_1.greping') }}
                                    </div>
                                    <div v-else-if="grepStatus == 2">
                                        {{ __('msg_zy_1.dealing_with_deposit_order') }}@{{loading_str}}
                                    </div>
                                    <div v-else>
                                        {{ __('msg_zy_1.grep_error') }}
                                    </div>
                                    <div v-if="grepStatus == 1 " class="savbtn text-center">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bankModal" v-on:click="show_qrcode">{{ __('msg_zy_1.add_friends') }}</button>
                                        <button type="button" class="btn btn-warning"  v-on:click="send_data()">{{ __('msg_zy_1.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade bank-modal" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-white brown">

                                    <h5 class="modal-title" id="exampleModalLabel" v-if="{{$qrtype}} == 1">{{ __('msg_zy_1.wechat') }}{{ __('msg_zy_1.qr_dialog_title') }}</h5>
                                    <h5 class="modal-title" id="exampleModalLabel" v-else>{{ __('msg_zy_1.alipay') }}{{ __('msg_zy_1.qr_dialog_title') }}</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnClose"> <span aria-hidden="true">×</span> </button>
                                </div>
                                <div class="modal-body my-2">
                                    <div class="form-row">
                                
                                <div class="col-sm my-1" style="color:black" v-if="qrcode_url == ''">
                                    {{ __('msg_zy_1.data_not_full') }}
                                </div>
                            </div>
                                </div>
                                <img class="modal-content"  :src=qrcode_url>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-lh m-auto" data-dismiss="modal"  aria-label="Close">{{ __('msg_zy_1.trun_off') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
    <script>
        var app = new Vue({
            el : '#payment_go',
            data : {
                grepStatus: 0,
                showStatus: 1,
                emp_qrcode: [],
                qr_status: 0,
                amount: {{$amount}},
                lsh: [],
                openAccount: "",
                openAccountName: "",
                comment: "",
                qrcode_url: "",
                loading_str: "",
                loading_id: "",
                bankcode: "{{ $qrtype == 1 ? 'B019' : 'B020' }}"         
            },
            created: function(){

                if(this.amount < 100 || this.amount > 3000){
                    this.alertinfo('<?php echo __("msg_zy_1.amount_not_in_rule"); ?>', '/');
                    return false;
                }

                var ua = new UserAgent();
                var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL)
                .then(function (response) {
                    
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                       //進入付款頁

                        self.showStatus = 0;
                        self.get_offline_list();
                    }else{
                        //導回首頁
                        location.href = '/';
                    }
                })
                .catch(function (error) {
                    this.message = -1;
                    console.log(error);
                });

            },
            watch: {
                grepStatus: function(val){
                    if (val == 2){
                        var count = 0;
                        app.loading_id = setInterval(function(){
                            if (count < 3){
                                app.loading_str +=".";
                                count += 1;
                            }else{
                                count = 0;
                                app.loading_str = "";
                            }
                        },300)
                    }else{
                        if (app.loading_id != ""){
                            clearInterval(app.loading_id);
                            app.loading_id = "";
                        }
                    }
                }
            },
            methods: {
                get_offline_list: function(){
                    var ApiURL = API_Host + '/system/ebankcards';
                    Vue.prototype.$http = axios;
                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            $.each(this.json['info'], function(k, v){
                                if(v.openningbank == "{{$offline_account}}"){
                                    self.grepStatus = 1;
                                    self.emp_qrcode = v;
                                    self.qr_status = 1;
                                    return false;
                                }
                            })

                            if(self.qr_status == 0){
                                self.alertinfo('<?php echo __("msg_zy_1.data_err"); ?>', '/');
                            }
                        }else{
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                check_send_data:function(){
                    // if (this.openAccount.replace(/\s/g, '') == "" || this.openAccountName.replace(/\s/g, '') == ""){
                    //     return ;
                    // }else{
                    //     return true;
                    // }
                    return true;
                },
                show_qrcode: function(){
                    if (this.check_send_data()){
                        this.qrcode_url = this.emp_qrcode.openningaccount;

                    }else{
                        this.qrcode_url = "";
                    }
                },
                send_data: function(){
                    if (this.check_send_data()){
                        this.grepStatus = 2;
                        if (this.comment.replace(/\s/g, '') == ""){
                            this.comment = '<?php echo __("msg_zy_1.null"); ?>';
                        }
                        if (this.openAccount.replace(/\s/g, '') == "" ){
                            this.openAccount = '<?php echo __("msg_zy_1.null"); ?>';
                        }
                        if (this.openAccountName.replace(/\s/g, '') == "" ){
                            this.openAccountName = '<?php echo __("msg_zy_1.null"); ?>';
                        }
                        var ApiURL = API_Host + '/mb/savingmoney/'+this.amount+'/'+this.comment+'/'+this.emp_qrcode.enterpriseinformationcode+'/'+this.bankcode+'/'+this.openAccount+'/'+this.openAccountName;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            this.grepStatus = 0;
                            if(this.json['code'] == '1'){
                                self.alertinfo('<?php echo __("msg_zy_1.payment_success"); ?>', '/');
                                //關閉該頁
                                window.close();
                            }else if (this.json['code'] == '2'){
                                self.alertinfo(this.json['info'], '/mb/bank_card');
                            }else{
                                self.alertinfo(this.json['info'], '/');
                                //關閉該頁
                                window.close();
                            }
                        })
                        .catch(function (error) {
                            this.grepStatus = 0;
                            console.log(error);
                        });
                    }else{
                        this.alertinfo('<?php echo __("msg_zy_1.data_not_full"); ?>');
                    }
                },
                copy_to_clipboard: function(value) {
                  var $temp = $("<input>");
                  $("body").append($temp);
                  $temp.val(value).select();
                  document.execCommand("copy");
                  $temp.remove();
                },
            }
        });
    </script>
</html>
