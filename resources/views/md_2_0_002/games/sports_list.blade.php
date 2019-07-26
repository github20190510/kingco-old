<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_sport"></div>
        </div>
        <div class="container main sport-content-module" id="sports_game">
            <a :href="game_href" target="_blank" ref="gamelink"></a>
            <div class="content d-flex flex-wrap justify-content-between">
                <div id="sport-sb" class="sportBox sb" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_sb') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
                <div id="sport-bbin" class="sportBox bbin" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_bbin') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
                <div id="sport-ss" class="sportBox ss" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_ss') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
                <div id="sport-tb" class="sportBox tb" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_tb') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
                <div id="sport-bl" class="sportBox bl" :class="{disabled : has_bl == 0, enabled : has_bl == 1}" @click="into_game('BLinkGame', 'TY')">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_bl') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
                <div id="sport-ysb" class="sportBox ysb" :class="{disabled : has_ysb == 0, enabled : has_ysb == 1}" @click="into_game('YSBGame', 'TY')">
                    <div class="sportimg"></div>
                    <div class="txt">
                        <div class="name">{{ __('msg_zy_1.sport_ysb') }}</div>
                    </div>
                    <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var casino_game = new Vue({
            el : '#sports_game',
            data : {
                has_data : 0,
                has_bl : 1,
                has_ysb : 1,
                game_href : '#'
            }
        });
    </script>
</html>
