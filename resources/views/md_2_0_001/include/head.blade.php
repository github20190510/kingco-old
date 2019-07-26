<div class="header">
	<div class="row user-bar">
		<div id="time" class="time small"><i class="far fa-clock"></i> {{ __('msg_dt_1.Beijing') . __('msg_dt_1.time') }} : @{{ date | formatDate }} 
			<span class="favorite_line">
				<!--<a href="" class="text-white"><i class="fas fa-wifi  b-inline"></i> {{ __('msg_dt_1.sel_line') }}</a>-->
				<select id="ddl_model" ref="ddl_model" @change="change_model" v-model="model_type" class="custom-select custom-select-sm">
					<option value="md_2_0_001">{{ __('msg_dt_1.template') }}1</option>
					<option value="md_4_0_001">{{ __('msg_dt_1.template') }}2</option>
					<!-- <option value="md_3_0_001">{{ __('msg_dt_1.template') }}3</option> -->
				</select>
			</span>
		</div>
		<div class="login_bar ml-auto" id="login_bar">
			
		    <input v-if="login_status === 0" class="account m-0" type="text" v-model="login_acc" ref="login_acc" placeholder="{{ __('msg_dt_1.input_username2') }}" value="" v-on:keyup.13="$('#login_pwd').focus();">
		    <input v-if="login_status === 0" class="pwd" type="password" v-model="login_pwd" ref="login_pwd" placeholder="{{ __('msg_dt_1.login_pwd') }}" id="login_pwd" value="" v-on:keyup.13="$('#login_btn').click();">
		    <button v-if="login_status === 0" type="button" id="login_btn" class="btn login_btn" @click="chk_login">{{ __('msg_dt_1.immediately_login_now') }}</button>
		    <button v-if="login_status === 0" type="button" id="forget_btn" class="btn forget_btn" @click="alert_forgetpwd">{{ __('msg_dt_1.forget_pwd') }}</button>
		    <button v-if="login_status === 0" type="button" id="register_btn" class="btn register_btn" onclick="location.href='{{ url('mb/register') }}'">{{ __('msg_dt_1.free_register') }}</button>
		    <button v-if="login_status === 0" type="button" id="help_btn" class="btn help_btn" onclick="location.href='{{ url('helpers') }}'">{{ __('msg_dt_1.helpers_center') }}</button>
		    <div class="logged_bar d-flex justify-content-end" v-if="login_status === 1">
				<div class="user-group d-flex justify-content-center">
					<div class="">
						<span id="show_acc_name"  class="mr-4"><a href='{{ url('mb/acc') }}' class="text-warning"> @{{ login_acc }} </a></span>
						<span class="mr-4">{{ __('msg_dt_1.balance') }}: <strong id="acc_money">@{{ bag_money }}</strong></span>
					</div>
					<div class="logged_item">
						<span class="logged_btn" onclick="location.href='{{ url('mb/deposit') }}'">{{ __('msg_dt_1.recharge') }}</span>
						<span class="logged_btn" onclick="location.href='{{ url('mb/withdraw') }}'">{{ trans_choice('msg_dt_1.withdraw', 1) }}</span>
						<span class="logged_btn" onclick="location.href='{{ url('mb/acc') }}'">{{ __('msg_dt_1.points_conversion') }}</span>
						<div class="logged_btn" onclick="location.href='{{ url('mb/message') }}'"><span class="news-icon"></span> <span class="count">(@{{msg_count}})</span></div>
					</div>
				</div>
				<button v-if="login_status === 1" type="button" id="logout_btn" class="btn exit_btn mr-0" @click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')"><?php echo trans(__('msg_dt_1.logout')) ?></button>
				<button type="button" id="help_btn" class="btn help_btn" onclick="location.href='{{ url('helpers') }}'">{{ __('msg_dt_1.helpers_center') }}</button>
			</div>
			<div class="loading container-fluid d-flex align-items-center" v-if="show_loading" id="div_loading">
		        <div class="content">
		            <div class="ball">
		            </div>
		            <div class="ball1">
		            </div>
		        </div>
		    </div>
		</div>
	</div>

	<nav class="navbar navbar-expand navbar-dark bg-transparent header pb-1" id="game_menu">
		<div class="navbar-brand lh_logo mr-auto" @click="into_index"></div>
		<div class="" id="navbarSupportedContent">
			<ul class="navbar-nav my-0 pb-0">
			    <li class="nav-item">
			        <a id="home" class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
			    </li>
			    <li class="nav-item">
			        <a id="sport" class="nav-link px-0 " href="#" @click="into_sport_game">{{ __('msg_dt_1.sport') . __('msg_dt_1.betting') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="casino" class="nav-link px-0" href="#" @click="into_casino_game">{{ __('msg_dt_1.real_casino') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="slots" class="nav-link px-0" href="#" @click="into_cq9_game">{{ __('msg_dt_1.slots2') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="lottery" class="nav-link px-0" href="#" @click="into_lottery_game">{{ __('msg_dt_1.lottery') . __('msg_dt_1.zone') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="flish" class="nav-link px-0" href="#" @click="into_fish_game">{{ __('msg_dt_1.fishing') . __('msg_dt_1.zone') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="cardgame" class="nav-link px-0" href="#" @click="into_card_game">{{ __('msg_dt_1.cardgame2') }}</a>
			    </li>
			    <li class="nav-item">
			        <a id="promotion" class="nav-link px-0" href="#" @click="into_action">{{ __('msg_dt_1.promotion') }}</a>
			    </li>
			    <!-- <li class="nav-item">
			        <a id="mobile" class="nav-link px-0" href="#" @click="into_app_game">{{ __('msg_dt_1.mobile') . __('msg_dt_1.betting')}}</a>
			    </li> -->
			    <!--<li class="nav-item">
			        <a id="agents" class="nav-link px-0" href="#" @click="into_agent">{{ __('msg_dt_1.agency_cooperation') }}</a>
			    </li>-->
			    <li class="nav-item">
			        <a id="movie" class="nav-link px-0" href="#" @click="into_movie">{{ __('msg_dt_1.movie_link') }}</a>
			        <a id="movie_action" style="display:none" target="_blank"></a>
			    </li>
			</ul>
		</div>
	</nav>
</div>
<!-- Webchat在线客服图标:默认图标[浮动图标]开始-->
<div style='display:none;'><a href='https://www.webchat.com'>在线客服</a></div><script language="javascript" src="https://ic86.ichatshop.com/chat/chatClient/floatButton.js?jid=1699111339&companyID=5010400&configID=3603&codeType=custom&ss=1"></script><div style='display:none;'><a href='https://en.webchat.com'>live chat</a></div>
<!-- 在线客服图标:默认图标结束-->