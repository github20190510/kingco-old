<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>        
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_cardgame"></div>
        </div>    
        <div class="main card-main">
            <div class="content">
                <div id="cardgame-ky" class="cardgame-ky" onclick="location.href='{{ url('game/card_list') }}'"><a href=""><!--開元--></a></div>
                <div id="cardgame-leg" class="cardgame-leg" onclick="location.href='{{ url('game/card_leg') }}'"><a href=""><!--樂遊--></a></div>
                <!--<div id="cardgame-cq9" class="cardgame-cq9" onclick="location.href='{{ url('game/card_list') }}'"><a href="">--><!--CQ9--><!--</a></div>-->
                <!--<div id="cardgame-818" class="cardgame-818"><a href="">--><!--818--><!--</a></div>-->
            </div>
        </div>
        @include($footer_name)
    </body>
</html>
