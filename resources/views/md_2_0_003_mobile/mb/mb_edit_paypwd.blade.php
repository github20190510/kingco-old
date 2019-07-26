<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
         @include($mb_head_name)
        <!--登入後使用者名稱-->
        <div id="eppwd">
            <main role="main" class="container main register-main">
                <form class="needs-validation" novalidate onSubmit="return false;">
                    <div class="input-group register-input" v-if="oldpwd != 'nodata'">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 bg-transparent" id="passwordOld" placeholder="{{ __('msg_fcs_1.input_opwd') }}" required v-model="oldpwd">
                        <div class="invalid-feedback">{{ __('msg_fcs_1.input_opwd') }}</div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 bg-transparent" id="password" placeholder="{{ __('msg_fcs_1.input_npwd') }}" required v-model="newpwd">
                        <div class="invalid-feedback">{{ __('msg_fcs_1.input_npwd') }}</div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 bg-transparent" id="password-confirm" placeholder="{{ __('msg_fcs_1.confirm_npwd') }}" required v-model="chkpwd">
                        <div class="invalid-feedback">{{ __('msg_fcs_1.input_npwd') }}</div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block c-alpha-gold register-btn" @click="updpwd()">{{ __('msg_fcs_1.submit') }}</button>
                </form>
            </main>
        </div>
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

        var eppwd = new Vue({
            el: '#eppwd',
            data: {
                oldpwd: '',
                newpwd: '',
                chkpwd: ''
            },
            created: function(){
                this.get_user_info();
            },
            methods: {
                updpwd: function(){

                    if(this.newpwd != this.chkpwd){
                        this.alertinfo('<?php echo __("msg_fcs_1.npwd_err"); ?>');
                        this.newpwd = '';
                        this.chkpwd = '';
                        return;
                    }

                    var ApiURL = API_Host + '/mb/upd_ppwd/' + this.oldpwd + '/' + this.newpwd;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_fcs_1.pay_pwd_updated"); ?>', '/mb/eppwd');
                        }else{
                            self.alertinfo(this.json['info']);
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                get_user_info: function(){

                    var ApiURL = API_Host + '/mb/user_info';
                    Vue.prototype.$http = axios;
                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info']['fundpassword'] == 'false'){
                                self.oldpwd = 'nodata';
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
    </body>
</html>
