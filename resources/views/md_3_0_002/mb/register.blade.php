<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
<body>
    <div class="container-fluid px-0 header_bg">
        @include($head_name)
    </div>
    <div id="banner" class="container-fluid px-0 banner">
        <div class="banner_register"></div>
    </div>
    <div class="main register-main">
        <div class="main_register">
            <div class="title brown">{{ __('msg_zy_1.mb_register') }}</div>
            <div class="conten" id="register_content">
                <p class="lh_text">{{ __('msg_zy_1.input_register') }}</p>
                <div class="form-group mt-4">
                    <input type="text" class="form-control register_input" id="userid" placeholder="{{ __('.mb_acc') }}" value="" ref="userid" v-model="userid" v-focus>
                    <div class="invalid-feedback">{{ __('msg_zy_1.input_mb_acc') }}</div>
                </div>
                <div class="form-group mt-4">
                    <input type="text" class="form-control register_input" id="alias" placeholder="{{ __('msg_zy_1.real_name') }}" value="" ref="alias" v-model="alias" v-focus>
                    <p class="invalid-feedback" style="display: inline">{{ __('msg_zy_1.input_real_name') }}</p>
                </div>
                <!--<div class="form-group">
                    <input type="text" class="form-control register_input" id="phone" placeholder="{{ __('msg_zy_1.mobile_no') }}" value="" v-model="phone">
                    <div class="invalid-feedback">{{ __('msg_zy_1.input_mobile_no') }}</div>
                </div>-->
                <div class="form-group">
                    <input type="password" class="form-control register_input" id="password" placeholder="{{ __('msg_zy_1.pwd_desc') }}" value="" ref="pwd" v-model="pwd">
                    <div class="invalid-feedback">{{ __('msg_zy_1.input_login_pwd') }}</div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control register_input" id="chkpassword" placeholder="{{ __('msg_zy_1.confirm_pwd') }}" value="" ref="chkpwd" v-model="chkpwd">
                    <div class="invalid-feedback">{{ __('msg_zy_1.again_pwd') }}</div>
                </div>
                <div class="form-group text-left">
                    <label for="recommended">{{ __('msg_zy_1.referrer') }}</label>
                    <input type="text" class="form-control register_input" id="recommended" placeholder="{{ __('msg_zy_1.referrer_acc') }}" value="" v-model="recommended">
                </div>
                <div class="form-group text-left verify_box">
                    <label for="verify">{{ __('msg_zy_1.acc_desc') }}</label>
                    <input class="form-control register_input" name="captcha" placeholder="{{ __('msg_zy_1.captcha') }}" ref="verify" v-model="verify">
                    <div class="verifycode"><img ref="verifycode" src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"></div>
                </div>
                <button type="submit" id="register" class="btn register_now_btn mt-4 mb-2" @click.stop="chk_login">{{ __('msg_zy_1.register_now2') }}</button>
                <p class="login_now">{{ __('msg_zy_1.had_acc') }}, <a href="{{ url('mb/login_page') }}" class="text-white">{{ __('msg_zy_1.immediately_login') }}</a></p>
                <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck" v-model="gridCheck" >
                      <label class="form-check-label ml-0 mb-4 lh_text" for="gridCheck">
                        {{ __('msg_zy_1.agree_agreement') }}
                      </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include($footer_name)
    <script>
        Vue.directive('focus', {
            inserted: function (el) {
                // 聚焦元素
                el.focus()
            }

        });

        var register_content = new Vue({
            el : '#register_content',
            data : {
                alias:'',
                userid : '',
                phone : '',
                pwd : '',
                chkpwd : '',
                recommended : '',
                verify : '',
                gridCheck : false
            },
            methods: {
                chk_login: function(){

                    if(this.userid == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.acc_empty_error"); ?>');
                        this.$refs.userid.focus();
                        return;
                    }
                    if(this.alias == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.name_empty_error"); ?>');
                        this.$refs.alias.focus();
                        return;
                    }
                    if(this.pwd == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.pass_empty_error"); ?>');
                        this.$refs.pwd.focus();
                        return;
                    }
                    if(this.chkpwd == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.pass_empty_error"); ?>');
                        this.$refs.chkpwd.focus();
                        return;
                    }
                    if(this.pwd != this.chkpwd){
                        this.alertinfo('<?php echo __("msg_zy_1.pwd_dif_err"); ?>');
                        this.$refs.chkpwd.focus();
                        return;
                    }
                    if(this.verify == ''){
                        this.alertinfo('<?php echo __("msg_zy_1.captcha_empty_err"); ?>');
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
                        }else{
                            self.alertinfo('<?php echo __("msg_zy_1.register_succ"); ?>', '/');
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
