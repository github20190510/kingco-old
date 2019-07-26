<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="main" id="payment_go">
            <div v-if="showStatus === 1"><font color='white' size="40">{{ __('msg_dt_1.loading') }}</font></div>
            <input type="hidden" ref="dt1" value="{{$eid}}" />
            <input type="hidden" ref="dt2" value="{{$amount}}" />
            <input type="hidden" ref="dt3" value="{{$thirdpartycode}}" />
            <input type="hidden" ref="dt4" value="{{$paymenttypebankcode}}" />
            <input type="hidden" ref="dt5" value="{{$bankcode}}" />
        </div>
    </body>
    <script>
        var app = new Vue({
            el : '#payment_go',
            data : {
                showStatus : 1
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
                       //進入付款頁
                       self.showStatus = 0;
                       self.go_payment();
                    }else{
                        //導回首頁
                        location.href = '/';
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            methods: {
                go_payment: function(){
                    
                    var ApiURL = API_Host + '/system/esaving/' + this.$refs.dt2.value + '/' + this.$refs.dt3.value + '/' + this.$refs.dt4.value + '/' + this.$refs.dt5.value;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL)
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            location.href = this.json['info'];
                        }else{
                            self.alertinfo(this.json['info']);
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
</html>
