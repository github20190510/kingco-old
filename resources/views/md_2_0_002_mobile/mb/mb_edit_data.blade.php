<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_edit_data">
            <main role="main" class="container main bank-main">
                <form class="needs-validation" novalidate onSubmit="return false;">
                    <div class="my-picture c-alpha-gold"><i class="far fa-user fa-3x"></i></div>
                    <!-- <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user fa-fw mr-1"></i> <span class="text-white">{{ __('msg_zy_1.nickname') }} : </span></span>
                        </div>
                        <input type="text" class="form-control border-left-0 bg-transparent" id="account" placeholder="{{ __('msg_zy_1.input_nickname') }}" value="" v-model="displayalias" required :disabled="has_nick == 1">
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_nickname') }}
                        </div>
                    </div> -->
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-passport fa-fw mr-1"></i> <span class="text-white">{{ __('msg_zy_1.real_name') }} :</span></span>
                        </div>
                        <input v-if="has_real_name == 0" type="text" class="form-control border-left-0 bg-transparent" id="realname" placeholder="{{ __('msg_zy_1.real_name_desc1') }}" v-model="real_name" required >
                        <input v-if="has_real_name == 1" type="text" class="form-control border-left-0 bg-transparent" id="realname" placeholder="{{ __('msg_zy_1.real_name_desc1') }}" :value="hide_string('name',real_name)" disabled>
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.real_name_desc1') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-mobile-alt fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.mobile') }} :</span></span>
                        </div>
                        <input v-if="has_phoneno == 0" type="text" class="form-control border-left-0 bg-transparent" id="phone" placeholder="{{ __('msg_zy_1.input_mobile') }}" v-model="phoneno" required >
                        <input v-if="has_phoneno == 1" type="text" class="form-control border-left-0 bg-transparent" id="phone" placeholder="{{ __('msg_zy_1.input_mobile') }}" :value="hide_string('phone',phoneno)"  disabled>
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_mobile') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-envelope fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.email') }} :</span></span>
                        </div>
                        <input v-if="has_email == 0" type="text" class="form-control border-left-0 bg-transparent" id="email" placeholder="{{ __('msg_zy_1.input_email') }}" v-model="email" required />
                        <input v-if="has_email == 1" type="text" class="form-control border-left-0 bg-transparent" id="email" placeholder="{{ __('msg_zy_1.input_email') }}" :value="hide_string('email',email)"  disabled />
                        <div class="invalid-feedback">
                                {{ __('msg_zy_1.input_email') }}
                        </div>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-qq fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.qq') }} :</span></span>
                        </div>
                        <input v-if="has_qq == 0" type="text" class="form-control border-left-0 bg-transparent" id="qq" placeholder="{{ __('msg_zy_1.input_qq') }}" v-model="qq" />
                        <input v-if="has_qq == 1" type="text" class="form-control border-left-0 bg-transparent" id="qq" placeholder="{{ __('msg_zy_1.input_qq') }}" :value="hide_string('qq',qq)"  disabled/>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-weixin fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.wechat') }} :</span></span>
                        </div>
                        <input v-if="has_wechat == 0" type="text" class="form-control border-left-0 bg-transparent" id="wechat" placeholder="{{ __('msg_zy_1.input_wechat') }}" v-model="wechat" />
                        <input v-if="has_wechat == 1" type="text" class="form-control border-left-0 bg-transparent" id="wechat" placeholder="{{ __('msg_zy_1.input_wechat') }}" :value="hide_string('wechat',wechat)"  disabled/>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-line fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.line') }} :</span></span>
                        </div>
                        <input v-if="has_line == 0" type="text" class="form-control border-left-0 bg-transparent" id="line" placeholder="{{ __('msg_zy_1.line') }}"  v-model="line" />
                        <input v-if="has_line == 1" type="text" class="form-control border-left-0 bg-transparent" id="line" placeholder="{{ __('msg_zy_1.line') }}" :value="hide_string('line',line)"  disabled/>
                    </div>
                    <div class="input-group register-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-skype fa-fw mr-1"></i><span class="text-white">{{ __('msg_zy_1.skype') }} :</span></span>
                        </div>
                        <input v-if="has_skype == 0" type="text" class="form-control border-left-0 bg-transparent" id="skype" placeholder="{{ __('msg_zy_1.skype') }}" v-model="skype" />
                        <input v-if="has_skype == 1" type="text" class="form-control border-left-0 bg-transparent" id="skype" placeholder="{{ __('msg_zy_1.skype') }}" :value="hide_string('skype',skype)"  disabled/>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn mb-3" @click="update_mb_data">{{ __('msg_zy_1.save') }}</button>
                </form>
            </main>
        </div>
        <!--go to top-->
        <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
            <i class="fas fa-angle-up fa-lg"></i>
        </a>
        <!--Footer Menu-->
        @include($footer_name)
        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script>
        var mb_edit_data = new Vue({
            el: '#mb_edit_data',
            data: {
                displayalias: '',
                real_name: '',
                phoneno: '',
                email: '',
                qq: '',
                wechat: '',
                line: '',
                skype: '',
                has_nick: 0,
                has_real_name: 0,
                has_phoneno: 0,
                has_email: 0,
                has_qq: 0,
                has_wechat: 0,
                has_line: 0,
                has_skype: 0
            },
            created: function(){

                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_edit_data();
                    }
                }, 500);
                
            },
            methods: {
                update_mb_data: function(){

                    var rname = (this.real_name == '') ? 'nodata' : this.real_name;
                    var data_mail = (this.email == '') ? 'nodata' : this.email;
                    var data_qq = (this.qq == '') ? 'nodata' : this.qq;
                    var data_wechat = (this.wechat == '') ? 'nodata' : this.wechat;
                    var data_line = (this.line == '') ? 'nodata' : this.line;
                    var data_skype = (this.skype == '') ? 'nodata' : this.skype;

                    var ApiURL = API_Host + '/mb/updateinfo/' + rname + '/' + data_mail + '/' + data_qq + '/' + data_wechat + '/' + data_line + '/' + data_skype;

                    if(this.phoneno == ''){
                        ApiURL += '/nodata';
                    }else{
                        ApiURL += '/' + this.phoneno;
                    }
                    
                    Vue.prototype.$http = axios;
                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.alertinfo('<?php echo __("msg_zy_1.update_succ"); ?>!', '/mb/edata');
                            return;
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                get_edit_data: function(){

                    var ApiURL = API_Host + '/mb/user_info';
                    Vue.prototype.$http = axios;
                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.real_name = this.json['info']['displayalias']; //這個之後要接真實姓名
                            self.displayalias = this.json['info']['displayalias'];
                            self.phoneno = this.json['info']['phoneno'];
                            self.email = this.json['info']['email'];
                            self.qq = this.json['info']['qq'];
                            self.wechat = this.json['info']['wechat'];
                            self.line = this.json['info']['line'];
                            self.skype = this.json['info']['skype'];

                            if(self.displayalias != ''){
                                self.has_nick = 1;
                                self.has_real_name = 1;
                            }
                            if(self.phoneno != ''){
                                self.has_phoneno = 1;
                            }
                            if(self.email != ''){
                                self.has_email = 1;
                            }
                            if(self.qq != ''){
                                self.has_qq = 1;
                            }
                            if(self.wechat != ''){
                                self.has_wechat = 1;
                            }
                            if(self.line != ''){
                                self.has_line = 1;
                            }
                            if(self.skype != ''){
                                self.has_skype = 1;
                            }

                        }else{
                            self.alertinfo(this.json['info'], '/');
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },hide_string: function(type,string){
                    var length = string.length;
                    var new_string = "";
                    var phone_string_need = 4;      // 需要的電話號碼位數
                    var china_phone_length = 11;    //大陸電話號碼長度
                    var mail_min_length = 3;        //mail需要的最短長度
                    var mail_common_length = 5;     //mail一般長度
                    var qq_min_length = 5;          //qq需要的最短長度
                    var qq_need_length = 3;         //qq一般長度

                    var count_string = 0;
                    if (string != ""){
                        if (type == "name"){
                                new_string = string.substr(0,1);
                                while (count_string < length){
                                    new_string += "*";
                                    count_string++;
                                }
                        }else if (type == "phone"){
                            while (count_string < length-phone_string_need){
                                new_string += "*";
                                count_string++;
                            }
                            new_string += string.substr(-(phone_string_need),phone_string_need);
                        }else if (type == "email" || type == "skype" || type == "line"){
                            var account_list = string.split("@");
                            length = account_list[0].length;
                            string = account_list[0];
                            if (length <= mail_min_length){
                                while (count_string < mail_common_length-length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string.substr(-(length),length);
                            }else{
                                while (count_string < length-mail_min_length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string.substr(-(mail_min_length),mail_min_length);
                            }
                            if (account_list[1] != undefined){
                                new_string+="@"+account_list[1];
                            };
                            
                        }else if (type == "qq" || type == "wechat"){
                            if (length <= qq_min_length){
                                while (count_string < qq_min_length-length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string += string;
                            }else{
                                while (count_string < length - qq_min_length){
                                    new_string += "*";
                                    count_string++;
                                }
                                new_string+=string.substr(-(qq_need_length),qq_need_length);
                            }
                        }
                    }
                    return new_string;
                },
            }
        });
    </script>
        
    </body>
</html>
