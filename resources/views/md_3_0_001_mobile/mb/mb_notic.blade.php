<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <div id="mb_message">
            <main role="main" class="container main bank-main">
                <!--<section class="btn-group w-100 funds-menu mb-3" role="group">
                    <div class="btn-group w-100" role="group">
                        <button id="btnGroupDrop-date" type="button" class="btn btn-secondary dropdown-toggle c-alpha-gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="msg_date" ref="msg_date">
                            <i class="far fa-calendar-alt"></i> {{ __('msg_dt_1.information') . __('msg_dt_1.time') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" @click="change_date('1', '{{ __('msg_dt_1.today') }}')">{{ __('msg_dt_1.today') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('2', '{{ __('msg_dt_1.yesterday') }}')">{{ __('msg_dt_1.yesterday') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('3', '{{ __('msg_dt_1.last_week') }}')">{{ __('msg_dt_1.last_week') }}</a>
                            <a class="dropdown-item" href="#" @click="change_date('4', '{{ __('msg_dt_1.last_30_days') }}')">{{ __('msg_dt_1.last_30_days') }}</a>
                        </div>                        
                    </div>
                </section>-->
                <section class="funds-table mb-3" v-for="notic_data in notic_datas" v-if="has_notic_data == 1">
                    <div class="row funds-date">
                        <div class="col">{{ __('msg_dt_1.date') }} : <span>@{{ notic_data.createtime }}</span></div>
                    </div>
                    <div class="row funds-2">
                        <div class="col" data-toggle="modal"><span>@{{ notic_data.content }}</span></div>
                    </div>                    
                </section>
                <section class="nodata d-flex flex-column justify-content-center align-items-center" v-if="has_notic_data == 0">
                    <div class="round-out"><i class="fas fa-flag fa-lg"></i></div>
                    <div class="mt-1">No data</div>
                </section>
            </main>
            <!--go to top-->
            <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
                <i class="fas fa-angle-up fa-lg"></i>
            </a>
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
                notic_datas: {},
                has_notic_data: 0,
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
                        self.get_notic();
                    }
                }, 500);

            },
            methods: {
                get_notic: function(){

                    var ApiURL = API_Host + '/system/notic';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length > 0){
                                self.notic_datas = this.json['info'];
                                self.has_notic_data = 1;
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
                change_date: function(date_mode, str_status){

                    this.$refs.msg_date.innerHTML = '<i class="far fa-eye"></i> ' + str_status;

                    this.change_date_act(date_mode);
                    
                    this.get_user_message();

                },
                set_default: function(){

                    this.has_notic_data = 0;

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
