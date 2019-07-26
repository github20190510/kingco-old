<div class="container-fluid text-center slot-nav-bar" id="gamelist">
    <!--Game carousel Start-->
    <section id="game-menu" class="game-menu">
        <div class="row">
            <div class="col columns">
                <ul class="owl-carousel owl-theme">
                    <li v-for="v in platform" class="item" :class="v['class_name']" @click="goto_game(v['act_name'])"></li>
                    <!--<li class="item item-2">--><!--PT電子--><!--</li>-->
                    <!--<li class="item item-3">--><!--AG電子--><!--</li>-->
                    <!--<li class="item item-4">--><!--BBIN電子--><!--</li>-->
                    <!--<li class="item item-5">--><!--QT電子--><!--</li>-->
                    <!--<li class="item item-7">--><!--AB電子--><!--</li>-->
                    <!--<li class="item item-9">--><!--IM--><!--</li>-->
                    <!--<li class="item item-10">--><!--MG--><!--</li>-->
                    <!--<li class="item item-11">--><!--YP--><!--</li>-->
                    <!--<li class="item item-13">--><!--SG--><!--</li>-->
                </ul>
            </div>
        </div>
    </section>
</div>

<script>
var gamelist = new Vue({
    el: '#gamelist', 
    data : {
        platform : []
    },
    created: function(){

        var self = this;
        $.each(Elec_Platform['original'], function(k, v){
            if(v['status'] == 1){
                self.platform.push(v);
            }
        });
        //因為目前遊戲數量不夠，所以多放一個迴圈讓輪播效果正常
        // $.each(Elec_Platform['original'], function(k, v){
        //     if(v['status'] == 1){
        //         self.platform.push(v);
        //     }
        // });

    }
});
</script>