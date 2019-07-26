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
            <div class="banner_agents"></div>
        </div>
        <div class="container main agent-main">
            <div class="agent-tab">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <!--<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('message.distribution') }}</a>-->
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{ __('msg_fcs_1.agreement') }}</a>
                        
                        <!-- for f1-->
                        <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('msg_fcs_1.ag_login') }}</a>
                        <a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('msg_fcs_1.ag_registe') }}</a> -->
                        <!-- for f1-->
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!--三级分销-->
                    <!--<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="agent-process">--><!--agent-process img--><!--</div>
                    </div>-->
                    <!--联盟协议-->
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <ul class="agent-rules text-left">
                            <li><span class="title">{{ __('msg_fcs_1.ag_RO_title1') }}</span>
                                <ol>
                                    <li>{{ __('msg_fcs_1.ag_RO_list1_1') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list1_2') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list1_3') }}</li>
                                </ol>
                            </li>
                            <li><span class="title">{{ __('msg_fcs_1.ag_RO_title2') }}</span>
                                <ol>
                                    <li>{{ __('msg_fcs_1.ag_RO_list2_1') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list2_2') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list2_3') }}</li>
                                </ol>
                            </li>
                            <li><span class="title">{{ __('msg_fcs_1.ag_RO_title3') }}</span>
                                <ol>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_1') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_2') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_3') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_4') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_5') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_6') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_7') }}</li>
                                    <li>{{ __('msg_fcs_1.ag_RO_list3_8') }}</li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                    <!--代理登入-->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="agent-login">
                            <h2 class="">{{ __('msg_fcs_1.ag_backend_login') }}</h2>
                            <form class="mb-3">
                                <div class="agent-login-input" data-validate="Enter username">
                                    <input class="form-control my-3" type="text" placeholder="{{ __('msg_fcs_1.username') }}" name="username" value="">
                                    <input class="form-control my-3" type="password" placeholder="{{ __('msg_fcs_1.password') }}" name="pass" value="">
                                </div>
                                <div class="agent-login-btn">
                                    <button type="button" class="btn btn-warning btn-lg">{{ __('msg_fcs_1.login') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--代理注册-->
                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                        <div class="register-box">
                            <p class="text-white">{{ __('msg_fcs_1.partner_des') }}</p>
                            <a href="#" target="_blank" class="btn btn-warning btn-lg">{{ __('msg_fcs_1.calling') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
</html>
