<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_member"></div>
        </div>
        <div class="container" id="show_records">
            <div class="main_member">
                @include($mb_info_head)
                <div class="container user-bd">
                    <div class="row">
                        @include($mb_info_left)
                        <div class="col-md-10 middle text-left mt-2">
                            <div class="user-edit-module">
                                <div class="mem-title">
                                    <h5 class="d-flex align-items-center"><i class="fas fa-headset mr-2"></i> {{ __('msg_zy_1.contact_inf') }}</h5>
                                </div>
                                <div class="content d-flex">
                                    <div class="member-name w-50">
                                        <div class="row">
                                            <div class="col-3"><span class="memicon qq-icon"></span></div>
                                            <div class="col-9"><button type="button" class="btn btn-danger px-5 d-flex"><span class="waiter-icon mr-1"></span>{{ __('msg_zy_1.online_service') }}</button></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mem-title mt-5">
                                    <h5 class="d-flex align-items-center"><i class="far fa-comment mr-2"></i> {{ __('msg_zy_1.feedback') }}</h5>
                                </div>
                                <div class="content mb-2">
                                    <div class="contentbox">
                                        <span class="sel1 btn text-warning">{{ __('msg_zy_1.usage_problem') }}</span>
                                        <span class="sel2 btn text-secondary">{{ __('msg_zy_1.recharge_problem') }}</span>
                                        <span class="sel3 btn text-secondary">{{ __('msg_zy_1.other') }}</span>
                                        <textarea rows="6" placeholder="{{ __('msg_zy_1.describe_problem') }}" class="ant-input"></textarea>
                                    </div>
                                </div>

                                <div class="savbtn w-50 text-right">
                                    <button type="button" class="btn btn-warning px-5">{{ __('msg_zy_1.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
</html>
