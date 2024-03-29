@switch(session('model_type'))
    @case('md_6_0_002')
    @case('md_6_0_002_mobile')
        @include('md_6_0_002.include._main')
        @break
    @default
        <!-- =============桌機用 Start ============= -->
        <main role="main" class="main container index-main d-none d-md-none d-xl-block" id="pc_game_menu">
            <a :href="game_href" target="_blank" ref="gamelink"></a>
            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--快3-->
                    <button class="btn game-banner lottery-q3" type="button" data-toggle="collapse" data-target="#collapseCasino" aria-expanded="false" aria-controls="collapseCasino"></button>
                    <!--PC蛋蛋-->
                    <button class="btn game-banner lottery-pc" type="button" data-toggle="collapse" data-target="#collapseLottery" aria-expanded="false" aria-controls="collapseLottery"></button>
                    <!--時時彩-->
                    <button class="btn game-banner lottery-hr" type="button" data-toggle="collapse" data-target="#collapseCard" aria-expanded="false" aria-controls="collapseCard"></button>
                    <!--分分彩-->
                    <button class="btn game-banner lottery-mm" type="button" data-toggle="collapse" data-target="#collapseSport" aria-expanded="false" aria-controls="collapseSport"></button>
                    <!--六合彩-->
                    <button class="btn game-banner lottery-ms" type="button" data-toggle="collapse"  data-target="#collapseFishing" aria-expanded="false" aria-controls="collapseFishing"></button>
                </div>

                <!--快3 折疊-->
                <div class="collapse collapse-1" id="collapseCasino" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['q3']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--PC蛋蛋 折疊-->
                <div class="collapse collapse-2" id="collapseLottery" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['pc']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>

                <!--時時彩 折疊-->
                <div class="collapse collapse-3" id="collapseCard" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center" >
                        <li v-for="(v, k) in gamedatas['hr']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>

                <!--分分彩 折疊-->
                <div class="collapse collapse-4" id="collapseSport" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['mm']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>

                <!--六合彩 折疊-->
                <div class="collapse collapse-5" id="collapseFishing" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['ms']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
            </section>

            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--11選5-->
                    <button class="btn game-banner lottery-115" type="button" data-toggle="collapse" data-target="#collapse115" aria-expanded="false" aria-controls="collapse115"></button>
                    <!--PK10-->
                    <button class="btn game-banner lottery-pk10" type="button" data-toggle="collapse" data-target="#collapsepk10" aria-expanded="false" aria-controls="collapsepk10"></button>
                    <!--快樂十分-->
                    <button class="btn game-banner lottery-hp" type="button" data-toggle="collapse" data-target="#collapsehp" aria-expanded="false" aria-controls="collapsehp"></button>
                    <!--快樂8-->
                    <button class="btn game-banner lottery-q8" type="button" data-toggle="collapse" data-target="#collapsehp8" aria-expanded="false" aria-controls="collapsehp8"></button>
                    <!--低頻彩-->
                    <button class="btn game-banner lottery-dd" type="button" data-toggle="collapse" data-target="#collapsedd" aria-expanded="false" aria-controls="collapsedd"></button>
                </div>

                <!--11選5 折疊-->
                <div class="collapse collapse-1" id="collapse115" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['115']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--PK10 折疊-->
                <div class="collapse collapse-2" id="collapsepk10" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['pk10']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--快樂十分 折疊-->
                <div class="collapse collapse-3" id="collapsehp" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['hp']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--快樂8 折疊-->
                <div class="collapse collapse-4" id="collapsehp8" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['q8']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--低頻彩 折疊-->
                <div class="collapse collapse-5" id="collapsedd" data-parent="#pc_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['dd']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
            </section>
            @include('md_5_0_002_mobile.include._dialog')
        </main>
        <!-- =============桌機用 End ============= -->
        <!-- =============手機用 Start ============= -->
        <main role="main" class="main container index-main d-lg-block d-xl-none" id="mobile_game_menu">
            <a :href="game_href" target="_blank" ref="gamelink_m"></a>
            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--快3-->
                    <button class="btn game-banner lottery-q3" type="button" data-toggle="collapse" data-target="#collapseq32" aria-expanded="false" aria-controls="collapseq32"></button>
                    <!--PC蛋蛋-->
                    <button class="btn game-banner lottery-pc" type="button" data-toggle="collapse" data-target="#collapsepc2" aria-expanded="false" aria-controls="collapsepc2"></button>
                </div>
                <!--快3 折疊-->
                <div class="collapse" id="collapseq32" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['q3']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                </div>
                <!--PC蛋蛋 折疊-->
                <div class="collapse" id="collapsepc2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['pc']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-pc-bj"></li>
                        <li class="game-logo lottery-pc-ca"></li>
                        <li class="game-logo lottery-pc-sl"></li>
                    </ul>-->
                </div>
            </section>

            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--時時彩-->
                    <button class="btn game-banner lottery-hr" type="button" data-toggle="collapse" data-target="#collapsehr2" aria-expanded="false" aria-controls="collapsehr2"></button>
                    <!--分分彩-->
                    <button class="btn game-banner lottery-mm" type="button" data-toggle="collapse" data-target="#collapsemm2" aria-expanded="false" aria-controls="collapsemm2"></button>
                </div>
                <!--時時彩 折疊-->
                <div class="collapse" id="collapsehr2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['hr']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-hr-ch"></li>
                        <li class="game-logo lottery-hr-xj"></li>
                        <li class="game-logo lottery-hr-mm"></li>
                        <li class="game-logo lottery-hr-hr"></li>
                        <li class="game-logo lottery-hr-5"></li>
                        <li class="game-logo lottery-hr-10"></li>
                    </ul>-->
                </div>

                <!--分分彩 折疊-->
                <div class="collapse" id="collapsemm2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['mm']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-mm-qq"></li>
                        <li class="game-logo lottery-mm-bj"></li>
                        <li class="game-logo lottery-mm-sl"></li>
                        <li class="game-logo lottery-mm-ca"></li>
                        <li class="game-logo lottery-mm-qq2"></li>
                    </ul>-->
                </div>
            </section>

            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--六合彩-->
                    <button class="btn game-banner lottery-ms" type="button" data-toggle="collapse"  data-target="#collapsems2" aria-expanded="false" aria-controls="collapsems2"></button>
                    <!--11選5-->
                    <button class="btn game-banner lottery-115" type="button" data-toggle="collapse" data-target="#collapse1152" aria-expanded="false" aria-controls="collapse1152"></button>
                </div>

                <!--六合彩 折疊-->
                <div class="collapse" id="collapsems2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['ms']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-ms-3"></li>
                        <li class="game-logo lottery-ms-5"></li>
                        <li class="game-logo lottery-ms-hk"></li>
                    </ul>-->
                </div>
                <!--11選5 折疊-->
                <div class="collapse" id="collapse1152" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['115']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-115-gd"></li>
                        <li class="game-logo lottery-115-gg"></li>
                        <li class="game-logo lottery-115-sh"></li>
                        <li class="game-logo lottery-115-ys"></li>
                        <li class="game-logo lottery-115-lk"></li>
                    </ul>-->
                </div>
            </section>

            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--PK10-->
                    <button class="btn game-banner lottery-pk10" type="button" data-toggle="collapse" data-target="#collapsepk102" aria-expanded="false" aria-controls="collapsepk102"></button>
                    <!--快樂十分-->
                    <button class="btn game-banner lottery-hp" type="button" data-toggle="collapse" data-target="#collapsehp2" aria-expanded="false" aria-controls="collapsehp2"></button>
                </div>
                <!--PK10 折疊-->
                <div class="collapse" id="collapsepk102" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['pk10']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-pk10-bj"></li>
                        <li class="game-logo lottery-pk10-10"></li>
                        <li class="game-logo lottery-pk10-5"></li>
                        <li class="game-logo lottery-pk10-car"></li>
                    </ul>-->
                </div>
                <!--快樂十分 折疊-->
                <div class="collapse" id="collapsehp2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['hp']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-hp-fm"></li>
                        <li class="game-logo lottery-hp-gd"></li>
                        <li class="game-logo lottery-hp-hn"></li>
                    </ul>-->
                </div>
            </section>

            <section class="game-main">
                <div class="bg-transparent d-flex flex-wrap justify-content-between">
                    <!--快樂8-->
                    <button class="btn game-banner lottery-q8" type="button" data-toggle="collapse" data-target="#collapsehp82" aria-expanded="false" aria-controls="collapsehp82"></button>
                    <!--低頻彩-->
                    <button class="btn game-banner lottery-dd" type="button" data-toggle="collapse" data-target="#collapsedd2" aria-expanded="false" aria-controls="collapsedd2"></button>
                </div>

                <!--快樂8 折疊-->
                <div class="collapse" id="collapsehp82" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['q8']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-q8-bj"></li>
                        <li class="game-logo lottery-q8-ca"></li>
                        <li class="game-logo lottery-q8-tw"></li>
                        <li class="game-logo lottery-q8-sl"></li>
                    </ul>-->
                </div>
                <!--低頻彩 折疊-->
                <div class="collapse" id="collapsedd2" data-parent="#mobile_game_menu">
                    <ul class="game-module d-flex flex-wrap align-content-center">
                        <li v-for="(v, k) in gamedatas['dd']" class="game-logo" @click="trans_into_game('BGGame', v['gamecode'], 'open_dialog_m')" :style="{'background-image': 'url(' + '{{asset('/css/')}}/' + MODEL_NAME + v['img']+ ')'}" ></li>
                    </ul>
                    <!--<ul class="game-module d-flex flex-wrap align-content-center">
                        <li class="game-logo lottery-dd-sh"></li>
                        <li class="game-logo lottery-dd-3d"></li>
                        <li class="game-logo lottery-dd-3"></li>
                    </ul>-->
                </div>
            </section>
            @include('md_5_0_002_mobile.include._dialog_mobile')
        </main>
        <!-- =============手機用 End ============= -->

        <!--城市背景圖-->
        <div class="main-bg">
            <div class="container-fluid"></div>
        </div>
@endswitch