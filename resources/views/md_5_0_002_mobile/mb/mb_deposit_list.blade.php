<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($head_name)
        <div id="deposit_list">
            <header class="login-header navbar-dark">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn back-btn" onclick="history.go(-1)"></button>
                    <div class="header-title m-auto">{{ __('msg_zy_1.deposit') . __('msg_zy_1.record') }}</div>
                </div>
            </header>
            <main role="main" class="container main bank-main">
                <section class="btn-group w-100 funds-menu mb-3" role="group">
                    <div class="btn-group w-100" role="group">
                        <button id="btnGroupDrop-date" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref="save_data_date">
                            <i class="far fa-calendar-alt"></i> {{ __('msg_zy_1.select_time') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" @click="change_date('0', '{{ __('msg_zy_1.all_time') }}')">{{ __('msg_zy_1.all_time') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('1', '{{ __('msg_zy_1.today') }}')">{{ __('msg_zy_1.today') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('2', '{{ __('msg_zy_1.yesterday') }}')">{{ __('msg_zy_1.yesterday') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('3', '{{ __('msg_zy_1.last_week') }}')">{{ __('msg_zy_1.last_week') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('4', '{{ __('msg_zy_1.last_30_days') }}')">{{ __('msg_zy_1.last_30_days') }}</a>
                        </div>
                    </div>
                </section>
                <section class="funds-table mb-3" v-if="bln_has_save_data == 1" v-for="savedata in savedatas">
                    <div class="row funds-date">
                        <div class="col">{{ __('msg_zy_1.date') }} : <span>@{{savedata.orderdate}}</span></div>
                    </div>
                    <div class="row funds-2">
                        <div class="col">{{ __('msg_zy_1.order_no') }} : <strong class="text-warning">@{{savedata.ordernumber}}</strong></div>
                    </div>
                    <div class="row funds-2">
                        <div class="col-6">{{ __('msg_zy_1.amount') }} : <strong class="text-danger">@{{ formatMoney(savedata.orderamount) }}</strong></div>
                        <div class="col-6 text-right">{{ __('msg_zy_1.status') }} : <span class="text-success">@{{savedata.str_status}}</span></div>
                    </div>
                </section>
                <section class="nodata d-flex flex-column justify-content-center align-items-center" v-if="bln_has_save_data == 0">
                    <div class="round-out"><i class="fas fa-flag fa-lg"></i></div>
                    <div class="mt-1">No data</div>
                </section>
                <button type="submit" class="btn btn-danger btn-block c-alpha-gold bank-btn mb-3" v-if="bln_no_more == 1" @click="add_count"><i class="fas fa-sync-alt"></i> {{ __('msg_zy_1.load_more') }}</button>
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
            $(document).ready(function(){
                $(window).scroll(function(){
                    if($(this).scrollTop() > 50){
                        $('#back-to-top').fadeIn();
                    }else{
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function(){
                    $('#back-to-top').tooltip('hide');
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

                $('#back-to-top').tooltip('show');

            });

            var deposit_list = new Vue({
                el: '#deposit_list',
                data: {
                    savedatas: {},
                    bln_has_save_data: 0,
                    mdate: 'nodata',
                    sdate: 'nodata',
                    edate: 'nodata',
                    readstatus: 'nodata',
                    perpage: 20,
                    ddlsavetype: 'nodata',
                    start_idx: 0,
                    bln_no_more: 0
                },
                created: function(){

                    var self = this;
                    setTimeout(function(){
                        var session_data = "<?php echo session('login_eid')?>";
                        if(session_data != ''){
                            self.show_save_order();
                        }
                    }, 500);

                },
                methods: {
                    show_save_order: function(){

                        var ApiURL = API_Host + '/mb/saveorder/' + this.ddlsavetype + '/' + this.start_idx + '/' + this.perpage + '/' + this.sdate + '/' + this.edate;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                var rtnData = this.json['info'];

                                if(rtnData['count'] != 0){
                                    self.bln_has_save_data = 1;
                                    if(rtnData['count'] <= (self.start_idx + self.perpage)){
                                        self.bln_no_more = 0;
                                    }else{
                                        self.bln_no_more = 1;
                                    }
                                    
                                    $.each(rtnData['record'], function(idx, v){
                                        v['str_status'] = self.get_order_status(v['orderstatus'], '{{ __("msg_zy_1.processing") }}', '{{ __("msg_zy_1.processed") }}', '{{ __("msg_zy_1.turn_down") }}', '{{ __("msg_zy_1.refuse") }}', '{{ __("msg_zy_1.pending_payment") }}');
                                    });

                                    self.savedatas = rtnData['record'];
                                }else{
                                    self.bln_has_save_data = 0;
                                    self.bln_no_more = 0;
                                }
                            }else{
                                self.alertinfo(this.json['info'], '/');
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    },
                    change_date: function(date_mode, str_status){

                        this.$refs.save_data_date.innerHTML = '<i class="far fa-eye"></i> ' + str_status;

                        this.change_date_act(date_mode);
                        
                        this.start_idx = 0;

                        this.show_save_order();

                    },
                    add_count: function(){

                        this.start_idx = this.start_idx + this.perpage;
                        
                        var ApiURL = API_Host + '/mb/saveorder/' + this.ddlsavetype + '/' + this.start_idx + '/' + this.perpage + '/' + this.sdate + '/' + this.edate;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            this.json = response.data;
                            if(this.json['code'] == '1'){
                                var rtnData = this.json['info'];

                                if(rtnData['count'] != 0){
                                    if(rtnData['count'] <= (self.start_idx + self.perpage)){
                                        self.bln_no_more = 0;
                                    }else{
                                        self.bln_no_more = 1;
                                    }
                                    
                                    $.each(rtnData['record'], function(idx, v){
                                        v['str_status'] = self.get_order_status(v['orderstatus'], '{{ __("msg_zy_1.processing") }}', '{{ __("msg_zy_1.processed") }}', '{{ __("msg_zy_1.turn_down") }}', '{{ __("msg_zy_1.refuse") }}', '{{ __("msg_zy_1.pending_payment") }}');
                                        self.savedatas.push(v);
                                    });

                                }else{
                                    self.bln_no_more = 0;
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
