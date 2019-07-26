<div class="header-area">
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
					<ul class="navbar-nav pr-0" id="login_bar" v-if="login_status === 0">
						<li class="nav-item" v-if="login_status === 0"><a class="nav-link text-white forget_btn top-btn" id="forget_btn" href="#" @click="alert_forgetpwd">{{ __('msg_dt_1.forget_pwd') }}</a></li>
						<li class="nav-item" v-if="login_status === 0"><a class="nav-link text-white register_btn top-btn" id="register_btn" href="#" onclick="location.href='{{ url('mb/register') }}'">{{ __('msg_dt_1.free_register') }}</a></li>
						<li class="nav-item"><a class="nav-link text-white help_btn top-btn pr-0" id="help_btn" href="#" onclick="location.href='{{ url('helpers') }}'">{{ __('msg_dt_1.helpers_center') }}</a></li>
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
						<button type="button" id="logout_btn" class="btn exit_btn mr-0" v-on:click="logout('head', '{{ __('msg_dt_1.logout_succ') }}')"><?php echo trans(__('msg_dt_1.logout')) ?></button>
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
			<!-- <a id="mobile" class="nav-link px-0" href="#" @click="into_app_game">{{ __('msg_dt_1.mobile') . __('msg_dt_1.betting')}}</a> -->
			<!--<a id="agents" class="nav-link px-0" href="#" @click="into_agent">{{ __('msg_dt_1.agency_cooperation') }}</a>-->
			<a id="movie" class="nav-link px-0" href="#" @click="into_movie">{{ __('msg_dt_1.movie_link') }}</a>
			<a id="movie_action" style="display:none" target="_blank"></a>
		</nav>
	 </div>
	<!--header link End-->
	<!--輪播 Start-->
	<!--<div id="carouselExampleIndicators" class="carousel slide coverflow" data-ride="carousel" v-if="is_index === 1">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item header-carousel-item carousel-1 active"></div>
			<div class="carousel-item header-carousel-item carousel-2"></div>
			<div class="carousel-item header-carousel-item carousel-3"></div>
			<div class="carousel-item header-carousel-item carousel-4"></div>
			<div class="carousel-item header-carousel-item carousel-5"></div>
		</div>
	</div>-->
	<!--輪播 End-->
	<!--跑馬燈-->
	<!--<div class="notice-module d-flex align-items-center m-auto" id="notic_bar" v-if="is_index === 1">
		<span class="mr-2"><i class="fas fa-volume-up text-white fa-lg"></i></span>
		<marquee class="marquee m-0">@{{ notic_data }}
		</marquee>
	</div>-->
	<!--Slots Start-->

	<div class="game-module-tab2" v-if="is_index === 1" id="game_menu_list">
		<div class="content">
			<!--Game carousel Start-->
			<section id="game-menu" class="game-menu">
				<div class="row">
					<div class="col columns">
						<ul class="owl-carousel owl-theme">
							<li v-for="v in platform" class="item" :class="v['class_name']" @click="goto_game(v['act_name'])"></li>
							
                            <!--<li class="item item-2" @mouseover="show_game('com818')" @click="goto_game('com818')">--><!--PT電子--><!--</li>-->
                            <!--<li class="item item-3">--><!--AG電子--><!--</li>-->
                            <!--<li class="item item-4">--><!--BBIN電子--><!--</li>-->
                            <!--<li class="item item-5">--><!--QT電子--><!--</li>-->
                            <!--<li class="item item-7">--><!--AB電子--><!--</li>-->
                            <!--<li class="item item-9">--><!--IM--><!--</li>-->
                            <!--<li class="item item-10">--><!--MG--><!--</li>-->
                            <!--<li class="item item-11">--><!--YP--><!--</li>-->
                            <!--<li class="item item-13">--><!--SG--><!--</li>-->
						</ul>
					</div>
				</div>
			</section>
			<!--Game carousl End-->
		</div>
	</div>
	<!--Slots End-->
</div>
<!--header End-->
<!-- Webchat在线客服图标:默认图标[浮动图标]开始-->
<div style="top:50%"><div style='display:none;'><a href='https://www.webchat.com' style='top:50%'>在线客服</a></div><script language="javascript" src="https://ic86.ichatshop.com/chat/chatClient/floatButton.js?jid=1699111339&companyID=5010400&configID=3603&codeType=custom&ss=1"></script><div style='display:none;'><a href='https://en.webchat.com'>live chat</a></div></div>
<!-- 在线客服图标:默认图标结束-->