<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_bankcards">
            <main role="main" class="container main bank-main">
                <section class="d-flex flex-wrap justify-content-around">
                    <div class="add-card">
                        <button type="button" class="btn d-flex align-items-center flex-column justify-content-center" onclick="location.href='/mb/bank_card_add'"><i class="far fa-plus-square"></i>{{ __('msg_dt_1.add_bank_card_mobile') }}</button>
                    </div>
                    <div class="new-card c-alpha-gold enabled" v-for="card_data in card_datas">
                        <div class="card-data">
                            <div>@{{card_data.bankname}}</div>
                            <div class="card-number"><span>@{{hide_card_num(card_data.paymentaccount)}}</span></div>
                            <div class="card-name">{{ __('msg_dt_1.acc_name') }}: @{{hide_name(card_data.accountname)}}</div>
                            <div class="openning_bank">{{ __('msg_dt_1.openning_bank') }}: @{{card_data.openningbank}}</div>
                        </div>
                        <div class="edit-bar d-flex justify-content-center">
                            <!--<span class="btn btn-sm edit mr-1" data-toggle="modal" data-target="#bankModal">編輯</span>
                            <span class="btn btn-sm delete mr-1">刪除</span>-->
                            <span class="btn btn-sm default" v-if="card_data.status == 1 && card_data.infomationcomment == ''" @click="set_default(card_data.informationcode)">{{ __('msg_dt_1.set_preset') }}</span>
                        </div>
                        <div class="use-card" v-if="card_data.infomationcomment == '<?php echo __("msg_dt_1.default"); ?>'"><span></span><!--預設卡--></div>
                    </div>
                </section>
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
        var mb_bankcards = new Vue({
            el: '#mb_bankcards',
            data: {
                banks: {},
                bankno: 'nodata',
                mb_account: '',
                mb_name: '',
                mb_cardno: '',
                mb_paypwd: '',
                card_id: '',
                card_datas: {},
                whether_card_change:0,
            },
            created: function(){
                
                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
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
                clear_data: function(){

                    this.mb_cardno = '';
                    this.mb_name = '';
                    this.bankno = '';
                    this.mb_paypwd = '';
                    this.card_id = '';

                },
                set_default: function(cid){

                    var ApiURL = API_Host + '/mb/defaultubankcard/' + cid;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_dt_1.setup_completed"); ?>');
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
        
    </body>
</html>
