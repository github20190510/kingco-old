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
            <div class="banner_app"></div>
        </div>
        <div class="container app-main">
            <div class="row">
                <div class="col-md mobile">
                </div>
                <div class="col-md">
                    <div class="row">
                        <div class="col-md">
                            <h1>{{ __('msg_fcs_1.app_title1') }} <br>{{ __('msg_fcs_1.app_title2') }}</h1>
                            <p>{{ __('msg_fcs_1.app_desc1') }}<br>
                                {{ __('msg_fcs_1.app_desc2') }}</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md">
                            <div class="btn android"></div>
                            <div class="btn apple"></div>
                        </div>
                        <div class="col-md">
                            <div class="qr-code"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md safety-text">
                    <h1>{{ __('msg_fcs_1.app_title3') }}<br>{{ __('msg_fcs_1.app_title4') }}</h1>
                    <p>{{ __('msg_fcs_1.app_desc3') }}<br>
                        {{ __('msg_fcs_1.app_desc4') }}<br>
                        {{ __('msg_fcs_1.app_desc5') }}</p>
                </div>
                <div class="col-md app-safety">
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
</html>
