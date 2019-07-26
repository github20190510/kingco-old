<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>
        <div class="main membe-box">
            <div class="content">
                <div class="main_member">
                    @include($mb_info_head)
                    <div class="container user-bd">
                        <div class="row">
                            @include($mb_info_left)
                            <div class="col-md-10 middle text-left mt-2">
                                <div class="user-edit-module" id="mb_edit_data">
                                    <div class="mem-title">
                                        <h5><i class="far fa-address-card"></i> {{ __('msg_dt_1.personal_inf') }}</h5>
                                    </div>
                                    <div>
                                        <div class="member-name">
                                            <!-- <div class="form-group form-row">
                                                <label for="inputname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.nickname') }} :</label>
                                                <div class="col-sm-9" v-if="has_nick == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputname" placeholder="{{ __('msg_dt_1.input_nickname') }}" value="" v-model="displayalias">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_nick == '1'">
                                                    @{{displayalias}}
                                                </div>
                                            </div> -->
                                            <div class="form-group form-row">
                                                <label for="inputrealname" class="col-sm-2 col-form-label text-right">{{ __('msg_dt_1.real_name') }} :</label>
                                                <div class="col-sm-9" v-if="has_real_name == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputrealname" placeholder="{{ __('msg_dt_1.real_name_desc1') }}" value="" v-model="real_name">
                                                    <span class="small"><span class="text-danger">{{ __('msg_dt_1.real_name_desc2') }}</span></span>
                                                </div>
                                                 <div class="col-sm-9 mem-data-text" v-if="has_real_name == '1'">
                                                    @{{hide_string("name",real_name)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputphone" class="col-sm-2 col-form-label text-right"><span class="memicon phone-icon"></span>{{ __('msg_dt_1.mobile') }} :</label>
                                                <div class="col-sm-9" v-if="has_phoneno == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputphone" placeholder="{{ __('msg_dt_1.input_mobile') }}" value="" v-model="phoneno">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_phoneno == '1'">
                                                    @{{hide_string("phone",phoneno)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputmail" class="col-sm-2 col-form-label text-right"><span class="memicon mail-icon"></span>{{ __('msg_dt_1.email') }} :</label>
                                                <div class="col-sm-9" v-if="has_email == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputmail" placeholder="{{ __('msg_dt_1.input_email') }}" value="" v-model="email">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_email == '1'">
                                                    @{{hide_string("email",email)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputqq" class="col-sm-2 col-form-label text-right"><span class="memicon qq-icon"></span>{{ __('msg_dt_1.qq') }} :</label>
                                                <div class="col-sm-9" v-if="has_qq == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputqq" placeholder="{{ __('msg_dt_1.input_qq') }}" value="" v-model="qq">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_qq == '1'">
                                                    @{{hide_string("qq",qq)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputwechat" class="col-sm-2 col-form-label text-right"><span class="memicon wechat-icon"></span>{{ __('msg_dt_1.wechat') }} :</label>
                                                <div class="col-sm-9" v-if="has_wechat == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputwechat" placeholder="{{ __('msg_dt_1.input_wechat') }}" value="" v-model="wechat">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_wechat == '1'">
                                                    @{{hide_string("wechat",wechat)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputline" class="col-sm-2 col-form-label text-right"><span class="memicon"></span>{{ __('msg_dt_1.line') }} :</label>
                                                <div class="col-sm-9" v-if="has_line == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputline" placeholder="{{ __('msg_dt_1.line') }}" value="" v-model="line">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_line == '1'">
                                                    @{{hide_string("line",line)}}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                <label for="inputskype" class="col-sm-2 col-form-label text-right"><span class="memicon"></span>{{ __('msg_dt_1.skype') }} :</label>
                                                <div class="col-sm-9" v-if="has_skype == '0'">
                                                    <input type="text" class="form-control mem_input" id="inputskype" placeholder="{{ __('msg_dt_1.skype') }}" value="" v-model="skype">
                                                </div>
                                                <div class="col-sm-9 mem-data-text" v-if="has_skype == '1'">
                                                    @{{hide_string("skype",skype)}}
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="memberPhoto w-50">
                                            <div class="upload-photo"></div>
                                            <div class="btn btn-outline-warning updataphoto">
                                                <input type="file" accept="image/*" class="updataphoto-btn">
                                                {{ __('msg_dt_1.sel_from_album') }}
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="savbtn text-center">
                                        <button type="button" class="btn btn-warning" @click="update_mb_data">{{ __('msg_dt_1.save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
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
                            self.alertinfo('<?php echo __("msg_dt_1.update_succ"); ?>!', '/mb/edata');
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
</html>
