<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="header-area">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_discount"></div>
        </div>
        <div class="main discount-main">
            <div class="content" id="nav-tabContent" v-html="activitycontent">
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var activity = new Vue({
            el : '#nav-tabContent',
            data: {
                arr_activity: new Array(),
                activitycontent: ''
            },
            created: function(){
                this.get_activity();
            },
            methods: {
                get_activity: function(){

                    var ApiURL = API_Host + '/mb/brandactivitytrigger';
                    Vue.prototype.$http = axios;

                    var self = this;
                    this.$http.get(ApiURL, {cancelToken: source.token})
                    .then(function (response) {
                        this.json = response.data;
                        if(this.json['code'] == '1'){
                            if(this.json['info'].length > 0){
                                $.each(this.json['info'], function(k, v){
                                    if(v['enterprisebrandactivitycode'] == {{$params['aid']}}){
                                        self.activitycontent = self.escape2html(v['activitycontent']);
                                        return false;
                                    }
                                });
                                //$('#act_content').html(self.activitycontent);
                            }
                        }else{
                            self.alertinfo(this.json['info']);
                            return;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
                escape2html: function(str){
                    var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
                    return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
                }
            }
        });
    </script>
</html>
