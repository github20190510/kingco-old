<!doctype html>
<html lang="{{ app()->getLocale() }}">
	@include($header_name)
	<body class="main-body">
		@include($mb_head_name)
		<main role="main" class="container-fluid main discount-main">
			<div class="discount-tab">
				<div class="tab-content" id="nav-tabContent" style="background-color:white" v-html="activitycontent">
				</div>
			</div>
		</main>			
		<!--Footer Menu-->
		@include($footer_name)
		<!--go to top-->
		<script type="text/javascript">
			$(document).ready(function(){

				setTimeout(function(){
					var div = document.getElementById("nav-tabContent");
	　　				var arrDiv = div.getElementsByTagName("img");
					$.each(arrDiv, function(k, v){
						if(v.getAttribute('class') != undefined){
							v.setAttribute('class', 'img-fluid ' + v.getAttribute('class'));
						}else{
							v.setAttribute('class', 'img-fluid');
						}
					});
				}, 1500);
		    	
			});	

			var activity = new Vue({
	            el : '#nav-tabContent',
	            data: {
	                arr_activity: new Array(),
	                activitycontent: ''
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
	                                $.each(this.json['info'], function(k, v){
	                                    if(v['enterprisebrandactivitycode'] == {{$params['aid']}}){
	                                        self.activitycontent = self.escape2html(v['activitycontent']);                      
	                                        return false;
	                                    }
	                                });
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
	                escape2html: function(str){
	                    var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
	                    return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
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
