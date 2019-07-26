<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>    
        <div class="main membe-box" id="editpwd">
            <div class="content">
                <div class="main_member">
                    @include($mb_info_head)
                    <div class="container user-bd">
                        <div class="row">
                            @include($mb_info_left)
                            <div class="col-md-10 middle text-left mt-2">
                                <div class="user-edit-module">
                                    <div class="mem-title">
                                        <h5 class="d-flex align-items-center"><i class="fas fa-unlock-alt mr-2"></i> {{ __('msg_dt_1.edit_login_pwd') }}</h5>
                                    </div>
                                    <div class="d-flex">
                                        <div class="member-name w-50">
                                            <div class="form-group form-row">
                                                <label for="oldpassword" class="col-sm-3 col-form-label">{{ __('msg_dt_1.old_pwd') }} :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="oldpassword" placeholder="{{ __('msg_dt_1.input_opwd') }}" value="" v-model="oldpwd">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="newpassword" class="col-sm-3 col-form-label">{{ __('msg_dt_1.new_pwd') }} :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="newpassword" placeholder="{{ __('msg_dt_1.input_npwd') }}" value="" v-model="newpwd">
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="confirmpassword" class="col-sm-3 col-form-label">{{ __('msg_dt_1.confirm_npwd') }} :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mem_input" id="confirmpassword" placeholder="{{ __('msg_dt_1.input_npwd') }}" value="" v-model="chkpwd">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="savbtn w-50 text-right">
                                        <button type="button" class="btn btn-warning px-5" @click="updpwd()">{{ __('msg_dt_1.submit') }}</button>
                                    </div>
                                </div>
                                <p class="small mt-5">{{ __('msg_dt_1.tips') }}: <span class="text-danger">{{ __('msg_dt_1.tips_desc') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var app = new Vue({
            el : '#editpwd',
            data : {
                oldpwd: '',
                newpwd: '',
                chkpwd: ''
            },
            methods: {
                updpwd: function(){

                    if(this.newpwd != this.chkpwd){
                        this.alertinfo('<?php echo __("msg_dt_1.npwd_err"); ?>');
                        this.newpwd = '';
                        this.chkpwd = '';
                        return;
                    }

                    var ApiURL = API_Host + '/mb/upd_pwd/' + this.oldpwd + '/' + this.newpwd;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_dt_1.pwd_updated"); ?>');
                            self.logout('epwd');
                        }else{
                            self.alertinfo(this.json['info']);
                        }
                        return;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                /*del_login_cookie: function(){

                    var ApiURL = API_Host + '/login_cookie/del';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                }*/
            }
        });
    </script>
</html>
