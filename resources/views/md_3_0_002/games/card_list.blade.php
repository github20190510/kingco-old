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
        <div class="main card-main" id="card_list">
            <div class="content">
                <ul class="d-flex flex-wrap align-content-start">
                    <li v-for="card_data in card_datas" class="c-KY enabled" :style="{backgroundImage : 'url(' + card_data.img + ')' }">
                        <div class="KY"></div>
                        <div class="cover">{{ __('msg_zy_1.in_maintenance') }}</div>
                    </li>
                </ul>
            </div> 
        </div>
        @include($footer_name)
    </body>
    <script>
        function add_zero(num, length) {

            return (Array(length).join("0") + num).slice(-length);

        }

        var card_list = new Vue({
            el: '#card_list',
            data: {
                card_datas: {},
                MODEL_NAME : 'game_img/pc'
                //MODEL_NAME : "<?php echo session('model_type'); ?>/images"
            },
            created: function(){

                for(var inti = 1; inti <= 18; inti++){
                    this.card_datas[inti] = ({'img' : '{{asset("css/")}}/' + this.MODEL_NAME + "/cardgame/" + add_zero(inti, 2) + '.png'});
                }

            }
        });
    </script>
</html>
