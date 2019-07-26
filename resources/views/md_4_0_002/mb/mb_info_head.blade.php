<div class="conten">
    <div class="user-head d-flex justify-content-around align-items-stretch" id="mb_info_head">
        <div class="user-items userBar d-flex">
            <div class="user-icon">
                <span class="mem-icon">
                <svg class="am-icon am-icon-md " style="width: 100px; height: 100px;">
                <use xlink:href="#user"></use>
                </svg>
                </span>
            </div>
            <div class="user-info my-2">
                <div class="info-items welcome d-flex">{{ __('msg_zy_1.welcome') }}，<div id="acc_displayalias"></div><a href="{{ url('mb/edata') }}" class="text-warning ml-3"><i class="fas fa-pen-square"></i> {{ __('msg_zy_1.update') }}</a></div>
                <div class="info-items member d-flex align-items-center my-2">
                    <div class="memberItems memberLevel mr-3">{{ __('msg_zy_1.mb_lv') }}：<span id="span_lv"></span></div>
                    <div class="memberItems memberPoint mr-3 d-flex" style="display:none">{{ __('msg_zy_1.mb_points') }}：<span><strong>0</strong></span>&nbsp;分&nbsp;&nbsp;&nbsp;<a href="" class="unsigned text-warning ml-3"><i class="fas fa-user-check"></i> {{ __('msg_zy_1.sing_in') }}</a></div>
                </div>
                <div class="info-items playerInfo d-flex">
                    <a class="mem-phone" href="{{ url('mb/edata') }}"><i class="fas fa-mobile-alt"></i> {{ __('msg_zy_1.mobile') }}</a>
                    <a class="mem-name" href="{{ url('mb/edata') }}"><i class="far fa-id-card"></i> {{ __('msg_zy_1.real_name2') }}</a>
                    <a class="mem-card" href="{{ url('mb/bank_card') }}"><i class="fas fa-money-check-alt"></i> {{ __('msg_zy_1.bank_card') }}</a>
                    <a class="mem-mail" href="{{ url('mb/edata') }}"><i class="far fa-envelope"></i> {{ __('msg_zy_1.email') }}</a>
                </div>
            </div>
        </div>
        <div class="user-items mem-acc my-2">
            <div class="money-icon"></div>
            <div class="account-balance mb-3">{{ __('msg_zy_1.acc_bal') }}：<span class="text-warning h4" id="acc_bag_money">@{{ acc_bag_money }}</span> {{ __('msg_zy_1.dollars') }}</div>
            <div class="account-balance2 mb-3" style="display: none;">{{ __('msg_zy_1.acc_bal') }}：<span class="text-warning h4">@{{ acc_bag_money }}</span> {{ __('msg_zy_1.dollars') }}</div>
            <div class="d-flex">
                <a class="btn btn-danger btn-sm mr-4" onclick="location.href='{{ url('mb/deposit') }}'">{{ __('msg_zy_1.recharge') }}</a>
                <a class="btn btn-secondary btn-sm" onclick="location.href='{{ url('mb/withdraw') }}'">{{ trans_choice('msg_zy_1.withdraw', 0) }}</a>
            </div>
        </div>
        <div class="user-items mem-news my-2">
            <div class="news_title d-flex align-items-center"><i class="fas fa-question-circle text-warning mr-1"></i> {{ __('msg_zy_1.web_helper') }}</div>
            <div class="news_content">
                <a href="{{ url('helpers#nav-acount') }}" target="_blank">{{ __('msg_zy_1.helpeer_q1') }}</a><br>
                <a href="{{ url('helpers#nav-deposit') }}" target="_blank">{{ __('msg_zy_1.helpeer_q2') }}</a><br>
                <a href="{{ url('helpers#nav-withdrawal') }}" target="_blank">{{ __('msg_zy_1.helpeer_q3') }}</a>
            </div>
        </div>
    </div>
</div>
<script>
    var mb_info_head = new Vue({
        el : '#mb_info_head',
        data : {
            acc_bag_money: '0.00',
            user_info_name: "",     //之後如果可以取得真實姓名 可用此去取得
            user_info_account: "",  //之後如果可以取得帳號 可用此去取得
        },
        created: function(){

            var self = this;
            setTimeout(function(){
                var session_data = "<?php echo session('login_eid')?>";
                if(session_data != ''){
                    self.get_user_info();
                }
            }, 500);

        },
        methods: {
            get_user_info: function(){

                var ApiURL = API_Host + '/mb/user_info';
                Vue.prototype.$http = axios;
                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                        $('#acc_displayalias').html(this.json['info'].displayalias);
                        $('#span_lv').html("VIP-" + this.json['info'].employeelevelord);
                        self.user_info_name = this.json['info'].displayalias;   //之後如果可以取得真實姓名 可用此去取得
                        self.user_info_account = this.json['info'].loginaccount;   //之後如果可以取得帳號 可用此去取得
                    }else{
                        self.alertinfo(this.json['info'], '/');
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