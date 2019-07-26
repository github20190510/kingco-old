<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">    
        <header class="login-header c-purple fixed-top">
            <div class="d-flex align-items-center">
                <button type="button" class="btn back-btn" onclick="location.href='/'"></button>
                <div class="header-title">{{ __('msg_zy_1.mb_register') }}</div>
            </div>
        </header>
        <main role="main" class="container main register-main" id="register">
            <form class="needs-validation" novalidate onSubmit="return false;">                
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                     <input type="text" class="form-control border-left-0 bg-transparent" id="account" placeholder="{{ __('msg_zy_1.input_mb_acc') }}" required v-focus ref="userid" v-model="userid">
                    <div class="invalid-feedback">
                            {{ __('msg_zy_1.input_mb_acc') }}
                    </div>
                </div>     
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                     <input type="text" class="form-control border-left-0 bg-transparent" id="alias" placeholder="{{ __('msg_zy_1.real_name') }}" required v-focus ref="alias" v-model="alias">
                    <div class="invalid-feedback" style="display: inline">
                            {{ __('msg_zy_1.input_real_name') }}
                    </div>
                </div>            
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control border-left-0 bg-transparent" id="password" placeholder="{{ __('msg_zy_1.input_login_pwd') }}" required ref="pwd" v-model="pwd">
                    <div class="invalid-feedback">
                            {{ __('msg_zy_1.input_login_pwd') }}
                    </div>
                </div>                
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control border-left-0 bg-transparent" id="password-confirm" placeholder="{{ __('msg_zy_1.again_pwd') }}" required ref="chkpwd" v-model="chkpwd">
                    <div class="invalid-feedback">
                            {{ __('msg_zy_1.again_pwd') }}
                    </div>
                </div>
                <div class="input-group register-input">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                    </div>
                    <input type="text" class="form-control border-left-0 bg-transparent code-input" id="code" name="captcha" placeholder="{{ __('msg_zy_1.captcha') }}" ref="verify" v-model="verify" required>
                    <div class="input-group-append code-img-box">
                        <span class="code-img"><img ref="verifycode" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random()" id="verifycode"><i class="fas fa-sync text-white ml-2" onclick="click_img()"></i></span>
                    </div>
                    <div class="invalid-feedback">{{ __('msg_zy_1.captcha_empty_err') }}</div>
                </div>
                <button type="submit" class="btn btn-danger btn-block c-alpha-gold register-btn" @click.stop="chk_login">{{ __('msg_zy_1.register_now2') }}</button>
                <div class="text-center mt-3">
                    <label class="checkbox-group">{{ __('msg_zy_1.agree_agreement_mobile') }}
                        <input type="checkbox" checked="checked" id="gridCheck" v-model="gridCheck">
                        <span class="checkmark" for="gridCheck"></span>
                    </label>
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

        function click_img(){
            $('#verifycode').click();
        };

        Vue.directive('focus', {
            inserted: function (el) {
                // 聚焦元素
                el.focus()
            }

        });

        var register = new Vue({
            el: '#register', 
            data: {
                alias:'',
                userid : '',
                pwd : '',
                chkpwd : '',
                verify : '',
                gridCheck : false
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
                        self.alertinfo('<?php echo __("msg_zy_1.is_logged"); ?>', '/');
                        return;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            methods: {
                chk_login: function(){

                    if(this.userid == ''){
                        //this.alertinfo('<?php echo __("msg_zy_1.acc_empty_error"); ?>');
                        this.$refs.userid.focus();
                        return;
                    }
                    if(this.alias == ''){
                        //this.alertinfo('<?php echo __("msg_zy_1.name_empty_error"); ?>');
                        this.$refs.alias.focus();
                        return;
                    }
                    if(this.pwd == ''){
                        //this.alertinfo('<?php echo __("msg_zy_1.pass_empty_error"); ?>');
                        this.$refs.pwd.focus();
                        return;
                    }
                    if(this.chkpwd == ''){
                        //this.alertinfo('<?php echo __("msg_zy_1.pass_empty_error"); ?>');
                        this.$refs.chkpwd.focus();
                        return;
                    }
                    if(this.pwd != this.chkpwd){
                        //this.alertinfo('<?php echo __("msg_zy_1.pwd_dif_err"); ?>');
                        this.$refs.chkpwd.focus();
                        return;
                    }
                    if(this.verify == ''){
                        //this.alertinfo('<?php echo __("msg_zy_1.captcha_empty_err"); ?>');
                        this.$refs.verify.focus();
                        return;
                    }
                    if(this.gridCheck != true){
                        this.alertinfo('<?php echo __("msg_zy_1.agree_err"); ?>');
                        return;
                    }
                    var ApiURL = API_Host + '/captchacpt/'+this.verify;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['data'] == 'match'){
                            self.call_register(self.userid, self.phone, self.pwd, self.alias, self.chkpwd, self.recommended);
                        }else{
                            self.alertinfo('<?php echo __("msg_zy_1.captcha_err"); ?>');
                            var elem = self.$refs.verifycode;
                            elem.click();
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                call_register: function(userid, phone, pwd, alias, chkpwd, recommended){

                    var ua = new UserAgent();
                    var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
                    var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

                    var ApiURL = API_Host + '/mb/user_register/' + userid +'/' + pwd + '/' + chkpwd + '/' + alias + '/' + browser_data + '/' +os_data;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] != '1'){
                            self.alertinfo(this.json['info']);
                            return;
                        }else{
                            self.alertinfo('<?php echo __("msg_zy_1.register_succ"); ?>', '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                refresh_img: function(){

                    this.$refs.verifycode.click();

                }
            }
        });
        </script>
    </body>
</html>
