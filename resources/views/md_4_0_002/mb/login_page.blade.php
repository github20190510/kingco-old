<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_register"></div>
        </div>
        <div class="main membe-box">
            <div id="loginModal" class="login_modal">
                <!--<span class="login_modal_close"></span>-->
                <div class="login_modal_header">
                    <div class="login_modal_title" id="rcDialogTitle1">{{ __('msg_zy_1.login') }}</div>
                </div>
                <div class="login_modal_body">
                    <div class="login-form-module">
                        <div class="form-group">
                            <input name="username" autocomplete="username" class="form-control login_input" v-model="login_page_acc" ref="login_page_acc" placeholder="{{ __('msg_zy_1.input_username') }}" type="text" value="">
                        </div>
                        <div class="form-group">
                            <input name="password" autocomplete="password" type="password" class="form-control login_input" v-model="login_page_pwd" ref="login_page_pwd" placeholder="{{ __('msg_zy_1.input_password') }}" value="">
                        </div>
                        <div class="form-group">
                            <div class="form-check auto_login">
                                <input class="form-check-input" type="checkbox" id="gridCheck" v-model="login_page_auto" ref="login_page_auto">
                                <label class="form-check-label" for="gridCheck">{{ __('msg_zy_1.auto_login') }}</label>
                            </div>
                        </div>
                        <div class="form-group btn_submit">
                            <button class="btn login_now_btn" v-on:click="chk_page_login">{{ __('msg_zy_1.immediately_login') }}</button>
                        </div>
                        <div class="form-group btn_submit">
                            <button class="btn register_now_btn" onclick="location.href='{{ url('mb/register') }}'">{{ __('msg_zy_1.register_now') }}</button>
                            <input type="hidden" ref="dt1" value="{{$gid}}" />
                            <input type="hidden" ref="dt2" value="{{$gtype}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
        <script>
            var loginModal = new Vue({
                el : '#loginModal',
                data : {
                    login_page_acc : '',
                    login_page_pwd : '',
                    login_page_auto : 0
                },
                created: function(){

                    /*var ua = new UserAgent();
                    var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                    var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                    var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __('msg_zy_1.is_logged'); ?>', '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });*/

                },
                methods: {
                    chk_page_login: function(){

                        if(this.login_page_acc == ''){
                            this.alertinfo('<?php echo __('msg_zy_1.acc_empty_error'); ?>');
                            this.$refs.login_page_acc.focus();
                            return;
                        }
                        if(this.login_page_pwd == ''){
                            this.alertinfo('<?php echo __('msg_zy_1.pass_empty_error'); ?>!');
                            this.$refs.login_page_pwd.focus();
                            return;
                        }else{
                            var ua = new UserAgent();
                            var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                            var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                            var ApiURL = API_Host + '/mb/user_login/' + this.login_page_acc + '/' + this.login_page_pwd + '/' + browser_data + '/' +os_data + '/' + this.login_page_auto;
                            Vue.prototype.$http = axios;

                            var self = this;
                            this.$http.get(ApiURL)
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] != '1'){
                                    self.alertinfo(this.json['info']);
                                    return;
                                }else{
                                    //self.alertinfo('<?php echo __('msg_zy_1.login_succ'); ?>!');
                                    if(self.login_page_auto == 1){
                                        self.save_cookie(self.login_page_acc, self.login_page_pwd);
                                    }
                                    if(self.$refs.dt1.value != '' && self.$refs.dt2.value != ''){
                                        var url = '/game/intogame/' + self.$refs.dt1.value + '/' + self.$refs.dt2.value;
                                    }else{
                                        var url = '/';
                                    }
                                    footer.url = url;
                                    footer.get_user_message();    //觸發登入時 跳出彈跳視窗時所用的
                                    return;
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                        }
                    },
                    save_cookie: function(acc, pwd){

                        var ApiURL = API_Host + '/login_cookie/set/' + acc + '/' + pwd;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL)
                        .then(function (response) {
                            this.json = response.data;
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
