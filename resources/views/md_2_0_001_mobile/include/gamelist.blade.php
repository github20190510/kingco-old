<div class="container-fluid text-center slot-nav-bar" id="gamelist">
    <!--Game carousel Start-->
    <section id="game-menu" class="game-menu">
        <div class="row">
            <div class="col columns">
                <ul class="owl-carousel owl-theme mb-0">
                    <li v-for="v in platform" class="item" :class="v['class_name']" @click="goto_game(v['act_name'])"></li>
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

    }
});
</script>