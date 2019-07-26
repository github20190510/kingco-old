<div id="menu">
	<nav class="navbar navbar-expand-md fixed-top navbar-dark c-alpha-grey nav-header"> <a class="navbar-brand lh-logo" href="/"></a>
		<div class="ml-auto login-box">
			<button type="button" class="btn login-btn" @click="register" v-if="login_status === '0'">{{ __('msg_dt_1.register') }}</button>
			<button type="button" class="btn login-btn" @click="login" v-if="login_status === '0'">{{ __('msg_dt_1.login_mobile') }}</button>
		</div>
		<button class="navbar-toggler p-0 border-0 menu-btn" :class="{'new-msg' : msg_count > 0}" type="button" data-toggle="offcanvas"> <!--<span class="navbar-toggler-icon"></span>--> </button>
		<div class="navbar-collapse offcanvas-collapse align-items-start" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
			<li class="nav-item" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" :href="[login_status === '1' ? '/mb/mb_index' : '/mb/login_page']">
                    <i class="fas fa-user-cog fa-fw"></i> 
                        {{ __('msg_dt_1.member_center') }}
                </a> 
            </li>

            <li class="nav-item" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" :href="[login_status === '1' ? '/mb/acc' : '/mb/login_page']" >
                    <i class="fas fa-id-card fa-fw"></i> 
                        {{ __('msg_dt_1.mb_account') }}
                </a> 
            </li>

            <li class="nav-item" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" :href="[login_status === '1' ? '/mb/edata' : '/mb/login_page']" >
                    <i class="fas fa-user-alt fa-fw"></i> 
                        {{ __('msg_dt_1.personal_inf') }}
                </a> 
            </li>

            <li class="nav-item" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" :href="[login_status === '1' ? '/mb/message' : '/mb/login_page']" >
                    <i class="fas fa-bell fa-fw"></i> 
                        {{ __('msg_dt_1.my_info') }}
                </a> 
            </li>

            <li class="nav-item" v-if="login_status === '1'" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" target="_blank" href="http://av.dtg1688.net/">
                    <i class="fas fa-film fa-fw"></i>
                        {{ __('msg_dt_1.movie_link') }}
                </a>
            </li>
			<li class="nav-item active"> 
                <a class="nav-link" href="/helpers">
                    <i class="fas fa-user-tie fa-fw"></i> 
                        {{ __('msg_dt_1.about_us') }}
                </a> 
            </li>

            <!--<li class="nav-item" :class="{'active': login_status === '1'}"> <a class="nav-link" href="#" @click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')"><i class="fas fa-sign-out-alt fa-fw"></i> {{ __('msg_dt_1.logout2') }}</a></li>-->
            
            <li class="nav-item" :class="{'active': login_status === '1'}"> 
                <a class="nav-link" href="#" @click="[login_status === '1'? logout('head', '{{ __('msg_dt_1.logout_succ') }}'):'']">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                        <?php echo trans(__('msg_dt_1.logout2')) ?>
                </a>
            </li>
			<!--<li class="nav-item"> <a class="nav-link" href="#"><i class="fas fa-desktop fa-fw"></i> 电  脑  版</a> </li>-->
		</ul>
		</div>
	</nav>
	<!--登入後使用者名稱-->
    <div class="user-bar d-flex align-items-center justify-content-between" v-if="login_status === '1'">
        <div class="col-10">
            <div class="row">
                <span class="username"><i class="fas fa-user fa-fw"></i> @{{login_acc}}</span>
                <span class="credit" id="acc_money"><i class="fas fa-wallet fa-fw"></i> {{ __('msg_dt_1.balance') }} 0.00</span>
            </div>
        </div>
        <button type="button" class="btn ml-auto mx-0 login-btn" @click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')">{{ __('msg_dt_1.logout_mobile') }}</button>
    </div>
</div>

<script>
var menu = new Vue({
    el: '#menu', 
    data: {
        login_status: '0',
        login_acc : '',
        nick_name : '',
        msg_count : 0
    },
    created: function(){

        var ua = new UserAgent();
        var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
        var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

        var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
        Vue.prototype.$http = axios;

        var session_data = "<?php echo session('login_eid')?>";

        var self = this;
        this.$http.get(ApiURL, {cancelToken: source.token})
        .then(function (response) {
            this.json = response.data;
            if(this.json['code'] == '1'){
                is_login = true;
                self.login_status = '1';
                self.login_acc = this.json['info']['acc'];
                self.nick_name = this.json['info']['nick'];
                self.getbagmoney(session_data, '<?php echo __("msg_dt_1.balance"); ?> ');
                self.getmsgcount(session_data);
            }else if(this.json['code'] == '2'){
                is_login = false;
                self.alertinfo('<?php echo __('msg_dt_1.auto_error'); ?>');
                return;
            }else if(this.json['code'] == '3'){
                is_login = false;
                self.alertinfo(this.json['info']);
                self.logout('head_other_login'); 
                return;
            }
        })
        .catch(function (error) {
            console.log(error);
        });

    },
    methods: {

        register: function(){
            location.href = '/mb/register';
        },
        login: function(){
            location.href = '/mb/login_page';
        }

    }

});
</script>