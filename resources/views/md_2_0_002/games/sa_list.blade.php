<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_slots"></div>
        </div>
        @include($game_list)
        <div id="salist">
            <div class="container-fluid text-center slot-nav-bar">
                <!--Game carousl End-->
               <!--  <div class="slot-type d-flex align-items-center justify-content-center">
                    <button type="button" class="btn slot-type-btn"> <input type="checkbox" checked autocomplete="off">{{ __('msg_zy_1.prize_pool') . __('msg_zy_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn active">{{ __('msg_zy_1.all') . __('msg_zy_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.hot') . __('msg_zy_1.game') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.classic_slot_machine') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.horn_slot_machine') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.prize_pool_slot_machine') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.video_poker') }}</button>
                    <button type="button" class="btn slot-type-btn">{{ __('msg_zy_1.scratch') }}</button>
                    <input type="search" class="form-control ds-input ml-2" id="search-input" placeholder="Search..." v-model="search_word">
                    <button class="btn gb-gold text-white btn-sm ml-2" type="button" @click="search_data()">{{ __('msg_zy_1.search') }}</button>
                </div> -->
            </div>
            <div class="container slot-main">
                <div class="game-box d-flex flex-wrap align-content-start">
                    <div class="game enabled" v-for="(v, k) in gamedatas">
                        <div class="mask"><a :href="'/game/intogame/SAGame/' + v['gamecode']" target="_blank"><span>{{ __('msg_zy_1.enter') . __('msg_zy_1.game') }}</span></a></div>
                        <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                        <div class="gameImg"><img class="load"  alt="" :src="'{{asset('/css/')}}/' + MODEL_NAME + v['img']"></div>
                        <div class="gameName">@{{v['gamename']}}</div>
                    </div>
                </div>
                <!--   分页 -->
                <nav aria-label="Page navigation example" class="slot-page">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item" :class="{'disabled': show_first === 0}">
                            <a class="page-link" href="#" aria-label="Previous" @click="go_first()">
                                <span aria-hidden="true"><i class="fas fa-angle-double-left fa-lg"></i></span>
                                <span class="sr-only">{{ __('msg_zy_1.first_page') }}</span>
                            </a>
                        </li>
                        <li class="page-item" :class="{'disabled': show_pre === 0}">
                            <a class="page-link" href="#" aria-label="Previous" @click="go_pre()">
                                <span aria-hidden="true"><i class="fas fa-angle-left fa-lg"></i></span>
                                <span class="sr-only">{{ __('msg_zy_1.previous_page') }}</span>
                            </a>
                        </li>
                        <li class="page-item" :class="{'disabled': pg === pg1}"><a class="page-link" href="#" ref="pg1" @click="go_page(pg1)" v-if="show_pg1 === 1">@{{ pg1 }}</a></li>
                        <li class="page-item" :class="{'disabled': pg === pg2}"><a class="page-link" href="#" ref="pg2" @click="go_page(pg2)">@{{ pg2 }}</a></li>
                        <li class="page-item" :class="{'disabled': pg === pg3}"><a class="page-link" href="#" ref="pg3" @click="go_page(pg3)" v-if="show_pg3 === 1">@{{ pg3 }}</a></li>
                        <li class="page-item" :class="{'disabled': show_next === 0}">
                            <a class="page-link" href="#" aria-label="Next" @click="go_next()">
                                <span aria-hidden="true"><i class="fas fa-angle-right fa-lg"></i></span>
                                <span class="sr-only">{{ __('msg_zy_1.next_page') }}</span>
                            </a>
                        </li>
                        <li class="page-item" :class="{'disabled': show_last === 0}">
                            <a class="page-link" href="#" aria-label="Next" @click="go_last()">
                                <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                                <span class="sr-only">{{ __('msg_zy_1.last_page') }}</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <select @change="select_go_page()" v-model="ddl_page" class="form-control mt-2 ml-2">
                                <option :value="v" v-for="v in maxPage">第@{{v}}頁</option>
                            </select>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var json_data = new Array();

        readTextFile('{{asset("js/games/sa_list.js")}}', function(text){

            json_data = JSON.parse(text);
            for_data = json_data['sa_game_data'];
            var app = new Vue({
                el : '#salist',
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
                    corp_name: 'sa',
                    ddl_page : 1,
                    MODEL_NAME : 'game_img/pc'
                    //MODEL_NAME : "<?php echo session('model_type'); ?>/images"
                },
                created: function(){

                    this.def_lang = '<?php echo $lang; ?>';
                    this.get_games();

                }
            });
        });
    </script>
</html>
