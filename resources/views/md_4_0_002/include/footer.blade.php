<!--<div class="container footer">
	<div class="partner_title">{{ __('msg_zy_1.partner') }}</div>
	<div class="partner_subtitle">BEST PARTNER</div>
	<div class="partner_icon">
	    <ul>
	        <li class="og"></li>
	        <li class="ag"></li>
	        <li class="sunbet"></li>
	        <li class="opus"></li>
	        <li class="pt"></li>
	        <li class="mg"></li>
	        <li class="ab"></li>
	        <li class="bbin"></li>
	        <li class="qt"></li>
	        <li class="hb"></li>
	        <li class="yoplay"></li>
	        <li class="pg"></li>
	        <li class="cg"></li>
	        <li class="keno"></li>
	        <li class="tb"></li>
	        <li class="t188"></li>
	        <li class="sb"></li>
	        <li class="gd"></li>
	        <li class="ss"></li>
	        <li class="tc"></li>
	        <li class="bg"></li>
	        <li class="mw"></li>
	        <li class="tcg"></li>
	        <li class="aiav"></li>
	        <li class="bet818"></li>
	        <li class="gb"></li>
	    </ul>
	</div>
	<div class="copyright text-white text-center">
	    <p>{{ __('msg_zy_1.copyright_desc') }}<br>
	    {{ __('msg_zy_1.copyright') }}</p>
	</div>
</div>-->
<div class="footer" id="footer">
    <!--login message-->
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="#login_btn" aria-hidden="false" >
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
                            <button v-else type="button" class="btn btn-lh m-auto"  data-dismiss="modal" @click="into_spcific_page(url)">{{ __('msg_zy_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--login message-->
    <div class="copyright text-white text-center">
        <p>{{ __('msg_zy_1.copyright_desc') }} {{ __('msg_zy_1.copyright') }}</p>
    </div>
</div>
<script>
    var padDate = function(value){

        return value < 10 ? '0' + value : value ;

    }
    var footer = new Vue({
            el: '#footer',
            data:{
                message_count: 0,
                message_datas: [],
                url: "",
            },
            methods: {
                into_spcific_page: function(url){
                    location.href=url;
                },
                close_box: function(){
                    this.show_box = 0;
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
                                if (window.location.pathname == "/mb/login_page"){
                                    location.href = "/";
                                }
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
    	created: function(){

            var loading_height = screen.height;
            $('#div_loading').height(loading_height);

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
                    self.login_status = 1;
                    self.login_acc = this.json['info']['acc'];
                    self.nick_name = this.json['info']['nick'];
                    self.getbagmoney(session_data);
                    self.getmsgcount(session_data);
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

    var game_menu = new Vue({
        el : '#game_menu',
        data : {
            now_act: 1,
            is_index : 0
        },
        created: function(){
            this.is_index = this.chk_index();
        },
        methods: {
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

            }
        }
    });

    var notic_bar = new Vue({
        el : '#notic_bar',
        data : {
            notic_data : '',
            is_index : 0
        },
        created: function(){

            this.is_index = this.chk_index();
            this.get_new_notic();
        },
        methods: {
            get_new_notic: function(){

                var ApiURL = API_Host + '/system/notic/0/99';
                Vue.prototype.$http = axios;

                var self = this;
                this.$http.get(ApiURL, {cancelToken: source.token})
                .then(function (response) {
                    this.json = response.data;
                    if(this.json['code'] == '1'){
                        if(this.json['info'].length > 0){
                            self.notic_data = this.json['info'];
                        }
                    }else{
                        self.alertinfo(this.json['info']);
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        }
    });

    var show_carousel = new Vue({
        el : '#carouselExampleIndicators',
        data : {
            is_index : 0
        },
        created: function(){

            this.is_index = this.chk_index();

        }
    });

    var show_carousel = new Vue({
        el : '#game_menu_list',
        data : {
            is_index : 0
        },
        created: function(){

            this.is_index = this.chk_index();

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