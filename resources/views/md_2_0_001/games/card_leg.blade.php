<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_cardgame"></div>
        </div>
        <div id="leglist" class="container card-main">
            <div class="inner">
                <ul class="d-flex flex-wrap align-content-start">
                    <a v-for="(v, k) in gamedatas" :href="'/game/intogame/LEGGame/' + v['gamecode']" target="_blank">
                        <li class="c-KY enabled" :style="{backgroundImage : 'url(' + v.bkimg + ')' }" style="margin-right:20px!important">
                            <div class="KY"></div>
                            <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                        </li>
                    </a>
                </ul>
            </div> 
        </div>
        @include($footer_name)
    </body>
    <script>
        var json_data = new Array();

        readTextFile('{{asset("js/games/leg_list.js")}}', function(text){

            json_data = JSON.parse(text);
            for_data = json_data['leg_game_data'];
            var app = new Vue({
                el : '#leglist',
                data : {
                    gamedatas : new Array(),
                    pg : 1,
                    perpage : 20,
                    def_lang: 'zh_cn',
                    minPage: 1,
                    maxPage: 1,
                    show_first: 0,
                    show_pre: 0,
                    show_pg1: 0,
                    show_pg3: 0,
                    show_next: 0,
                    show_last: 0,
                    pg1: 1,
                    pg2: 2,
                    pg3: 3,
                    search_word: '',
                    corp_name: 'leg',
                    ddl_page : 1,
                    MODEL_NAME : 'game_img/pc'
                    //MODEL_NAME : "<?php echo session('model_type'); ?>/images"

                },
                created: function(){

                    this.def_lang = '<?php echo $lang; ?>';
                    this.get_games();

                    var self = this;

                    $.each(this.gamedatas, function(k, v){
                        self.gamedatas[k]['bkimg'] = '{{asset("css/")}}/' + self.MODEL_NAME + v['img'];
                    });

                }
            });
        });
    </script>
</html>
