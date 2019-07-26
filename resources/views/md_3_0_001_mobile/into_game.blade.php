<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body style="margin:0px;padding:0px;overflow:hidden;width:100%">
        <div id="game_list">
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
                <div v-if="showStatus === 1"><font color='white' size="40">{{ __('msg_dt_1.loading') }}</font></div>
                <div v-if="showStatus === 0 && url !=''"><iframe id="ifgame" ref="ifgame" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px;background-color:white" height="100%" width="100%" frameborder="0" allowfullscreen :src="url" ></iframe></div>
                <div v-if="showStatus === 0 && special_url !='' "><iframe id="ifgame_special" ref="ifgame_special" :src="special_url" :height="special_iframe_height" :width="special_iframe_width"  scrolling="no"  frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;position:absolute;top:0px;left:0px;right:0px;bottom:0px;display: block; background-color:white"></iframe></div>

                <div v-if="alter_rotate == 1"  align="center" valign="center" style="height:100%;width:100%;color:white;font-size:30px">{{ __('msg_dt_1.please_rotate') }}</div>
                <input type="hidden" ref="dt1" value="{{$eid}}" />
                <input type="hidden" ref="dt2" value="{{$gid}}" />
                <input type="hidden" ref="dt3" value="{{$gtype}}" />
            </div>
        </div>
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
                show_mb_loading: 0,
                special_url: '',
                url: '',
                special_iframe_height: 0,
                special_iframe_width: 0,
                alter_rotate: 0,
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
                        self.showStatus = 0;
                        self.play_game();
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
                play_game: function(){

                    var url = encodeURIComponent(location.host);
                    
                    var ApiURL = API_Host + '/game/gameplay/' + this.$refs.dt2.value + '/' + this.$refs.dt3.value + '/' + url+ '/' + url+ '/' + url+ '/' + url + '/' + url + '/' + url;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(arr_trans_page_game.indexOf(self.$refs.dt2.value) == '-1'){
                                var p_height = 0;
                                var p_width = 0;
                                var u = navigator.userAgent;
                                var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
                                var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
                                if (self.$refs.dt2.value == "ASGame" || self.$refs.dt2.value == "WMGame"){
                                    self.special_url = this.json['info'];
                                    if (window.orientation == 90 || window.orientation == -90){
                                        self.special_iframe_width = document.documentElement.clientWidth;
                                        self.special_iframe_height = document.documentElement.clientHeight;
                                    }else{
                                        self.alter_rotate = 1;
                                    }
                                    $(window).on("orientationchange", function(){
                                        switch(window.orientation){
                                            case 0:
                                            case 180:
                                                self.alter_rotate = 1;
                                                document.getElementById("ifgame_special").style.display = "none";
                                                break;
                                            case 90:
                                            case -90:
                                                if (self.special_iframe_width == 0 && self.special_iframe_height == 0){
                                                    setTimeout(function(){
                                                        self.special_iframe_width = document.documentElement.clientWidth;
                                                        self.special_iframe_height = document.documentElement.clientHeight;
                                                    },500);  
                                                }
                                                document.getElementById("ifgame_special").style.display = "block";
                                                document.getElementById("ifgame_special").style.zoom = 1;
                                                self.alter_rotate = 0;
                                                break;

                                        };
                                    });
                                    $(window).on("resize", function(){
                                        self.special_iframe_width = document.documentElement.clientWidth;
                                        self.special_iframe_height = document.documentElement.clientHeight;
                                    });
                                }else if ((self.$refs.dt2.value == "GenesisGame" && isiOS)){
                                    self.special_url = this.json['info'];
                                    if (window.orientation == 0 || window.orientation == 180){
                                        self.special_iframe_width = document.documentElement.clientWidth;
                                        self.special_iframe_height = document.documentElement.clientHeight;
                                    }else{
                                        self.alter_rotate = 1;
                                    }
                                    $(window).on("orientationchange", function(){
                                        switch(window.orientation){
                                            case 90:
                                            case -90:
                                                self.alter_rotate = 1;
                                                document.getElementById("ifgame_special").style.display = "none";
                                                break;
                                            case 0:
                                            case 180:
                                                if (self.special_iframe_width == 0 && self.special_iframe_height == 0){
                                                    setTimeout(function(){
                                                        self.special_iframe_width = document.documentElement.clientWidth;
                                                        self.special_iframe_height = document.documentElement.clientHeight;
                                                    },500);  
                                                }
                                                document.getElementById("ifgame_special").style.display = "block";
                                                document.getElementById("ifgame_special").style.zoom = 1;
                                                self.alter_rotate = 0;
                                                break;

                                        };
                                    });
                                    $(window).on("resize", function(){
                                        self.special_iframe_width = document.documentElement.clientWidth;
                                        self.special_iframe_height = document.documentElement.clientHeight;
                                    });

                                }else{

                                    self.url = this.json['info'];
                                }
                                
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

                }
            }
        });
    </script>
    </body>
</html>
