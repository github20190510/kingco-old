<div id="login_bar">
	<!-- menu bar-->
	<nav class="nav login-bar fixed-top d-none d-lg-none d-xl-block">
		<span class="ml-3" id="time">{{ __('msg_zy_1.Beijing') . __('msg_zy_1.time') }} : @{{ date | formatDate }}</span>
		<!--<button type="button" class="btn btn-link text-white">{{ __('msg_zy_1.sel_line') }}</button>-->
		<div class="form-inline float-right mr-3">
			<input v-if="login_status === 0" v-model="login_acc" ref="login_acc" v-on:keyup.13="$('#login_pwd').focus();" type="text" class="form-control mr-sm-2 my-1  ml-auto" id="name" placeholder="{{ __('msg_zy_1.input_username2') }}" size="14">
			<input v-if="login_status === 0" type="password" class="form-control mr-2  my-1" id="login_pwd" placeholder="{{ __('msg_zy_1.login_pwd') }}" v-model="login_pwd" ref="login_pwd" v-on:keyup.13="$('#login_btn').click();" size="12">
			<button v-if="login_status === 0" id="login_btn" @click="chk_login" type="submit" class="btn btn-light my-1 mr-2">{{ __('msg_zy_1.immediately_login_now') }}</button>
			<button v-if="login_status === 0" type="submit" class="btn btn-primary mb-1 mt-1 mr-2" @click="alert_forgetpwd">{{ __('msg_zy_1.forget_pwd') }}</button>
			<button v-if="login_status === 0" type="submit" class="btn btn-primary mb-1  mt-1" @click="register">{{ __('msg_zy_1.free_register') }}</button>
			<!--<button v-if="login_status === 1" onclick="location.href='/mb/deposit'" type="submit" class="btn btn-light my-1 mr-2">{{ __('msg_zy_1.saving_money') }}</button>
			<button v-if="login_status === 1" onclick="location.href='/mb/withdraw'" type="submit" class="btn btn-light my-1 mr-2">{{ __('msg_zy_1.geting_money') }}</button>-->
			<button v-if="login_status === 1" id="logout_btn" @click="logout('head', '{{ __('msg_zy_1.logout_succ') }}')" type="submit" class="btn btn-primary mb-1 mt-1">{{ __('msg_zy_1.logout_mobile') }}</button>
		</div>
	</nav>
	<!-- 手機版 -->
	<nav class="navbar navbar-expand-xl fixed-top nav-header navbar-light menu-bar">
		<a class="navbar-brand kin-logo" href="/"><!--logo--></a>
		<div class="ml-auto login-box flex-lg-nowrap">
			<button type="button" class="btn btn-outline-primary login-btn d-xl-none" @click="register" v-if="login_status === 0" >{{ __('msg_zy_1.register') }}</button>
			<button type="button" class="btn btn-primary login-btn d-xl-none" @click="login" v-if="login_status === 0">{{ __('msg_zy_1.login_mobile') }}</button>
			<button v-if="login_status === 1" id="logout_btn" @click="logout('head', '{{ __('msg_zy_1.logout_succ') }}')" type="submit" class="btn btn-primary login-btn d-xl-none">{{ __('msg_zy_1.logout_mobile') }}</button>
		</div>
		<button id="menu" class="navbar-toggler p-0" type="button" data-toggle="offcanvas"> <span class="navbar-toggler-icon"></span> </button>
		<div class="navbar-collapse offcanvas-collapse align-items-start">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="#" @click="into_index">{{ __('msg_zy_1.home') }}</a></li>
				<li class="nav-item d-flex flex-column"><a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.real_casino') }}</a></li>
				<li class="nav-item"> <a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.lottery').__('msg_zy_1.zone') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.slots') }}</a></li>
				<li class="nav-item"> <a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.sport').__('msg_zy_1.betting') }}</a></li>
				<li class="nav-item"> <a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.cardgame2').__('msg_zy_1.zone') }}</a></li>
				<li class="nav-item"> <a class="nav-link" href="#" @click="game_not_ready">{{ __('msg_zy_1.promotion') }}</a></li>
				<!--<li class="nav-item"> <a class="nav-link" href="#">{{ __('msg_zy_1.mobile').__('msg_zy_1.betting') }}</a></li>-->
				<!--<li class="nav-item"> <a class="nav-link" href="#">代理申请</a></li>-->
				<li v-if="login_status === 1" class="nav-item"> <a class="nav-link" href="/mb/deposit"><font color="red">{{ __('msg_zy_1.saving_money') }}</font></a></li>
				<li v-if="login_status === 1" class="nav-item"> <a class="nav-link" href="/mb/withdraw">{{ __('msg_zy_1.geting_money') }}</a></li>
				<li class="nav-item" v-if="login_status === 1"> <a class="nav-link" href="/mb/mb_index">{{ __('msg_zy_1.member_center') }}</a></li>
                                <li class="nav-item"> <a class="nav-link" onclick="window.open('https://pc87.pechatshop.com/chat/Hotline/channel.jsp?cid=5011173&cnfid=4849&j=9432866353&s=1'); return false;" href=""><font color="blue">{{ __('msg_zy_1.online_service') }}</font></a></li>
			</ul>
		</div>
	</nav>
	<div class="user-bar d-flex align-items-center justify-content-between" v-if="login_status === 1">
		<div class="col-10 flex-shrink-1">
			<div class="row">
				<span class="username"><i class="fas fa-user fa-fw"></i> @{{login_acc}}</span>
				<span class="credit" id="acc_money"><i class="fas fa-wallet fa-fw"></i> {{ __('msg_zy_1.balance') }} 0.00</span>
			</div>
		</div>
	</div>
</div>

