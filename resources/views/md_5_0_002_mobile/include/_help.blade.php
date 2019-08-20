@switch(session('model_type'))
    @case('md_6_0_002')
        <div class="row">
            <div class="col-md-12 footer-help">
                <div class="foot-nav">
                    <ul class="list-unstyled text-center">
                        <li>{{ __('msg_zy_1.about_us') }}</li>
                        <li>{{ __('msg_zy_1.QandA') }}</li>
                        <li>{{ __('msg_zy_1.responsibility_bitting') }}</li>
                        <li>{{ __('msg_zy_1.dis_and_rule') }}</li>
                        <li>{{ __('msg_zy_1.privacy') }}</li>
                        <li>{{ __('msg_zy_1.online_service') }}</li>
                        <li>{{ __('msg_zy_1.electronic').__('msg_zy_1.email') }}</li>
                        <li>{{ __('msg_zy_1.agent_way') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @break
    @default
        <div class="row">
            <div class="col-md-6 footer-help">
                <div class="m-auto">
                    <div class="title"><!--幫助中心--></div>
                    <div class="foot-nav">
                        <ul class="list-unstyled ">
                            <li>{{ __('msg_zy_1.about_us') }}</li>
                            <!--<li>存款帮助</li>
                            <li>取款帮助</li>-->
                            <li>{{ __('msg_zy_1.QandA') }}</li>
                            <li>{{ __('msg_zy_1.responsibility_bitting') }}</li>
                            <li>{{ __('msg_zy_1.dis_and_rule') }}</li>
                            <li>{{ __('msg_zy_1.privacy') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 footer-contact">
                <div class="">
                    <div class="title"><!--聯繫我們--></div>
                    <div class="foot-nav">
                        <ul class="list-unstyled ">
                            <li>{{ __('msg_zy_1.online_service') }}</li>
                            <li>{{ __('msg_zy_1.electronic').__('msg_zy_1.email') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 footer-agency">
                <div class="text-left">
                    <div class="title"><!--代理商申請--></div>
                    <div class="foot-nav">
                        <ul class="list-unstyled ">
                            <li>{{ __('msg_zy_1.agent_way') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endswitch