<main role="main" class="main container index-main d-none d-md-none d-xl-block" id="pc_game_menu">
    <a :href="game_href" target="_blank" ref="gamelink"></a>
    <section class="game-main">
        @include('md_6_0_002.include._main_section');
    </section>
    @include('md_5_0_002_mobile.include._dialog')
</main>
<main role="main" class="main container index-main d-lg-block d-xl-none" id="mobile_game_menu">
    <a :href="game_href" target="_blank" ref="gamelink_m"></a>
    <section class="game-main">
        @include('md_6_0_002.include._main_section');
    </section>
    @include('md_5_0_002_mobile.include._dialog_mobile')
</main>