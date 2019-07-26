<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <script>
        function frameauto() {
            var ifm = document.getElementById("ifgame");
            var subWeb = document.frames ? document.frames["ifgame"].document : ifm.contentDocument;
            if (ifm != null && subWeb != null) {
                ifm.height = subWeb.body.scrollHeight;
            }
        }
    </script>
    <body class="into" style="padding-top: 0px;">
        <div id="game_list" style="padding-top: -40px">
            <div class="loading container-fluid d-flex align-items-center" v-if="show_mb_loading == 1" id="div_mb_loading">
                <div class="content">
                    <div class="ball">
                    </div>
                    <div class="ball1">
                    </div>
                </div>
            </div>
            <div class="main">
                <span class="enabled" data-toggle="modal" data-target="#set_money" id="open_dialog"></span>
                <div v-if="showStatus === 1"><font color='white' size="40">{{ __('msg_zy_1.loading') }}</font></div>
                <div v-if="showStatus === 0"><iframe id="ifgame" ref="ifgame" style="float:left;overflow:scroll;" onload="frameauto()"></iframe></div>
                <input type="hidden" ref="dt1" value="{{$eid}}" />
                <input type="hidden" ref="dt2" value="{{$gid}}" />
                <input type="hidden" ref="dt3" value="{{$gtype}}" />

            </div>
            <div class="modal fade mem-modal" id="set_money" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <input type="hidden" ref="hid_set_gametype" id="hid_set_gametype"/>
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('msg_zy_1.money_not_enough') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display: none;"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_zy_1.confirm_into_game') }}</label>                           
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-lh m-auto" @click="trans_point_page" id="trans_point_page">{{ __('msg_zy_1.into_point_page') }}</button>
                            <button type="button" class="btn btn-lh m-auto" @click="confirm_into_game">{{ __('msg_zy_1.into_game') }}</button>
                            <button type="button" class="btn btn-lh m-auto" @click="auto_trans_point" id="auto_trans_point">{{ __('msg_zy_1.auto_trans_point') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>        
        // 修正 Modal 小錯誤
        $(document).ready(function(){
            $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
                var target = $(this).data('target');
                $(target).on('shown.bs.modal',function(){
                    $('body').addClass('modal-open');

                });
            });
        });

        var app = new Vue({
            el : '#game_list',
            data : {
                showStatus : 1,
                show_mb_loading: 0
            },
            created: function(){

                this.get_scroll_top();

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
                       //進入遊戲                        
                        self.chk_has_money();
                    }else{
                        //導到登入頁
                        location.href = '/mb/login_page/' + self.$refs.dt2.value + '/' + self.$refs.dt3.value;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            methods: {
                chk_has_money: function(){

                    var ApiURL = API_Host + '/game/gamebalance/' + this.$refs.dt2.value;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                           //進入遊戲
                            if(parseInt(this.json['info']) >= 1){
                                self.showStatus = 0;
                                self.play_game();
                            }else{
                                $('#open_dialog').click();
                            }

                        }else{
                            //導到登入頁
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
                play_game: function(eid, gid, gtype){

                    var url = encodeURIComponent(location.host);
                    var ApiURL = API_Host + '/game/gameplay/' + this.$refs.dt2.value + '/' + this.$refs.dt3.value + '/' + url+ '/' + url+ '/' + url+ '/' + url + '/' + url + '/' + url;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(arr_trans_page_game.indexOf(self.$refs.dt2.value) == '-1'){
                                self.$refs.ifgame.width = document.documentElement.clientWidth;
                                self.$refs.ifgame.height = document.documentElement.clientHeight;
                                self.$refs.ifgame.src = this.json['info'];
                                self.$refs.ifgame.style.backgroundColor = "white";
                                setInterval(function(){
                                    self.chk_token();
                                }, 60000);

                                self.show_mb_loading = 0;
                                document.body.style.overflow = 'visible';
                            }else{
                                location.href = this.json['info'];
                            }
                            return;
                            
                        }else{
                            self.alertinfo(this.json['info']);
                            window.close();
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                chk_token: function(){
                    //判斷是否已在其它地方登入
                    var ApiURL = API_Host + '/game/chk_token';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] != '1'){
                            //導到登入頁
                            self.alertinfo(this.json['info'], '/');
                            return;
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

                    this.showStatus = 0;
                    $('#set_money_close').click();
                    this.play_game();

                },
                trans_deposit_page: function(){

                    location.href = '/mb/deposit';

                },
                auto_trans_point: function(){

                    //先取回錢包金額
                    $('#set_money_close').click();
                    var ApiURL = API_Host + '/game/getmybagmoney';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            self.trans_point(this.json['info']);
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
                            var ApiURL = API_Host + '/game/setmoney/' + this.$refs.dt2.value + '/' + money;
                            Vue.prototype.$http = axios;

                            var self = this;
                            this.$http.get(ApiURL)
                            .then(function (response) {
                                this.json = response.data;
                                if(this.json['code'] == '1'){
                                    self.alertinfo('<?php echo __("msg_zy_1.trans_in_succ"); ?><?php echo __("msg_zy_1.click_into_game_button"); ?>');
                                    self.showStatus = 0;
                                    self.show_mb_loading = 0;
                                    $('#set_money_close').click();
                                    self.play_game();
                                }else{
                                    self.alertinfo(this.json['info']);
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        }else{
                            this.alertinfo('<?php echo __("msg_zy_1.trans_in_err"); ?>', '/mb/acc');
                            return;
                        }
                    }else{
                        if(confirm('<?php echo __("msg_zy_1.bag_money_not_enough"); ?>')){
                            this.showStatus = 0;
                            this.show_mb_loading = 0;
                            $('#set_money_close').click();
                            this.play_game();
                        }else{
                            this.trans_deposit_page();
                        }
                    }

                },
                change_msg: function(){

                    $('#trans_point_page').hide();
                    $('#auto_trans_point').hide();
                    $('#msg_data').html('<?php echo __("msg_zy_1.click_into_game_button"); ?>');
                    $('#exampleModalLabel').html('<?php echo __("msg_zy_1.into_game"); ?>');

                }
            }
        });
    </script>
</html>
