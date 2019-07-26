<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body class="main-body">
        @include($mb_head_name)
        <main role="main" class="container main member-main">
            <div class="d-flex flex-wrap justify-content-sm-start">
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/acc'"><i class="fas fa-chart-pie fa-fw fa-2x"></i> {{ __('msg_zy_1.acc_overview') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/bank_card'"><i class="far fa-credit-card fa-fw fa-2x"></i> {{ __('msg_zy_1.bank_card') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/deposit'"><i class="fas fa-clipboard-check fa-fw fa-2x"></i> {{ __('msg_zy_1.saving_money') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/withdraw'"><i class="fas fa-clipboard-list fa-fw fa-2x"></i> {{ __('msg_zy_1.geting_money') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/details'"><i class="fas fa-chart-line fa-fw fa-2x"></i> {{ __('msg_zy_1.money_record') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/showrecord'"><i class="far fa-file-alt fa-fw fa-2x"></i> {{ __('msg_zy_1.betting') . __('msg_zy_1.record') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/deposit_list'"><i class="fas fa-piggy-bank fa-fw fa-2x"></i> {{ __('msg_zy_1.recharge') . __('msg_zy_1.record') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/withdraw_list'"><i class="fas fa-hand-holding-usd fa-fw fa-2x"></i> {{ trans_choice('msg_zy_1.withdraw', 1) . __('msg_zy_1.record') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/edata'"><i class="fas fa-user-edit fa-fw fa-2x"></i> {{ __('msg_zy_1.personal_inf') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/epwd'"><i class="fas fa-user-lock fa-fw fa-2x"></i> {{ __('msg_zy_1.change_password') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/eppwd'"><i class="fas fa-lock fa-fw fa-2x"></i> {{ __('msg_zy_1.pay_pwd') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/message'" id="btnMsg"><i class="far fa-envelope fa-fw fa-2x"></i> {{ __('msg_zy_1.my_info') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/mb/notic'"><i class="fas fa-bullhorn fa-fw fa-2x"></i> {{ __('msg_zy_1.system') . __('msg_zy_1.notification') }}</button>
                <button type="button" class="btn c-alpha-white3 d-flex align-items-center flex-column" onclick="location.href='/helpers'"><i class="fas fa-users fa-fw fa-2x"></i>{{ __('msg_zy_1.about_us') }}</button>
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
    </body>
</html>
