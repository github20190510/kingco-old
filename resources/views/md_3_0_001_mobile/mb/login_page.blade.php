<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        <header class="login-header c-purple fixed-top">
            <div class="d-flex align-items-center">
                <button type="button" class="btn back-btn" onclick="location.href='/'"></button>
                <div class="header-title">{{ __('msg_dt_1.member_login') }}</div>
            </div>
        </header>    
        <main role="main" class="container main register-main" id="login">
            <!--login message-->
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white  border-0">
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="show_message_title">{{ __('msg_dt_1.my_info') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="show_message_close" @click="into_home"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body" style="width:100%">
                            <div class="container-fluid">
                                <div class="row" v-for="(message,index) in message_datas">
                                    <div class="col-md-12" style="border-bottom:1px dashed black;">@{{ message.text.content }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0"> 
                            <button v-if="message_count != 0" type="button" class="btn btn-lh m-auto btn-dark c-gold border-0"  @click="into_message">{{ __('msg_dt_1.check_message') }}</button>
                            <button type="button" class="btn btn-lh m-auto btn-dark c-gold border-0"  @click="into_home">{{ __('msg_dt_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--login message-->
            <form class="needs-validation" novalidate onSubmit="return false;">
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control border-left-0 bg-transparent" id="account" placeholder="{{ __('msg_dt_1.input_username') }}" v-model="login_page_acc" ref="login_page_acc" required v-focus>
                    <div class="invalid-feedback">{{ __('msg_dt_1.input_username') }}</div>
                </div>                
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control border-left-0 bg-transparent" id="password" placeholder="{{ __('msg_dt_1.input_password') }}" v-model="login_page_pwd" ref="login_page_pwd" required>
                    <div class="invalid-feedback">{{ __('msg_dt_1.input_password') }}</div>
                </div> 
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                    </div>
                    <input type="text" class="form-control border-left-0 bg-transparent code-input" id="code" name="captcha" placeholder="{{ __('msg_dt_1.captcha') }}" ref="verify" v-model="verify" required>
                    <div class="input-group-append code-img-box">
                        <span class="code-img" style="background-color:transparent; "><img ref="verifycode" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random()" id="verifycode"><i class="fas fa-sync ml-2" onclick="click_img()"></i></span>
                    </div>
                    <div class="invalid-feedback">
                            {{ __('msg_dt_1.captcha') }}
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-block c-alpha-gold register-btn" @click="chk_page_login">{{ __('msg_dt_1.login_mobile') }}</button>
                <div class="btn-group btn-block mt-3 new-user" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-danger w-50 c-alpha-gold register-btn" @click="goto_register">{{ __('msg_dt_1.register_now_mobile') }}</button>
                    <button type="button" class="btn btn-danger w-50 c-alpha-gold register-btn ml-2 border-radius-r" @click="alert_forgetpwd">{{ __('msg_dt_1.forget_pwd') }}</button>
                    <input type="hidden" ref="dt1" value="{{$gid}}" />
                    <input type="hidden" ref="dt2" value="{{$gtype}}" />
                    <a :href="game_href" target="_blank" ref="gamelink"></a>
                </div>
                <span class="enabled" data-toggle="modal" data-target="#into_game_dialog" id="open_dialog"></span>
                <div class="modal fade mem-modal" id="into_game_dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content c-alpha-white border-0">
                            <div class="modal-header text-white c-gold border-0">
                                <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_dt_1.money_not_enough') }}</h6>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display:none"> <span aria-hidden="true">×</span> </button>
                            </div>
                            <div class="modal-body mt-4">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_dt_1.confirm_into_game') }}</label>
                                </div>
                            </div>
                            <div class="modal-footer"> 
                                <button type="button" class="btn border-0 btn-dark c-gold" @click="trans_point_page" id="trans_point_page">{{ __('msg_dt_1.into_point_page') }}</button>
                                <button type="button" class="btn border-0 btn-dark c-gold" @click="confirm_into_game">{{ __('msg_dt_1.into_game') }}</button>
                                <button type="button" class="btn border-0 btn-dark c-gold" @click="auto_trans_point" id="auto_trans_point">{{ __('msg_dt_1.auto_trans_point') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <!--Footer Menu-->
        @include($footer_name)
        <!-- Bootstrap core JavaScript
            ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <!--表單驗證-->
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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

        $(document).ready(function(){

            $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
                var target = $(this).data('target');
                $(target).on('shown.bs.modal',function(){
                    $('body').addClass('modal-open');

                });
            });

        });

        function click_img(){
            $('#verifycode').click();
        };

        Vue.directive('focus', {
            inserted: function (el) {
                // 聚焦元素
                el.focus()
            }

        });

        var login = new Vue({
            el: '#login',
            data: {
                login_page_acc : '',
                login_page_pwd : '',
                verify : '',
                game_href : '#',
                message_datas: [],
                message_count: 0,
            },
            created: function(){

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
                        self.alertinfo('<?php echo __('msg_dt_1.is_logged'); ?>', '/');
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            methods: {
                chk_page_login: function(){

                    if(this.login_page_acc == ''){
                        //this.alertinfo('<?php echo __('msg_dt_1.acc_empty_error'); ?>');
                        this.$refs.login_page_acc.focus();
                        return;
                    }
                    if(this.login_page_pwd == ''){
                        //this.alertinfo('<?php echo __('msg_dt_1.pass_empty_error'); ?>!');
                        this.$refs.login_page_pwd.focus();
                        return;
                    }

                    if(this.verify == ''){
                        //this.alertinfo('<?php echo __("msg_dt_1.captcha_empty_err"); ?>');
                        this.$refs.verify.focus();
                        return;
                    }else{
                        var ApiURL = API_Host + '/captchacpt/'+this.verify;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL)
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['data'] == 'match'){
                                self.call_login();
                            }else{
                                self.alertinfo('<?php echo __("msg_dt_1.captcha_err"); ?>');
                                var elem = self.$refs.verifycode;
                                elem.click();
                                self.verify = '';
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                        
                    }
                },
                call_login: function(){

                    var ua = new UserAgent();
                    var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                    var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                    var ApiURL = API_Host + '/mb/user_login/' + this.login_page_acc + '/' + this.login_page_pwd + '/' + browser_data + '/' +os_data;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] != '1'){
                            self.alertinfo(this.json['info']);
                            return;
                        }else{
                            self.setonline();
                            //self.alertinfo('<?php echo __('msg_dt_1.login_succ'); ?>!');
                            if(self.$refs.dt1.value != '' && self.$refs.dt2.value != ''){
                                self.chk_has_money();
                            }else{
                                self.get_user_message();
                                // location.href = '/';
                            }

                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                into_message: function(){
                    location.href = "/mb/message";
                },
                into_home: function(){
                    location.href = "/";
                },
                goto_register: function(){

                    location.href = '/mb/register';

                },
                alert_forgetpwd: function(){

                    this.alertinfo('<?php echo __('msg_dt_1.forget_pwd_desc'); ?>');
                    return;

                },
                chk_has_money: function(){

                    var ApiURL = API_Host + '/game/gamebalance/' + this.$refs.dt1.value;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            //進入遊戲
                            $('#open_dialog').click();
                            if(parseInt(this.json['info']) >= 1){
                                self.change_msg();
                            }
                        }else{
                            //導到首頁
                            if(this.json['info'] == '用户不存在'){
                                $('#open_dialog').click();
                            }else{
                                self.alertinfo(this.json['info'], '/');
                                return;
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                trans_point_page: function(){

                    location.href = '/mb/acc';

                },
                confirm_into_game: function(){

                    this.game_href = '/game/intogame/' + this.$refs.dt1.value + '/' + this.$refs.dt2.value;
                    var self = this;
                    setTimeout(function(){
                        self.$refs['gamelink'].click();
                    }, 500);
                    setTimeout(function(){
                        location.href = '/';
                    }, 1000);

                },
                trans_deposit_page: function(){

                    location.href = '/mb/deposit';

                },
                auto_trans_point: function(){

                    //先取回錢包金額
                    var ApiURL = API_Host + '/game/getmybagmoney';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.trans_point(this.json['code']);
                        }else{
                            self.alertinfo(this.json['info'], '/');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                trans_point: function(money){

                    if(parseInt(money) != NaN && parseInt(money) > 0){
                        if(this.$refs.dt1.value != ''){
                            var ApiURL = API_Host + '/game/setmoney/' + this.$refs.dt1.value + '/' + money;
                            Vue.prototype.$http = axios;

                            var self = this;
                            this.$http.get(ApiURL)
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] == '1'){
                                    self.alertinfo('<?php echo __("msg_dt_1.trans_in_succ"); ?><?php echo __("msg_dt_1.click_into_game_button"); ?>');
                                    self.change_msg();
                                }else{
                                    self.alertinfo(this.json['info']);
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        }else{
                            this.alertinfo('<?php echo __("msg_dt_1.trans_in_err"); ?>', '/mb/acc');
                            return;
                        }
                    }else{
                        if(confirm('<?php echo __("msg_dt_1.bag_money_not_enough"); ?>')){
                            this.change_msg();
                        }else{
                            this.trans_deposit_page();
                        }
                    }

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
                            text.content = '<?php echo  __('msg_dt_1.please_change_password_regularly'); ?>';
                            new_message.text = text;
                            this.json['info']['rows'].unshift(new_message);
                            // 跳出定期更換密碼
                            if(this.json['info']['rows'].length > 0){
                                self.message_datas = this.json['info']['rows'];
                                self.message_count = this.json['info']['results'] ;
                                $('#show_message').modal('show');
                                $('#show_message').on('hide.bs.modal',function(e){
                                    location.href = '/';
                                });
                            }else{
                                location.href = '/';
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
                change_msg: function(){

                    $('#trans_point_page').hide();
                    $('#auto_trans_point').hide();
                    $('#msg_data').html('<?php echo __("msg_dt_1.click_into_game_button"); ?>');
                    $('#exampleModalLabel').html('<?php echo __("msg_dt_1.into_game"); ?>');

                }
            }

        });
        </script>
    </body>
</html>
