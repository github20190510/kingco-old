<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <script type="text/javascript">
        $(function(){
             $('.coverflow').css('max-width',$('.coverflow img').width());
        });
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_discount"></div>
        </div>
        <div class="container discount-main">
            <div class="discount-tab">
                <!--<nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">{{ __('msg_dt_1.all') }}</a>
                        <a class="nav-item nav-link" id="nav-member-tab" data-toggle="tab" href="#nav-member" role="tab" aria-controls="nav-member" aria-selected="false">{{ __('msg_dt_1.mem_upgrade') }}</a>
                        <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="false">{{ __('msg_dt_1.special_act') }}</a>
                        <a class="nav-item nav-link" id="nav-red-tab" data-toggle="tab" href="#nav-red" role="tab" aria-controls="nav-red" aria-selected="false">{{ __('msg_dt_1.grab_red_envelope') }}</a>
                        <a class="nav-item nav-link" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="false">{{ __('msg_dt_1.deposit') }}{{ __('msg_dt_1.discount') }}</a>
                        <a class="nav-item nav-link" id="nav-pinying-tab" data-toggle="tab" href="#nav-pinying" role="tab" aria-controls="nav-pinying" aria-selected="false">{{ __('msg_dt_1.backwater') }}{{ __('msg_dt_1.discount') }}</a>
                    </div>
                </nav>-->
                <div class="tab-content" id="nav-tabContent">
                    <!--全部-->
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <div class="discount-box" v-for="v in arr_activity">
                            <div class="dis"><a @click="into_activity(v.enterprisebrandactivitycode)"><image :src="v.activityimage" style="width:976px;height:183px;"></image></a></div>
                            <!--<div class="dis member"></div>
                            <div class="dis red"></div>
                            <div class="dis events-3"></div>
                            <div class="dis events-2"></div>
                            <div class="dis events-1"></div>
                            <div class="dis deposit-2"></div>
                            <div class="dis deposit-1"></div>
                            <div class="dis pinying"></div>-->
                        </div>
                    </div>
                    <!--会员升等-->
                    <!--<div class="tab-pane fade" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                        <div class="discount-box">
                            <div class="dis member"></div>
                        </div>
                    </div>-->
                    <!--特别活动-->
                    <!--<div class="tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
                        <div class="discount-box">
                            <div class="dis events-3"></div>
                            <div class="dis events-2"></div>
                            <div class="dis events-1"></div>
                        </div>
                    </div>-->
                    <!--搶紅包-->
                    <!--<div class="tab-pane fade" id="nav-red" role="tabpanel" aria-labelledby="nav-red-tab">
                        <div class="discount-box">
                            <div class="dis red"></div>
                        </div>
                    </div>-->
                    <!--存款优惠-->
                    <!--<div class="tab-pane fade" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
                        <div class="discount-box">
                            <div class="dis deposit-2"></div>
                            <div class="dis deposit-1"></div>
                        </div>
                    </div>-->
                    <!--返水優惠-->
                    <!--<div class="tab-pane fade" id="nav-pinying" role="tabpanel" aria-labelledby="nav-pinying-tab">
                        <div class="discount-box">
                            <div class="dis pinying"></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var activity = new Vue({
            el : '#nav-tabContent',
            data: {
                arr_activity: new Array()
            },
            created: function(){
                this.get_activity();
            },
            methods: {
                get_activity: function(){

                    var ApiURL = API_Host + '/mb/brandactivitytrigger';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length > 0){
                                self.arr_activity = this.json['info'];
                            }
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                into_activity: function(aid){

                    location.href = "discount_content/" + aid;
                
                }
            }
        });
    </script>
</html>
