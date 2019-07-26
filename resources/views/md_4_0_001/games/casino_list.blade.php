<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>        
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_casino"></div>
        </div>    
        <div class="main casino-content-module">
            <div class="content" id="casino_game">
                <div class="casinoNav">
                    <li class="">{{ __('msg_dt_1.OG') }}(OG)</li>
                    <li class="">{{ __('msg_dt_1.AB') }}(AB)</li>
                    <li class="">{{ __('msg_dt_1.AG') }}(AG)</li>
                    <li class="">{{ __('msg_dt_1.BBIN') }}(BBIN)</li>
                </div>
                <a :href="game_href" target="_blank" ref="gamelink"></a>
                <ul class="d-flex flex-wrap justify-content-between">
                    <li id="c-dg" class="c-dg" :class="{disabled : dg_active == 0, enabled : dg_active == 1}" ><!--@click="into_game('DreamGame', 'SX')"-->  
                        <div class="title">
                            <p>DG</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>                        
                    </li>
                    <li id="c-n2" class="c-n2" :class="{disabled : n2live_active == 0, enabled : n2live_active == 1}" @click="into_game('N2Live', 'SX')">                        
                        <div class="title">
                            <p>N2-LIVE</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>                        
                    </li>
                    <li id="c-SA" class="c-SA" :class="{disabled : sa_active == 0, enabled : sa_active == 1}" > <!--@click="into_game('SAGame', 'SX')" -->
                        <div class="title">
                            <p>SA</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-IBO" class="c-IBO" :class="{disabled : ibo_active == 0, enabled : ibo_active == 1}" @click="into_game('IBOGame', 'SX')">
                        <div class="title">
                            <p>IBO</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-WM" class="c-WM" :class="{disabled : wm_active == 0, enabled : wm_active == 1}" @click="into_game('WMGame', 'SX')">
                        <div class="title">
                            <p>WM</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-QUEENCO" class="c-QUEENCO" :class="{disabled : queenco_active == 0, enabled : queenco_active == 1}" > <!-- @click="into_game('QueencoGame', 'SX')"-->
                        <div class="title">
                            <p>QUEENCO</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    
                    <li id="c-OG1" class="c-OG1" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>{{ __('msg_dt_1.OG') }}(OG)</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-AB" class="c-AB" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>{{ __('msg_dt_1.AB') }}(AB)</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-AG" class="c-AG" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>{{ __('msg_dt_1.AG') }}(AB)</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-BBIN" class="c-BBIN" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>{{ __('msg_dt_1.BBIN') }}(BBIN)</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <!--<li id="c-MICRO" class="c-MICRO" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>MICRO</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>-->
                    <li id="c-PLAY" class="c-PLAY" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>PLAY TECH</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>
                    <li id="c-SUNBET" class="c-SUNBET" :class="{disabled : has_data == 0, enabled : has_data == 1}">
                        <div class="title">
                            <p>SUNBET</p>
                        </div>
                        <div class="cover">{{ __('msg_dt_1.in_maintenance') }}</div>
                    </li>                    
                </ul>
            </div>        
        </div>
        @include($footer_name)
    </body>
    <script>
        var casino_game = new Vue({
            el : '#casino_game',
            data : {
                has_data : 0,
                dg_active : 0,
                n2live_active : 1,
                sa_active : 0,
                ibo_active : 1,
                wm_active : 1,
                queenco_active : 0,
                game_href : '#'
            }
        });
    </script>
</html>
