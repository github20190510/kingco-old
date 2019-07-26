<div id="gamelist" class="container-fluid text-center slot-nav-bar">
        <div class="content">
            <!--Game carousel Start-->
            <section id="game-menu" class="game-menu">
                <div class="row">
                    <div class="col columns">
                        <ul class="owl-carousel owl-theme">
                            <li v-for="v in platform" class="item" :class="v['class_name']" @click="goto_game(v['act_name'])"></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!--Game carousl End-->
        </div>
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