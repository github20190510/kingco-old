@switch(session('model_type'))
    @case('md_6_0_002_mobile')
        <footer id="footer" v-if="bln_index == 1">
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="#login_btn" aria-hidden="false" style="position:absolute;left:30%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="show_message_title">{{ __('msg_zy_1.my_info') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="show_message_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body" style="width:100%">
                            <div class="container-fluid">
                                <div class="row" v-for="(message,index) in message_datas">
                                    <div class="col-md-12" style="border-bottom:1px dashed black;">@{{ message.text.content }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-if="message_count != 0" type="button" class="btn btn-lh m-auto"  @click="into_message">{{ __('msg_zy_1.check_message') }}</button>
                            <button v-if="url == ''" type="button" class="btn btn-lh m-auto"  data-dismiss="modal">{{ __('msg_zy_1.ok') }}</button>
                            <button v-else type="button" class="btn btn-lh m-auto"  data-dismiss="modal" @click="into_spcific_page(login_bar.url)">{{ __('msg_zy_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="btn-group d-flex fixed-bottom align-items-end footer-menu" role="group">
                <button type="button" class="btn bg-transparent d-flex flex-column align-items-center p-0 w-100" role="button" onclick="location.href='/'"><span class="f-icon home-btn"></span><span>{{ __('msg_dt_1.home') }}</span></button>
                <div class="btn-group w-100 finance-drop m-0 p-0" role="group" id="divfooter">
                    <button type="button" class="btn btn-sm bg-transparent d-flex flex-column align-items-center p-0 dropdown-toggle w-100 f-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="f-icon finance-btn"></span><span>{{ __('msg_dt_1.money_center') }}</span>
                    </button>
                    <div class="dropdown-menu c-alpha-black border-0">
                        <div class="d-flex m-0">
                            <a class="text-white w-100 d-flex flex-column align-items-center" href="/mb/details"><i class="fas fa-chart-line fa-2x"></i>{{ __('msg_dt_1.money_record') }}</a>
                            <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/showrecord"><i class="fas fa-gamepad fa-2x"></i>{{ __('msg_dt_1.betting').__('msg_dt_1.record') }}</a>
                            <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/deposit"><i class="fas fa-piggy-bank fa-2x"></i>{{ __('msg_dt_1.saving_money') }}</a>
                            <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/withdraw"><i class="fas fa-hand-holding-usd fa-2x"></i><spen>{{ __('msg_dt_1.geting_money') }}</spen></a>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button" onclick="location.href='/discount'"><span class="f-icon discount-btn"></span><span>{{ __('msg_dt_1.promotion') }}</span></button>
                <button type="button" class="btn btn-sm bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button" onclick="location.href='/mb/mb_index'"><span class="f-icon account-btn"></span><span>{{ __('msg_dt_1.member_center') }}</span></button>
                <button type="button" class="btn btn-sm bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button" onclick="window.open('https://ic86.ichatshop.com/chat/Hotline/channel.jsp?cid=5010400&cnfid=3603&j=1699111339&s=1'); return false;"><span class="f-icon service-btn"></span><span>{{ __('msg_dt_1.online_service') }}</span></button>
            </nav>
        </footer>
        @break
    @case('md_6_0_002')
    @default
        <footer class="footer" id="footer" v-if="bln_index == 1">
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="#login_btn" aria-hidden="false" style="position:absolute;left:30%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="show_message_title">{{ __('msg_zy_1.my_info') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="show_message_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body" style="width:100%">
                            <div class="container-fluid">
                                <div class="row" v-for="(message,index) in message_datas">
                                    <div class="col-md-12" style="border-bottom:1px dashed black;">@{{ message.text.content }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-if="message_count != 0" type="button" class="btn btn-lh m-auto"  @click="into_message">{{ __('msg_zy_1.check_message') }}</button>
                            <button v-if="url == ''" type="button" class="btn btn-lh m-auto"  data-dismiss="modal">{{ __('msg_zy_1.ok') }}</button>
                            <button v-else type="button" class="btn btn-lh m-auto"  data-dismiss="modal" @click="into_spcific_page(login_bar.url)">{{ __('msg_zy_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                @include('md_5_0_002_mobile.include._help')
                <div class="row game-logo-bar">
                    <div class="col text-center">
                        <span class="game-logo logo-bg"></span>
                        <span class="game-logo logo-bbin"></span>
                        <span class="game-logo logo-ag"></span>
                        <span class="game-logo logo-cg"></span>
                        <span class="game-logo logo-gd"></span>
                        <span class="game-logo logo-mg"></span>
                        <span class="game-logo logo-pt"></span>
                        <span class="game-logo logo-ab"></span>
                        <span class="game-logo logo-sb"></span>
                        <span class="game-logo logo-dg"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col copyright">
                    <div class="">{{ __('msg_zy_1.copyright') }}</div>
                </div>
            </div>
        </footer>
@endswitch
<script>
    var padDate = function(value){

        return value < 10 ? '0' + value : value ;

    }
    var footer = new Vue({
        el: '#footer',
        data:{
            message_count : 0,
            message_datas : [],
            url : "",
            bln_index : 1
        },
        created: function(){

            if(location.pathname != '/' && location.pathname != '/index.php'){
                this.bln_index = 0;
            }

        },
        methods: {
            into_spcific_page: function(url){

                location.href = url;

            },
            into_message: function(){

                location.href = "/mb/message";

            },
            get_user_message: function(){

                var ApiURL = API_Host + '/mb/sysmessage/' + 0 + '/' + 10 + '/' + 'nodata' + '/' + 'nodata' + '/' + '1';
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                        // 跳出定期更換密碼
                        var new_message = new Object();
                        var text = new Object(); 
                        text.content = '<?php echo  __('msg_zy_1.please_change_password_regularly'); ?>';
                        new_message.text = text;
                        this.json['info']['rows'].unshift(new_message);
                        // 跳出定期更換密碼
                        if(this.json['info']['rows'].length > 0){
                            self.message_datas = this.json['info']['rows'];
                            self.message_count = this.json['info']['results'] ;
                            $('#show_message').modal('show');
                            $('#show_message').on('hide.bs.modal',function(e){
                                if (self.url != ''){
                                    location.href = self.url;
                                }
                            });
                        }else{
                            location.href = "/";
                        }
                    }else{
                        self.alertinfo(this.json['info']);
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
        }
    });

    var app = new Vue({
        el : '#time',
        data : {
            date : new Date(),
            model_type : Folder_Name
        },
        filters : {
            formatDate : function(value){

                var date = new Date(value);
                var year = date.getFullYear();
                var month = padDate(date.getMonth() + 1);
                var day = padDate(date.getDate());
                var hours = padDate(date.getHours());
                var minutes = padDate(date.getMinutes());
                var seconds = padDate(date.getSeconds());
                var weekday = ['<?php echo __('msg_zy_1.Sun'); ?>', '<?php echo __('msg_zy_1.Mon'); ?>', '<?php echo __('msg_zy_1.Tus'); ?>', '<?php echo __('msg_zy_1.Wed'); ?>', '<?php echo __('msg_zy_1.Thu'); ?>', '<?php echo __('msg_zy_1.Fri'); ?>', '<?php echo __('msg_zy_1.Sat'); ?>'];
                this.week = weekday[new Date().getDay()];
                return month + '<?php echo __('msg_zy_1.month'); ?>' + day + '<?php echo __('msg_zy_1.day'); ?> ' + hours + ':' + minutes + ':' + seconds + ' ' + this.week;

            }
        },
        mounted : function(){

            var _this = this;
            var count = 0;
            this.timer = setInterval(function(){
                _this.date = new Date();
                if(count >= 300){
                    count = 1;
                    _this.setliving();
                }else{
                    count ++;
                }
            }, 1000);

        },
        beforeDestroy : function(){

            if(this.timer){
                clearInterval(this.timer);
            }

        },
        methods : {
            change_model: function(){

                var ApiURL = API_Host + '/change_model/' + this.$refs.ddl_model.value;
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    location.href = '/';
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        }
    });

    var login_bar = new Vue({
    	el : '#login_bar',
    	data : {
    		login_acc : '',
    		login_pwd : '',
    		login_status : 0,
    		nick_name : '',
            bag_money : 0,
            msg_count : 0,
            show_loading: 0,

    	},
    	created: function(){

            var loading_height = screen.height;
            $('#div_loading').height(loading_height);

    		var ua = new UserAgent();
            var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
            var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

    		var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
            Vue.prototype.$http = axios;
            var session_data = "<?php echo session('login_eid'); ?>";

            var self = this;
            this.$http.get(ApiURL, {cancelToken: source.token})
            .then(function (response) {
                this.json = response.data;

                if(this.json['code'] == '1'){
                    self.login_status = 1;
                    self.login_acc = this.json['info']['acc'];
                    self.nick_name = this.json['info']['nick'];
                    self.getbagmoney(session_data, '<?php echo __("msg_zy_1.balance"); ?> ');
                    self.getmsgcount(session_data);

                    if(location.pathname == '/mb/acc'){
                        $('#user_name').html(this.json['info']['nick']);
                    }
                    if(location.pathname == '/mb/register' || location.pathname.indexOf('/mb/login_page') != -1){
                        self.alertinfo('<?php echo __("msg_zy_1.is_logged"); ?>', '/');
                        return;
                    }

                }else{
                    if(this.json['code'] == '0' && location.pathname.indexOf('/mb/') != -1 && location.pathname.indexOf('/mb/login_page') == -1 && location.pathname != '/mb/register'){
                        self.alertinfo('<?php echo __("msg_zy_1.login_first"); ?>', '/mb/login_page');
                        return;
                    }

                    if(this.json['code'] == '2'){
                        self.alertinfo('<?php echo __('msg_zy_1.auto_error'); ?>');
                        return;
                    }else if(this.json['code'] == '3'){
                        self.alertinfo(this.json['info']);
                        self.logout('footer');
                        return;
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });

            if(location.pathname.indexOf('/game/') != -1){

                if(location.pathname.indexOf('list') != -1 && location.pathname != '/game/card_list'){
                    $('#slots').addClass('active');
                }else{
                    switch(location.pathname){
                        case '/game/sport':
                            $('#sport').addClass('active');
                        break;
                        case '/game/casino':
                            $('#casino').addClass('active');
                        break;
                        case '/game/lottery':
                            $('#lottery').addClass('active');
                        break;
                        case '/game/fish':
                            $('#flish').addClass('active');
                        break;
                        case '/game/card':
                            $('#cardgame').addClass('active');
                        break;
                        case '/game/card_list':
                            $('#cardgame').addClass('active');
                        break;
                        case '/game/card_leg':
                            $('#cardgame').addClass('active');
                        break;
                    }
                }
                
            }else{
                if(location.pathname.indexOf('/discount_content') != -1){
                    $('#promotion').addClass('active');
                }else{
                    switch(location.pathname){
                        case '/discount':
                            $('#promotion').addClass('active');
                        break;                   
                        case '/app':
                            $('#mobile').addClass('active');
                        break;
                        case '/agent':
                            $('#agents').addClass('active');
                        break;
                        default:
                            $('#home').addClass('active');
                        break;
                    }
                }                
            }
    	},
    	methods: {
    		chk_login: function(){

                if(this.login_acc == ''){
		        	this.alertinfo('<?php echo __('msg_zy_1.acc_empty_error'); ?>');
		        	this.$refs.login_acc.focus();                   
		        	return;
		        }
		        if(this.login_pwd == ''){
		        	this.alertinfo('<?php echo __('msg_zy_1.pass_empty_error'); ?>');
		        	this.$refs.login_pwd.focus();
                    return;
		        }else{
                    this.show_loading = 1;
                    document.body.style.overflow = 'hidden';

		        	var ua = new UserAgent();
                    var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                    var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                    var ApiURL = API_Host + '/mb/user_login/' + this.login_acc + '/' + this.login_pwd + '/' + browser_data + '/' +os_data;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] != '1'){
                            self.alertinfo(this.json['info']);
                        }else{
                            try{
                                footer.get_user_message();    //觸發登入時 跳出彈跳視窗時所用的
                            }catch(e){
                                
                            }
                            //self.alertinfo('<?php echo __('msg_zy_1.login_succ'); ?>');
                            self.login_acc = this.json['info']['loginaccount'];
                            self.login_pwd = '';
                            self.login_status = 1;
                            self.nick_name = this.json['info']['displayalias'];
                            self.getbagmoney(this.json['info']['employeecode']);
                            self.getmsgcount(this.json['info']['employeecode']);
                            self.setonline();
                            if(location.pathname.indexOf('/mb/login_page') != -1 || location.pathname == '/mb/register'){
                                self.alertinfo('<?php echo __("msg_zy_1.is_logged"); ?>', '/');
                                return;
                            }
                        }
                        self.show_loading = 0;
                        document.body.style.overflow = 'visible';
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.show_loading = 0;
                        document.body.style.overflow = 'visible';
                    });
		        }
		    },
            alert_forgetpwd: function(){

                this.alertinfo('<?php echo __('msg_zy_1.forget_pwd_desc'); ?>');
                return;

            },
            register: function(){

                location.href = '/mb/register';

            },
            login: function(){

                location.href = '/mb/login_page';

            },
            into_index: function(){

                location.href = "/";

            },
            into_sport_game: function(){

                location.href = "/game/sport";

            },
            into_casino_game: function(){

                location.href = "/game/casino";

            },
            into_lottery_game: function(){

                location.href = "/game/lottery";

            },
            into_cq9_game: function(){

                location.href = "/game/cq9list";

            },
            into_card_game: function(){

                location.href = "/game/card";

            },
            into_fish_game: function(){

                location.href = "/game/fish";

            },
            into_agent: function(){

                location.href = "/agent";

            },
            into_action: function(){

                location.href = "/discount";

            },
            into_app_game: function(){

                location.href = "/app";

            },
            game_not_ready: function(){

                this.alertinfo('<?php echo __("msg_zy_1.game_prepare"); ?>');

            }
    	}
    });

    $(document).ready(function(){

        $('input[type=number]').keypress(function(e) { 
        　　if (!String.fromCharCode(e.keyCode).match(/[0-9.]/)) { 
        　　　　return false; 
        　　} 
        });

    });
</script>