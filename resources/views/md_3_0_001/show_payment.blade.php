<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="main" id="payment_go">
            <div v-if="showStatus === 1"><font color='white' size="40">{{ __('msg_dt_1.loading') }}</font></div>
            <input type="hidden" ref="dt1" value="{{$eid}}" />
            <input type="hidden" ref="dt2" value="{{$amount}}" />
            <input type="hidden" ref="dt3" value="{{$ent_code}}" />
            <div class="container">
                <div class="main_member" style="width:60%">
                    <div class="container user-bd" >
                        <div class="row">
                            <div class="col-md-12 middle text-left mt-2">
                                <div class="user-edit-module" id="mb_edit_data">
                                    <div class="mem-title">
                                        <h5><i class="far fa-address-card"></i>{{ __('msg_dt_1.complete_payment') }}</h5>
                                    </div>
                                    <div v-if="grepStatus == 1 " class="content" style="width:100%">
                                        <div v-for ="(emp_card, index) in emp_cards" class="member-name">
                                            <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right" >{{ __('msg_dt_1.bank_name') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="bankname">
                                                    @{{emp_card.bankname}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_card.bankname)">
                                                     {{ __('msg_dt_1.copy_to_clipboard') }}
                                                </button>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right" >{{ __('msg_dt_1.acoount_name') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="accountname">
                                                    @{{emp_card.accountname}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_card.accountname)">
                                                     {{ __('msg_dt_1.copy_to_clipboard') }}
                                                </button>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right" >{{ __('msg_dt_1.bank_account') }}</label>
                                                <div class="col-sm-9 mem-data-text" id="openningaccount">
                                                    @{{emp_card.openningaccount}}
                                                </div>
                                                <button class="btn btn-secondary btn-sm" v-on:click="copy_to_clipboard(emp_card.openningaccount)">
                                                     {{ __('msg_dt_1.copy_to_clipboard') }}
                                                </button>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.saving_amount') }}</label>
                                                <div class="col-sm-9 mem-data-text">
                                                    @{{amount}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.open_account_name') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="inputrealname" placeholder="{{ __('msg_dt_1.real_name_desc1') }}" value="" v-model="openAccountName">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.open_account') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="inputrealname" placeholder="{{ __('msg_dt_1.real_account_desc') }}" value="" v-model="openAccount">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.comment') }}</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control mem_input" id="exampleTextarea" rows="3" v-model="comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else-if="grepStatus == 0">
                                        {{ __('msg_dt_1.greping') }}
                                    </div>
                                    <div v-else>
                                        {{ __('msg_dt_1.grep_error') }}
                                    </div>
                                    <div v-if="grepStatus == 1 " class="savbtn text-center">
                                        <button type="button" class="btn btn-warning" v-on:click="send_data">{{ __('msg_dt_1.save') }}</button>
                                    </div>
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
                emp_cards: [],
                card_status: 0,
                amount: {{$amount}},
                openAccountName: "",
                openAccount: "",
                comment: "",
            },
            created: function(){

                if(this.amount < 100 || this.amount > 20000){
                    this.alertinfo('<?php echo __("msg_dt_1.amount_not_in_rule"); ?>', '/');
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
                        self.get_emp_card();
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
            methods: {
                get_emp_card: function(){

                    var ApiURL = API_Host + '/system/ebankcards';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            $.each(this.json['info'], function(k, v){
                                if(v.enterpriseinformationcode == self.$refs.dt3.value){
                                    self.grepStatus = 1;
                                    self.emp_cards.push(v);
                                    self.card_status = 1;
                                    return false;
                                }
                            })

                            if(self.card_status == 0){
                                self.alertinfo('<?php echo __("msg_dt_1.data_err"); ?>', '/');
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
                    if (this.openAccountName.replace(/\s/g, '') == "" || this.openAccount.replace(/\s/g, '') == ""){
                        this.alertinfo('<?php echo __("msg_dt_1.data_not_full"); ?>');
                        return ;
                    }
                    if (this.openAccount.replace(/\s/g, '').length < 5){
                        this.alertinfo('<?php echo __("msg_dt_1.openAccount_length_error"); ?>');
                        return ;
                    }
                    return true;
                },
                send_data: function(){
                    if (this.check_send_data()){
                        if (this.comment.replace(/\s/g, '') == ""){
                            this.comment = '<?php echo __("msg_dt_1.null"); ?>';
                        }
                        var ApiURL = API_Host + '/mb/savingmoney/'+this.amount+'/'+this.comment+'/'+this.emp_cards[0].enterpriseinformationcode+'/'+this.emp_cards[0].bankcode+'/'+this.openAccount+'/'+this.openAccountName;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                self.alertinfo('<?php echo __("msg_dt_1.payment_success"); ?>', '/');
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
                            console.log(error);
                        });
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
