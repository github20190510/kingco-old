<!--header-top Start-->
<div class="header-top fixed-top">
	<div class="top-bg m-auto" id="login_bar">
		<nav class="navbar navbar-expand navbar-dark p-0">
			<a class="navbar-brand" href="/"><span class="logo"></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse user-bar" id="navbarSupportedContent">
				<!--未登入 開始-->
				<form class="form-inline my-2 my-lg-0 ml-auto" v-if="login_status === 0">
					<input class="form-control mr-sm-2 account m-0" type="text" v-model="login_acc" ref="login_acc" placeholder="{{ __('msg_dt_1.input_username2') }}" value="" v-on:keyup.13="$('#login_pwd').focus();">
					<div class="input-group">
						<input type="password" class="form-control outline-light pwd" v-model="login_pwd" ref="login_pwd" placeholder="{{ __('msg_dt_1.login_pwd') }}" id="login_pwd" value="" v-on:keyup.13="$('#login_btn').click();" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button id="login_btn" class="btn btn-light btn-sm login_btn" type="button" @click="chk_login">{{ __('msg_dt_1.immediately_login') }}</button>
						</div>
					</div>
				</form>
				<ul class="navbar-nav pr-0" v-if="login_status === 0">
					<li class="nav-item"><a class="nav-link text-dg forget_btn top-btn" id="forget_btn" href="#" @click="alert_forgetpwd">{{ __('msg_dt_1.forget_pwd') }}</a></li>
					<li class="nav-item"><a class="nav-link text-dg register_btn top-btn" id="register_btn" href="#" onclick="location.href='{{ url('mb/register') }}'">{{ __('msg_dt_1.free_register') }}</a></li>
					<li class="nav-item"><a class="nav-link text-dg help_btn top-btn pr-0" id="help_btn" href="#" onclick="location.href='{{ url('helpers') }}'">{{ __('msg_dt_1.helpers_center') }}</a></li>
				</ul>
				<!--未登入 結束-->				
				<!--已登入 開始-->
				<div class="logged_bar d-flex justify-content-end ml-auto" v-if="login_status === 1">
					<div class="user-group d-flex justify-content-center">
						<div class="">
							<span id="show_acc_name" class="mr-4 text-warning"><a href='{{ url('mb/acc') }}' class="text-warning"> @{{ login_acc }} </a></span>
							<span class="mr-4">{{ __('msg_dt_1.balance') }}: <strong id="acc_money">@{{ bag_money }}</strong></span>
						</div>
						<div class="logged_item">
							<span class="logged_btn" onclick="location.href='{{ url('mb/deposit') }}'">{{ __('msg_dt_1.recharge') }}</span>
							<span class="logged_btn" onclick="location.href='{{ url('mb/withdraw') }}'">{{ trans_choice('msg_dt_1.withdraw', 1) }}</span>
							<span class="logged_btn" onclick="location.href='{{ url('mb/acc') }}'">{{ __('msg_dt_1.points_conversion') }}</span>
							<div class="logged_btn" onclick="location.href='{{ url('mb/message') }}'"><span class="news-icon"></span> <span class="count">(@{{msg_count}})</span></div>
						</div>
					</div>
					<button v-if="login_status === 1" type="button" id="logout_btn" class="btn exit_btn mr-0" v-on:click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')"><?php echo trans(__('msg_dt_1.logout')) ?></button>
					<button type="button" id="help_btn2" class="btn help_btn text-right" onclick="location.href='{{ url('helpers') }}'">{{__('msg_dt_1.helpers_center') }}</button>
				</div>
				<!--已登入 結束-->				
				<div id="time" class="time small">
					<i class="far fa-clock"></i> {{ __('msg_dt_1.Beijing') . __('msg_dt_1.time') }} : @{{ date | formatDate }}
					<!--<span class="favorite_line">
						<a href="" class="text-white"><i class="fas fa-wifi  b-inline"></i> {{ __('msg_dt_1.sel_line') }}</a>
					</span>-->
					<div class="favorite_line">
						<select id="ddl_model" ref="ddl_model" @change="change_model" v-model="model_type" class="custom-select custom-select-sm">
							<option value="md_2_0_001">{{ __('msg_dt_1.template') }}1</option>
							<option value="md_4_0_001">{{ __('msg_dt_1.template') }}2</option>
							<!-- <option value="md_3_0_001">{{ __('msg_dt_1.template') }}3</option> -->
						</select>
					</div>
				</div>
			</div>
		</nav>
	</div>
</div>
<!--header-top End-->
<!--header link Start-->
<div class="header" id="game_menu">
	<!--Second line-->
	<nav class="nav d-flex justify-content-between">
		<!--主選單-->
		<a id="home" class="nav-link" href="/">Home</a>
		<a id="sport" class="nav-link px-0 " href="#" @click="into_sport_game">{{ __('msg_dt_1.sport') . __('msg_dt_1.betting') }}</a>
		<a id="casino" class="nav-link px-0" href="#" @click="into_casino_game">{{ __('msg_dt_1.real_casino') }}</a>
		<a id="slots" class="nav-link px-0" href="#" @click="into_cq9_game">{{ __('msg_dt_1.slots2') }}</a>
		<a id="lottery" class="nav-link px-0" href="#" @click="into_lottery_game">{{ __('msg_dt_1.lottery') . __('msg_dt_1.zone') }}</a>
		<a id="flish" class="nav-link px-0" href="#" @click="into_fish_game">{{ __('msg_dt_1.fishing') . __('msg_dt_1.zone') }}</a>
		<a id="cardgame" class="nav-link px-0" href="#" @click="into_card_game">{{ __('msg_dt_1.cardgame2') }}</a>
		<a id="promotion" class="nav-link px-0" href="#" @click="into_action">{{ __('msg_dt_1.promotion') }}</a>
		<a id="mobile" class="nav-link px-0" href="#" @click="">{{ __('msg_dt_1.mobile') . __('msg_dt_1.betting')}}</a>
		<!--into_app_game-->
		<!--<a id="agents" class="nav-link px-0" href="#" @click="into_agent">{{ __('msg_dt_1.agency_cooperation') }}</a>-->
		<a id="movie" class="nav-link px-0" href="#" @click="into_movie">{{ __('msg_dt_1.movie_link') }}</a>
		<a id="movie_action" style="display:none" target="_blank"></a>
	</nav>
 </div>
<!--header link End-->
<!-- Webchat在线客服图标:默认图标[浮动图标]开始-->
<div style='display:none;'><a href='https://www.webchat.com'>在线客服</a></div><script language="javascript" src="https://ic86.ichatshop.com/chat/chatClient/floatButton.js?jid=1699111339&companyID=5010400&configID=3603&codeType=custom&ss=1"></script><div style='display:none;'><a href='https://en.webchat.com'>live chat</a></div>
<!-- 在线客服图标:默认图标结束-->