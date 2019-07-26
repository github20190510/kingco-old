<div class="col-md-2 mem-left text-white">
    <div class="user-nav-module">
        <div class="content" id="mb_info_left">
            <div class="mem-first">
                <ul>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_acc}" onclick="location.href='{{ url('mb/acc') }}'"><span><i class="fas fa-chart-pie fa-fw"></i> {{ __('msg_dt_1.acc_overview') }}</span></span></li>
                    <li style="display:none"><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_agent}"><span><i class="fas fa-chart-line usericon fa-fw"></i> {{ __('msg_dt_1.ag_report') }}</span></span></li>
                    <li style="display:none"><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_win}"><span><i class="far fa-edit fa-fw"></i> {{ __('msg_dt_1.win_lose') . __('msg_dt_1.record') }}</span></span></li>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_showrecord}" onclick="location.href='{{ url('mb/showrecord') }}'"><span><i class="far fa-file-alt fa-fw"></i> {{ __('msg_dt_1.betting') . __('msg_dt_1.record') }}</span></span></li>
                    <li style="display:none"><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_lottery}"><span><i class="fas fa-clipboard-list fa-fw"></i> {{ __('msg_dt_1.lottery') . __('msg_dt_1.record') }}</span></li>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_message}" onclick="location.href='{{ url('mb/message') }}'"><i class="far fa-envelope fa-fw"></i> {{ __('msg_dt_1.my_info') }} <span class="badge badge-pill badge-danger" id="span_msg_count">0</span></span></li>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_bank_card}" onclick="location.href='{{ url('mb/bank_card') }}'"><span><i class="far fa-credit-card fa-fw"></i> {{ __('msg_dt_1.bank_card') }}</span></span></li>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_deposit}"  onclick="location.href='{{ url('mb/deposit') }}'"><span><i class="fas fa-piggy-bank fa-fw"></i> {{ __('msg_dt_1.recharge') }}</span></li>
                    <li><span class="d-flex align-items-center mem-nav-btn" :class="{'active': isActive_withdraw}" onclick="location.href='{{ url('mb/withdraw') }}'"><i class="fas fa-hand-holding-usd fa-fw"></i> {{ trans_choice('msg_dt_1.withdraw', 1) }}</span></li>
                </ul>
            </div>
            <div class="mem-second">
                <ul>
                    <li><span class="mem-nav-btn" :class="{'active': isActive_details}" onclick="location.href='{{ url('mb/details') }}'">{{ __('msg_dt_1.acc_detail') }}</span></li>
                    <li><span class="mem-nav-btn" :class="{'active': isActive_edata}" id="edata" onclick="location.href='{{ url('mb/edata') }}'">{{ __('msg_dt_1.personal_inf') }}</span></li>
                    <li><span class="mem-nav-btn" :class="{'active': isActive_epwd}" onclick="location.href='{{ url('mb/epwd') }}'">{{ __('msg_dt_1.login_pwd') }}</span></li>
                    <li><span class="mem-nav-btn" :class="{'active': isActive_eppwd}" onclick="location.href='{{ url('mb/eppwd') }}'">{{ __('msg_dt_1.pay_pwd') }}</span></li>
                    <!-- <li><span class="mem-nav-btn" :class="{'active': isActive_contact}" onclick="location.href='{{ url('mb/contact') }}'">{{ __('msg_dt_1.feedback') }}</span></li> -->
                    <li><span class="mem-nav-btn" :class="{'active': isActive_about}" onclick="location.href='{{ url('helpers') }}'">{{ __('msg_dt_1.about_us') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    var mb_info_left = new Vue({
        el : '#mb_info_left',
        data : {
            isActive_acc: false,
            isActive_agent: false,
            isActive_win: false,
            isActive_showrecord: false,
            isActive_lottery: false,
            isActive_message: false,
            isActive_bank_card: false,
            isActive_deposit: false,
            isActive_withdraw: false,
            isActive_details: false,
            isActive_edata: false,
            isActive_epwd: false,
            isActive_eppwd: false,
            isActive_contact: false,
            isActive_about: false
        },
        created: function(){

           this.isActive_{{$key}} = 'true';

        }
    });
</script>