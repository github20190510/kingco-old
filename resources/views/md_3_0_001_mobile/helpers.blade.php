<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        @include($head_name)
        <main role="main" class="container main about-main">
            <div class="help-rules">
                <ul>
                    <li>
                        <h4>{{ __('msg_dt_1.LS_introduction_title1') }}</h4>
                        <p>{{ __('msg_dt_1.LS_intro_desc1') }}<br>
                        </p>
                    </li>
                    <li>
                        <h4>{{ __('msg_dt_1.LS_introduction_title2') }}</h4>
                        <p>{{ __('msg_dt_1.LS_intro_desc2') }}<br>
                            {{ __('msg_dt_1.LS_intro_desc3') }}<br>
                            {{ __('msg_dt_1.LS_intro_desc4') }}</p>
                        <p>{{ __('msg_dt_1.LS_intro_desc5') }}</p>
                    </li>
                    <li>
                        <h4>{{ __('msg_dt_1.LS_introduction_title3') }}</h4>
                        <p>{{ __('msg_dt_1.LS_intro_desc6') }}</p>
                    </li>
                    <li>
                        <h4>{{ __('msg_dt_1.LS_introduction_title4') }}</h4>
                        <p>{{ __('msg_dt_1.LS_intro_desc7') }}</p>
                    </li>
                    <li>
                        <h4>{{ __('msg_dt_1.LS_introduction_title5') }}</h4>
                        <p>{{ __('msg_dt_1.LS_intro_desc8') }}</p>
                    </li>
                </ul>
            </div>
        </main>
        <!--go to top-->
        <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
            <i class="fas fa-angle-up fa-lg"></i>
        </a>
        <!--Footer Menu-->
        @include($footer_name)

        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript">
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
        </script>
    </body>
</html>
