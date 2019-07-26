<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div id="loginModal" class="login_modal">
            <span class="login_modal_close"></span>
            <div class="login_modal_header">
                <div class="login_modal_title" id="rcDialogTitle1">{{ __('msg_dt_1.login') }}</div>
            </div>
            <div class="login_modal_body">
                <div class="login-form-module ">
                    <form>
                        <div class="form-group">
                            <input name="username" autocomplete="username" class="form-control login_input" placeholder="{{ __('msg_dt_1.input_username') }}" type="text" value="">
                        </div>
                        <div class="form-group">
                            <input name="password" autocomplete="password" type="password" class="form-control login_input" placeholder="{{ __('msg_dt_1.input_password') }}" value="">
                        </div>
                        <div class="form-group">
                            <div class="form-check auto_login">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">{{ __('msg_dt_1.auto_login') }}</label>
                            </div>
                        </div>
                        <div class="form-group btn_submit">
                            <button class="login_now_btn">{{ __('msg_dt_1.immediately_login') }}</button>
                        </div>
                        <div class="form-group btn_submit">
                            <button class="register_now_btn">{{ __('msg_dt_1.register_now') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
