<!doctype html>
<html lang="{{ app()->getLocale() }}">
	@include($header_name)
	<body class="main-body">
		@include($mb_head_name)
		<main role="main" class="container-fluid main discount-main">
			<div class="discount-tab">
				<!--<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link text-white c-alpha-gold active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">全部</a>
						<a class="nav-item nav-link c-alpha-gold" id="nav-member-tab" data-toggle="tab" href="#nav-member" role="tab" aria-controls="nav-member" aria-selected="false">会员升等</a>
						<a class="nav-item nav-link c-alpha-gold" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="false">特别活动</a>
						<a class="nav-item nav-link c-alpha-gold" id="nav-red-tab" data-toggle="tab" href="#nav-red" role="tab" aria-controls="nav-red" aria-selected="false">搶紅包</a>
						<a class="nav-item nav-link c-alpha-gold" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="false">存款优惠</a>
						<a class="nav-item nav-link c-alpha-gold" id="nav-pinying-tab" data-toggle="tab" href="#nav-pinying" role="tab" aria-controls="nav-pinying" aria-selected="false">返水優惠</a>
					</div>
				</nav>-->
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
						<div class="discount-box">
							<!--<div class="dis" v-for="v in arr_activity"><a @click="into_activity(v.enterprisebrandactivitycode)"><image :src="v.activityimage" style="width:100%;height:79px;"></image></a></div>-->
							<div class="dis" v-for="v in arr_activity" :style="{backgroundImage:'url('+v.activityimage+')'}" @click="into_activity(v.enterprisebrandactivitycode)"></div>
						</div>
					</div>
					<!--全部-->
					<!--<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
						<div class="discount-box">
							<div class="dis member"></div>
							<div class="dis red"></div>
							<div class="dis events-3"></div>
							<div class="dis events-2"></div>
							<div class="dis events-1"></div>
							<div class="dis deposit-2"></div>
							<div class="dis deposit-1"></div>
							<div class="dis pinying"></div>
						</div>
					</div>-->
					<!--会员升等-->
					<!--<div class="tab-pane fade" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
						<div class="discount-box">
							<div class="dis member"></div>
						</div>
					</div>-->
					<!--特别活动-->
					<!--<div class="tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
						<div class="discount-box">
							<div class="dis events-3"></div>
							<div class="dis events-2"></div>
							<div class="dis events-1"></div>
						</div>
					</div>-->
					<!--搶紅包-->
					<!--<div class="tab-pane fade" id="nav-red" role="tabpanel" aria-labelledby="nav-red-tab">
						<div class="discount-box">
							<div class="dis red"></div>
						</div>
					</div>-->
					<!--存款优惠-->
					<!--<div class="tab-pane fade" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
						<div class="discount-box">
							<div class="dis deposit-2"></div>
							<div class="dis deposit-1"></div>
						</div>
					</div>-->
					<!--返水優惠-->
					<!--<div class="tab-pane fade" id="nav-pinying" role="tabpanel" aria-labelledby="nav-pinying-tab">
						<div class="discount-box">
							<div class="dis pinying"></div>
						</div>
					</div>-->
				</div>
			</div>
			<!--go to top-->
			 <a id="back-to-top" href="#" class="btn back-to-top" role="button" title="" data-toggle="tooltip" data-placement="left" style="display: block;">
				 <i class="fas fa-angle-up fa-lg"></i>
			</a>
		</main>			
		<!--Footer Menu-->
		@include($footer_name)
		<!-- Bootstrap core JavaScript
		    ================================================== --> 
		<!-- Placed at the end of the document so the pages load faster --> 
		<!--go to top-->
		<script type="text/javascript">
			$(document).ready(function(){
		    	$(window).scroll(function () {
		            if ($(this).scrollTop() > 50) {
		                $('#back-to-top').fadeIn();
		            } else {
		                $('#back-to-top').fadeOut();
		            }
		        });
		        // scroll body to 0px on click
		        $('#back-to-top').click(function () {
		            $('#back-to-top').tooltip('hide');
		            $('body,html').animate({
		                scrollTop: 0
		            }, 800);
		            return false;
		        });
		        
		        $('#back-to-top').tooltip('show');

			});	

			var activity = new Vue({
	            el : '#nav-tabContent',
	            data: {
	                arr_activity: new Array()
	            },
	            created: function(){
	                this.get_activity();
	            },
	            methods: {
	                get_activity: function(){

	                    var ApiURL = API_Host + '/mb/brandactivitytrigger';
	                    Vue.prototype.$http = axios;

	                    var self = this;
	                    this.$http.get(ApiURL, {cancelToken: source.token})
	                    .then(function (response) {
	                        this.json = response.data;
	                        if(this.json['code'] == '1'){
	                            if(this.json['info'].length > 0){
	                                self.arr_activity = this.json['info'];
	                            }
	                        }else{
	                            self.alertinfo(this.json['info']);
	                            return;
	                        }
	                    })
	                    .catch(function (error) {
	                        console.log(error);
	                    });

	                },
	                into_activity: function(aid){

	                    location.href = "discount_content/" + aid;
	                
	                }
	            }
	        });
		</script>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
		  <defs>
		    <style type="text/css">
		</style>
		  </defs>
		  <text x="0" y="2" style="font-weight:bold;font-size:2pt;font-family:Arial, Helvetica, Open Sans, sans-serif">32x32</text>
		</svg>
	</body>
</html>
