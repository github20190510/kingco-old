<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_message">
            <main role="main" class="container main bank-main" style="height:360px">
                <section class="btn-group w-100 funds-menu mb-3" role="group">
                    <!--<button type="button" class="btn c-alpha-gold text-white w-30 border-0 mr-1"><i class="far fa-check-circle"></i> 一键已读</button>-->
                    <div class="btn-group w-30" role="group">
                        <button id="btnGroupDrop-type" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="read_status" ref="read_status">
                            <i class="far fa-eye"></i> {{ __('msg_fcs_1.status') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" @click="show_read(0, '{{ __('msg_fcs_1.all') }}')">{{ __('msg_fcs_1.all') }}</a>
                            <a class="dropdown-item" href="#" @click="show_read(2, '{{ __('msg_fcs_1.read') }}')">{{ __('msg_fcs_1.read') }}</a>
                            <a class="dropdown-item" href="#" @click="show_read(1, '{{ __('msg_fcs_1.unread') }}')">{{ __('msg_fcs_1.unread') }}</a>
                        </div>
                    </div>
                    <div class="btn-group w-40" role="group">
                        <button id="btnGroupDrop-date" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ref="msg_date">
                            <i class="far fa-calendar-alt"></i> {{ __('msg_fcs_1.information') . __('msg_fcs_1.time') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                            <!--<a class="dropdown-item" href="#" @click="change_date('nodata', '{{ __('msg_fcs_1.information') . __('msg_fcs_1.time') }}')">{{ __('msg_fcs_1.information') . __('msg_fcs_1.time') }}</a>-->
                            <a class="dropdown-item" href="#" @click="change_date('0', '{{ __('msg_fcs_1.all_time') }}')">{{ __('msg_fcs_1.all_time') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('1', '{{ __('msg_fcs_1.today') }}')">{{ __('msg_fcs_1.today') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('2', '{{ __('msg_fcs_1.yesterday') }}')">{{ __('msg_fcs_1.yesterday') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('3', '{{ __('msg_fcs_1.last_week') }}')">{{ __('msg_fcs_1.last_week') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('4', '{{ __('msg_fcs_1.last_30_days') }}')">{{ __('msg_fcs_1.last_30_days') }}</a>
                        </div>                        
                    </div>
                </section>
                <section class="funds-table mb-3" v-for="user_msg_data in user_msg_datas" v-if="has_mb_msg_data == 1">
                    <div class="row funds-date">
                        <div class="col">{{ __('msg_fcs_1.date') }} : <span>@{{ user_msg_data.text.sendtime }}</span></div>
                    </div>
                    <div class="row funds-1">
                        <a href="" style="color:black" data-toggle="modal" data-target="#show_message" :data-stuff="[user_msg_data.text.content, '{{ __('msg_dt_1.my_info') }}', user_msg_data.messagecode]">
                            <div class="col"><span>@{{ user_msg_data.text.content.substr(0, 30) + '...' }}</span></div>
                        </a>
                    </div>
                    <div class="row funds-2">
                        <div class="col">{{ __('msg_fcs_1.status') }} : <strong class="text-warning">{{ user_msg_data.readstatus == '2' ? '<?php echo __("msg_fcs_1.read"); ?>': '<?php echo __("msg_fcs_1.unread"); ?>' }}</strong></div>
                    </div>
                </section>
                <section class="nodata d-flex flex-column justify-content-center align-items-center" v-if="has_mb_msg_data == 0">
                    <div class="round-out"><i class="fas fa-flag fa-lg"></i></div>
                    <div class="mt-1">No data</div>
                </section>
            </main>
            <!--go to top-->
            <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
                <i class="fas fa-angle-up fa-lg"></i>
            </a>
            <!-- Modal 完整訊息內容-->        
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content c-alpha-white  border-0">
                        <div class="modal-header text-white c-gold border-0">
                            <h6 class="modal-title" id="show_message_title">{{ __('msg_fcs_1.trans_in') }}</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="show_message_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row" id="divMsg">                           
                            </div>
                        </div>
                        <div class="modal-footer border-0"> 
                            <button type="button" class="btn btn-lh m-auto btn-dark c-gold border-0" id="btnOK" @click="close_msg_dialog();">{{ __('msg_fcs_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer Menu-->
        @include($footer_name)
        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script>
        $(document).ready(function(){
            $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
                var target = $(this).data('target');
                $(target).on('shown.bs.modal',function(){
                    $('body').addClass('modal-open');
                });
            });

            var get_modal = $("#show_message");
            get_modal.on("show.bs.modal", function(e){

                var btn = $(e.relatedTarget),
                id = btn.data("stuff").split(',');
                $('#show_message_title').html(id[1]);
                $('#divMsg').html(id[0]);
                if(id[2] != undefined){
                    $('#btnOK').attr('ref', id[2]);
                }else{
                    $('#btnOK').attr('ref', '');
                }

            });
        })

        var mb_message = new Vue({
            el: '#mb_message',
            data: {
                user_msg_datas: {},
                has_mb_msg_data: 0,
                mdate: 'nodata',
                sdate: 'nodata',
                edate: 'nodata',
                readstatus: 'nodata',
                perpage: 20
            },
            created: function(){

                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_user_message();
                    }
                }, 500);

            },
            methods: {
                get_user_message: function(){

                    //var data_start = (this.pg - 1) * this.perpage;
                    var data_start = 0;

                    var ApiURL = API_Host + '/mb/sysmessage/' + data_start + '/' + this.perpage + '/' + this.sdate + '/' + this.edate + '/' + this.readstatus;
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info']['rows'].length > 0){
                                self.user_msg_datas = this.json['info']['rows'];
                                self.has_mb_msg_data = 1;
                            }else{
                                self.set_default();
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
                close_msg_dialog: function(){

                    var msgno = $('#btnOK').attr('ref');
                    if(msgno != ''){
                        var ApiURL = API_Host + '/mb/updsysmessage/' + msgno;
                        Vue.prototype.$http = axios;

                        var self = this;
                        this.$http.get(ApiURL, {cancelToken: source.token})
                        .then(function (response) {
                            if(this.json['code'] == '1'){
                                //修改已讀成功
                                self.get_user_message();
                            }else{
                                self.alertinfo(this.json['info']);
                                return;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                    $('#show_message_close').click();

                },
                change_date: function(date_mode, str_status){

                    this.$refs.msg_date.innerHTML = '<i class="far fa-eye"></i> ' + str_status;

                    this.change_date_act(date_mode);
                    
                    this.get_user_message();

                },
                set_default: function(){

                    this.has_mb_msg_data = 0;

                },
                show_read: function(type, str_status){

                    if(type == '0'){
                        this.readstatus = 'nodata';
                    }else{
                        this.readstatus = type;
                    }

                    this.$refs.read_status.innerHTML = '<i class="far fa-eye"></i> ' + str_status;
                    
                    this.set_default();
                    this.get_user_message();

                }
            }
        });
        </script>
    </body>
</html>
