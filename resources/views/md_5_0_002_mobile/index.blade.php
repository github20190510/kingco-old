<!doctype html>
<html lang="{{ app()->getLocale() }}">
	@include($header_name)
	<body>
		<!--Login bar-->
		@include($head_name)
		<!--輪播 Start-->
		@include('md_5_0_002_mobile.include._carousel')
		<!--輪播 End-->
		<!--公告-->
		@include('md_5_0_002_mobile.include._notice')
		@include('md_5_0_002_mobile.include._main')
		<!--Footer-->
		@include($footer_name)

		<script>

			$(document).ready(function(){
	            $('a[data-dismiss="modal"][data-dismiss="modal"]').on('click',function(){
	                var target = $(this).data('target');
	                $(target).on('shown.bs.modal',function(){
	                    $('body').addClass('modal-open');

	                });
	            });
	        });

	        var app = new Vue({
	            el : '#index_data',
	            data : {
	                notic_data : []
	            },
	            created: function(){

	                this.get_new_notic();

	            },
	            methods: {
             
	                get_new_notic: function(){

	                    var ApiURL = API_Host + '/system/notic/0/99';
	                    Vue.prototype.$http = axios;

	                    var self = this;
	                    this.$http.get(ApiURL, {cancelToken: source.token})
	                    .then(function (response) {
	                        this.json = response.data;
	                        if(this.json['code'] == '1'){
	                            if(this.json['info'].length > 0){
	                                self.notic_data = this.json['info'];
	                            }
	                        }else{
	                            self.alertinfo(this.json['info']);
	                            return;
	                        }
	                    })
	                    .catch(function (error) {
	                        console.log(error);
	                    });

	                }
	            }
	        });

	        var json_data = new Array();

	        readTextFile('{{asset("js/games/bg_list.js")}}', function(text){

	            json_data = JSON.parse(text);
	            for_data = json_data['bg_game_data'];


	            var pc_game_menu = new Vue({
		            el: '#pc_game_menu',
		            data : {
		                game_href : '#',
		                g_id : '',
		                g_type : '',
		                gamedatas : new Array(),
		                def_lang: 'zh_cn',
                    	search_word: '',
	                    corp_name: 'bg',
	                    MODEL_NAME : 'game_img/mobile'
		            },
		            created: function(){

	                    this.def_lang = '<?php echo $lang; ?>';
	                    this.getBGGame();

	                },
		            methods: {
		                confirm_into_game: function(){

		                    this.game_href = '/game/intogame/' + this.g_id + '/' + this.g_type;
		                    var self = this;
		                    setTimeout(function(){
		                        self.$refs['gamelink'].click();
		                    }, 500);
		                    setTimeout(function(){
		                        location.href = '/';
		                    }, 1000);

		                },
		                close_all_game: function(obj_id){
		                    
		                    $('.collapse').each(function(k,v){
		                        if(v.id != obj_id){
		                            $('#'+v.id).collapse('hide');
		                        }
		                        
		                    });
		                    if (obj_id == "collapseFishing" && document.getElementById("collapseFishing").className == "collapse"){
		                            $('html, body').animate({scrollTop:document.body.scrollHeight}, 500,"linear");

		                    }
		                },
		                trans_into_game: function(gid, gtype, dialog_name){

		                    this.into_game(gid, gtype, '{{ __('msg_zy_1.click_into_game_button') }}', '{{ __('msg_zy_1.into_game') }}', dialog_name);

		                }
		            }
		        });

		        var mobile_game_menu = new Vue({
		            el: '#mobile_game_menu',
		            data : {
		                game_href : '#',
		                g_id : '',
		                g_type : '',
		                gamedatas : new Array(),
		                def_lang: 'zh_cn',
                    	search_word: '',
	                    corp_name: 'bg',
	                    MODEL_NAME : 'game_img/mobile'
		            },
		            created: function(){

	                    this.def_lang = '<?php echo $lang; ?>';
	                    this.getBGGame();

	                },
		            methods: {
		                confirm_into_game: function(){

		                    this.game_href = '/game/intogame/' + this.g_id + '/' + this.g_type;
		                    var self = this;
		                    setTimeout(function(){
		                        self.$refs['gamelink_m'].click();
		                    }, 500);
		                    setTimeout(function(){
		                        location.href = '/';
		                    }, 1000);

		                },
		                close_all_game: function(obj_id){
		                    
		                    $('.collapse').each(function(k,v){
		                        if(v.id != obj_id){
		                            $('#'+v.id).collapse('hide');
		                        }
		                        
		                    });
		                    if (obj_id == "collapseFishing" && document.getElementById("collapseFishing").className == "collapse"){
		                            $('html, body').animate({scrollTop:document.body.scrollHeight}, 500,"linear");

		                    }
		                },
		                trans_into_game: function(gid, gtype, dialog_name){

		                    this.into_game(gid, gtype, '{{ __('msg_zy_1.click_into_game_button') }}', '{{ __('msg_zy_1.into_game') }}', dialog_name);

		                }
		            }
		        });
	        });

	        

	        
	    </script>
	</body>
</html>

