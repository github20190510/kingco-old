<div id="mb_head">
    <header class="login-header c-purple fixed-top navbar-dark">
        <div class="d-flex align-items-center">
            <button type="button" class="btn back-btn" onclick="history.go(-1)"></button>
            <div class="header-title">@{{title}}</div>
            <button class="navbar-toggler p-0 border-0 menu-btn ml-auto" type="button" data-toggle="offcanvas"> <span class="navbar-toggler-icon" :class="{'new-msg' : msg_count > 0}"></span> </button>
            <div class="navbar-collapse offcanvas-collapse align-items-start" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="/mb/mb_index"><i class="fas fa-user-cog fa-fw"></i> {{ __('msg_dt_1.member_center') }}</a> </li>
                    <li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="/mb/acc"><i class="fas fa-id-card fa-fw"></i> {{ __('msg_dt_1.mb_account') }}</a> </li>
                    <li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="/mb/edata"><i class="fas fa-user-alt fa-fw"></i> {{ __('msg_dt_1.personal_inf') }}</a> </li>
                    <li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="/mb/message"><i class="fas fa-bell fa-fw"></i> {{ __('msg_dt_1.my_info') }}</a> </li>
                    <li class="nav-item" v-if="login_status === '1'" :class="{'active': login_status === '1'}"> <a class="nav-link" target="_blank" href="http://av.dtg1688.net/"><i class="fas fa-film fa-fw"></i>{{ __('msg_dt_1.movie_link') }}</a></li>
                    <li class="nav-item active"> <a class="nav-link" href="/helpers"><i class="fas fa-user-tie fa-fw"></i> {{ __('msg_dt_1.about_us') }}</a> </li>
                    <li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="#" @click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')"><i class="fas fa-sign-out-alt fa-fw"></i> <?php echo trans(__('msg_dt_1.logout2')) ?></a></li>
                    <!--<li class="nav-item"> <a class="nav-link" href="#"><i class="fas fa-desktop fa-fw"></i> 电  脑  版</a> </li>-->
                </ul>
            </div>
        </div>
    </header>
    <!--登入後使用者名稱-->
    <div class="user-bar d-flex align-items-center justify-content-between" v-if="login_status === '1'">
        <div class="col-10 flex-shrink-1">
            <div class="row">
                <span class="username"><i class="fas fa-user fa-fw"></i> @{{login_acc}}</span>
                <span class="credit" id="mb_acc_money"><i class="fas fa-wallet fa-fw"></i> {{ __('msg_dt_1.balance') }} 0.00</span>
            </div>
        </div>
        <button type="button" class="btn text-white ml-auto mx-0 flex-shrink-0 bg-transparent" onclick="location.reload();"><i class="fas fa-sync-alt"></i></button>        
    </div>
</div>
<script>
var mb_head = new Vue({
    el: '#mb_head', 
    data: {
        login_status: '0',
        nick_name : '',
        title: '<?php echo __("msg_dt_1.member_center"); ?>',
        msg_count : 0,
        login_acc : ''
    },
    created: function(){

        var ua = new UserAgent();
        var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
        var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

        var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
        Vue.prototype.$http = axios;

        var session_data = "<?php echo session('login_eid')?>";

        this.get_title();

        var self = this;
        this.$http.get(ApiURL, {cancelToken: source.token})
        .then(function (response) {
            this.json = response.data;
            if(this.json['code'] == '1'){
                self.login_status = '1';
                self.login_acc = this.json['info']['acc'];
                //self.nick_name = this.json['info']['nick'];
                self.getbagmoney(session_data, '<?php echo __("msg_zy_1.balance"); ?> ', '<?php echo __("msg_zy_1.account_money"); ?>');
                self.get_user_info();
                self.getmsgcount(session_data);
            }else if(this.json['code'] == '2'){
                self.alertinfo('<?php echo __('msg_dt_1.auto_error'); ?>', '/mb/login_page');
                return;
            }else if(this.json['code'] == '3'){
                self.alertinfo(this.json['info']);
                self.logout('head_other_login'); 
                return;
            }else{
                if(location.pathname != '/discount' && location.pathname.indexOf('/discount_content') == -1){
                    self.alertinfo('<?php echo __("msg_dt_1.login_first"); ?>', '/mb/login_page');
                    return;
                }
                
            }
        })
        .catch(function (error) {
            console.log(error);
        });

    },
    methods: {
        get_title: function(){

            var self = this;
            switch(location.pathname.replace(/\\d*/g, '')){
                case '/mb/acc':
                    self.title = '{{ __("msg_dt_1.mb_account") }}';
                    break;
                case '/mb/epwd':
                    self.title = '{{ __("msg_dt_1.edit_login_pwd") }}';
                    break;
                case '/mb/eppwd':
                    self.title = '{{ __("msg_dt_1.edit_pay_pwd") }}';
                    break;
                case '/discount':
                    self.title = '{{ __("msg_dt_1.promotion") }}';
                    break;
                case '/discount_content':
                    self.title = '{{ __("msg_dt_1.promotion") }}';
                    break;
                case '/mb/bank_card':
                    self.title = '{{ __("msg_dt_1.bank_card") }}';
                    break;
                case '/mb/bank_card_add':
                    self.title = '{{ __("msg_dt_1.add_bank_card_mobile") }}';
                    break;
                case '/mb/edata':
                    self.title = '{{ __("msg_dt_1.personal_inf") }}';
                    break;
                case '/mb/deposit':
                    self.title = '{{ __("msg_dt_1.saving_money") }}';
                    break;
                case '/mb/withdraw':
                    self.title = '{{ __("msg_dt_1.geting_money") }}';
                    break;
                case '/mb/notic':
                    self.title = '{{ __("msg_dt_1.system").__("msg_dt_1.notification") }}';
                    break;
                case '/mb/message':
                    self.title = '{{ __("msg_dt_1.my_info") }}';
                    break;
                case '/mb/deposit_list':
                    self.title = '{{ __("msg_dt_1.deposit").__("msg_dt_1.record") }}';
                    break;
                case '/mb/withdraw_list':
                    self.title = '{{ trans_choice("msg_dt_1.withdraw", 1).__("msg_dt_1.record") }}';
                    break;
                case '/mb/details':
                    self.title = '{{ __("msg_dt_1.money_record") }}';
                    break;
                case '/mb/showrecord':
                    self.title = '{{ __("msg_dt_1.betting") . __("msg_dt_1.record") }}';
                    break;
            }
        },
        get_user_info: function(){

            var ApiURL = API_Host + '/mb/user_info';
            Vue.prototype.$http = axios;
            var self = this;
            this.$http.get(ApiURL, {cancelToken: source.token})
            .then(function (response) {
                this.json = response.data;
                if(this.json['code'] == '1'){
                    /*$('#acc_displayalias').html(this.json['info'].displayalias);
                    $('#span_lv').html("VIP-" + this.json['info'].employeelevelord);
                    self.user_info_name = this.json['info'].displayalias;   //之後如果可以取得真實姓名 可用此去取得
                    self.user_info_account = this.json['info'].loginaccount;   //之後如果可以取得帳號 可用此去取得*/
                    self.nick_name = this.json['info']['displayalias'];
                    if(location.pathname == '/mb/acc'){
                        $('#user_name').html(this.json['info']['displayalias']);
                    }
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
