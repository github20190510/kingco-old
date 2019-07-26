<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>
        <div class="container" id="mb_message">
            <div class="main_member">
                @include($mb_info_head)
                <div class="container user-bd">
                    <div class="row">
                        @include($mb_info_left)
                        <div class="col-md-10 middle-history text-left mt-2">
                            <div class="user-edit-module">
                                <div class="msg-tab">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true"><i class="far fa-comment-dots mr-1"></i> {{ __('msg_fcs_1.my_info') }}</a>
                                        </li>
                                        <li class="nav-item" style="display:none">
                                            <a class="nav-link d-flex" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-gift mr-1"></i> {{ __('msg_fcs_1.day_by_day') . __('msg_fcs_1.backwater') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-bullhorn mr-1"></i> {{ __('msg_fcs_1.system') . __('msg_fcs_1.notification') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <!--我的消息 Start-->
                                        <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="content">
                                                <div class="form-inline mb-2 mt-3">
                                                    <label for="inputPassword" class="my-1 mr-2">{{ __('msg_fcs_1.date') }}：</label>
                                                    <select class="custom-select my-1 mr-sm-2 custom-select-sm" id="gamedate" @change="change_date" v-model="mdate">
                                                        <option value="nodata" selected>{{ __('msg_fcs_1.information') . __('msg_fcs_1.time') }}</option>
                                                        <!--<option value="0">{{ __('msg_fcs_1.all2') . __('msg_fcs_1.time') }}</option>-->
                                                        <option value="1">{{ __('msg_fcs_1.today') }}</option>
                                                        <option value="2">{{ __('msg_fcs_1.yesterday') }}</option>
                                                        <option value="3">{{ __('msg_fcs_1.last_week') }}</option>
                                                        <option value="4">{{ __('msg_fcs_1.last_30_days') }}</option>
                                                    </select>
                                                    <button type="button" id="notread_btn" class="btn btn-outline-warning btn-sm" v-if="readstatus === 'nodata'" @click="show_read(1)">{{ __('msg_fcs_1.just_unread') }}</button>
                                                    <button type="button" id="all_msg_btn" class="btn btn-outline-warning btn-sm" v-if="readstatus !== 'nodata'" @click="show_read(0)">{{ __('msg_fcs_1.view_all') }}</button>
                                                </div>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-left">{{ __('msg_fcs_1.date') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.information') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.status') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="user_msg_data in user_msg_datas" v-if="has_mb_msg_data === 1">
                                                            <th scope="row" class="text-left">@{{ user_msg_data.text.sendtime }}</th>
                                                            <td data-toggle="modal" data-target="#show_message" :data-stuff="[user_msg_data.text.content, '{{ __('msg_fcs_1.my_info') }}', user_msg_data.messagecode]">@{{ user_msg_data.text.content.substr(0, 30) + '...' }}</td>
                                                            <td>{{ user_msg_data.readstatus == '2' ? '<?php echo __("msg_fcs_1.read"); ?>': '<?php echo __("msg_fcs_1.unread"); ?>' }}</td>
                                                        </tr>
                                                        <tr v-if="has_mb_msg_data === 0">
                                                            <td colspan="3" scope="row" class="text-center border-bottom">No data</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--   分頁 -->
                                                <nav aria-label="Page navigation example" class="slot-page">
                                                    <ul class="pagination pagination-lg justify-content-center">
                                                        <li class="page-item" :class="{'disabled': show_first === 0}">
                                                            <a class="page-link" href="#" aria-label="Previous" @click="go_first('message')">
                                                                <span aria-hidden="true"><i class="fas fa-angle-double-left fa-lg"></i></span>
                                                                <span class="sr-only">{{ __('msg_fcs_1.first_page') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item" :class="{'disabled': show_pre === 0}">
                                                            <a class="page-link" href="#" aria-label="Previous" @click="go_pre('message')">
                                                                <span aria-hidden="true"><i class="fas fa-angle-left fa-lg"></i></span>
                                                                <span class="sr-only">{{ __('msg_fcs_1.previous_page') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item" :class="{'disabled': pg === pg1}"><a class="page-link" href="#" ref="pg1" @click="go_page(pg1, 'message')" v-if="show_pg1 === 1">@{{ pg1 }}</a></li>
                                                        <li class="page-item" :class="{'disabled': pg === pg2}"><a class="page-link" href="#" ref="pg2" @click="go_page(pg2, 'message')">@{{ pg2 }}</a></li>
                                                        <li class="page-item" :class="{'disabled': pg === pg3}"><a class="page-link" href="#" ref="pg3" @click="go_page(pg3, 'message')" v-if="show_pg3 === 1">@{{ pg3 }}</a></li>
                                                        <li class="page-item" :class="{'disabled': show_next === 0}">
                                                            <a class="page-link" href="#" aria-label="Next" @click="go_next('message')">
                                                                <span aria-hidden="true"><i class="fas fa-angle-right fa-lg"></i></span>
                                                                <span class="sr-only">{{ __('msg_fcs_1.next_page') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item" :class="{'disabled': show_last === 0}">
                                                            <a class="page-link" href="#" aria-label="Next" @click="go_last('message')">
                                                                <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                                                                <span class="sr-only">{{ __('msg_fcs_1.last_page') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item">
                                                            <select @change="select_go_page('message')" v-model="ddl_page" class="form-control mt-2 ml-2">
                                                                <option :value="v" v-for="v in maxPage">第@{{v}}頁</option>                                
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <!--我的消息 End-->
                                        <!--天天返水 Start-->
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="content">
                                                <div class="form-inline mb-2 mt-3">
                                                    <label for="btndate" class="my-1 mr-2">{{ __('msg_fcs_1.date') }}：</label>
                                                    <select class="custom-select my-1 mr-sm-2 custom-select-sm" id="btndate">
                                                            <option selected>{{ __('msg_fcs_1.betting') . __('msg_fcs_1.time') }}</option>
                                                            <option value="0">{{ __('msg_fcs_1.all2') . __('msg_fcs_1.time') }}</option>
                                                            <option value="1">{{ __('msg_fcs_1.today') }}</option>
                                                            <option value="2">{{ __('msg_fcs_1.yesterday') }}</option>
                                                            <option value="3">{{ __('msg_fcs_1.last_week') }}</option>
                                                        <option value="4">{{ __('msg_fcs_1.last_30_days') }}</option>
                                                    </select>
                                                </div>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-left">{{ __('msg_fcs_1.date') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.game') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.backwater') . __('msg_fcs_1.amount') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.receive') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" class="text-left">2018-10-17 16:15</th>
                                                            <td>【返利】恭喜您中奖中奖8元;抽奖活动:红包</td>
                                                            <td>已读</td>
                                                            <td>已读</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="text-left">2018-10-17 16:15</th>
                                                            <td>【返利】恭喜您中奖中奖8元;抽奖活动:红包</td>
                                                            <td>已读</td>
                                                            <td>已读</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="text-left">2018-10-17 16:15</th>
                                                            <td>【返利】恭喜您中奖中奖8元;抽奖活动:红包</td>
                                                            <td>已读</td>
                                                            <td>已读</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" scope="row" class="text-center border-bottom" style="display: none">No data</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--天天返水 End-->
                                        <!--系统公告 Start-->
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="content">
                                                <!--<div class="form-inline mb-2 mt-3">
                                                    <label for="betdate" class="my-1 mr-2">{{ __('msg_fcs_1.date') }}：</label>
                                                    <select class="custom-select my-1 mr-sm-2 custom-select-sm" id="betdate">
                                                        <option selected>{{ __('msg_fcs_1.betting') . __('msg_fcs_1.time') }}</option>
                                                        <option value="0">{{ __('msg_fcs_1.all2') . __('msg_fcs_1.time') }}</option>
                                                        <option value="1">{{ __('msg_fcs_1.today') }}</option>
                                                        <option value="2">{{ __('msg_fcs_1.yesterday') }}</option>
                                                        <option value="3">{{ __('msg_fcs_1.last_week') }}</option>
                                                        <option value="4">{{ __('msg_fcs_1.last_30_days') }}</option>
                                                    </select>
                                                </div>-->
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-left">{{ __('msg_fcs_1.date') }}</th>
                                                            <th scope="col">{{ __('msg_fcs_1.notification') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="notic_data in notic_datas" v-if="has_notic_data === 1">
                                                            <th scope="row" class="text-left">@{{ notic_data.createtime }}</th>
                                                            <td data-toggle="modal" data-target="#show_message" :data-stuff="[notic_data.content, '{{ __('msg_fcs_1.system') . __('msg_fcs_1.notification') }}']">@{{ notic_data.content.substr(0, 30) + '...' }}</td>
                                                        </tr>
                                                        <tr v-if="has_notic_data === 0">
                                                            <td colspan="2" scope="row" class="text-center border-bottom">No data</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--系统公告 End-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade mem-modal" id="show_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white brown">
                            <h5 class="modal-title" id="show_message_title"></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="show_message_close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body mt-4">
                            <div class="form-group row" id="divMsg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lh m-auto" @click="close_msg_dialog" id="btnOK" ref="">{{ __('msg_fcs_1.ok') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
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
                notic_datas: {},
                has_mb_msg_data: 0,
                has_notic_data: 0,
                perpage: 10,
                minPage: 1,
                maxPage: 1,
                show_first: 0,
                show_pre: 0,
                show_pg1: 0,
                show_pg3: 0,
                show_next: 0,
                show_last: 0,
                pg: 1,
                pg1: 1,
                pg2: 2,
                pg3: 3,
                mdate: 'nodata',
                sdate: 'nodata',
                edate: 'nodata',
                readstatus: 'nodata',
                ddl_page : 1
            },
            created: function(){

                var self = this;
                setTimeout(function(){
                    var session_data = "<?php echo session('login_eid')?>";
                    if(session_data != ''){
                        self.get_user_message();
                        self.get_notic();
                    }
                }, 500);

            },
            methods: {
                get_user_message: function(){

                    var data_start = (this.pg - 1) * this.perpage;

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
                                self.maxPage = Math.ceil(this.json['info']['results'] / self.perpage);
                                self.getPage();
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
                change_date: function(){

                    if(this.mdate != 'nodata'){
                        switch(this.mdate){
                            case '1':
                                //今天
                                this.sdate = this.fdate(0) + ' 00:00:00';
                                this.edate = this.fdate(0) + ' 23:59:59';
                            break;
                            case '2':
                                //昨天
                                this.sdate = this.fdate(-1) + ' 00:00:00';
                                this.edate = this.fdate(-1) + ' 23:59:59';
                            break;
                            case '3':
                                //一個禮拜
                                this.sdate = this.fdate(-6) + ' 00:00:00';
                                this.edate = this.fdate(0) + ' 23:59:59';
                            break;
                            case '4':
                                //30天
                                this.sdate = this.fdate(-29) + ' 00:00:00';
                                this.edate = this.fdate(0) + ' 23:59:59';
                            break;
                        }
                    }
                    
                    this.get_user_message();

                },
                fdate: function(index){

                    var date = new Date();
                    var newDate = new Date();
                    newDate.setDate(date.getDate() + index);

                    var year = newDate.getFullYear();
                    var month = (newDate.getMonth() + 1);
                    var day = newDate.getDate();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    var time =  [year, month, day].join('-');
                    
                    return time;

                },
                set_default: function(){

                    this.has_mb_msg_data = 0;
                    this.show_pre = 0;
                    this.show_pg1 = 0;
                    this.show_pg3 = 0;
                    this.show_next = 0;
                    this.pg = 1;
                    this.pg1 = 1;
                    this.pg2 = 1;
                    this.pg3 = 1;

                },
                show_read: function(type){

                    if(type == '0'){
                        this.readstatus = 'nodata';
                    }else{
                        this.readstatus = '1';
                    }
                    
                    this.set_default();
                    this.get_user_message();

                }
            }
        });
    </script>
</html>
