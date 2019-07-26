/*
* 宣告呼叫api的路徑
*/
var now_host = window.location.host;
var now_protocol = window.location.protocol;

const API_Host = now_protocol + '//' + now_host;
const game_list_key = 'original';
/*
* 中斷axios用的斷點token
*/
const CancelToken = axios.CancelToken;
const source = CancelToken.source();
/*
* 定義文件位置
*/
const Folder_Name = 'md_4_0_001';
//輪播套件初始化
$(document).ready(function(){

    if($('.owl-carousel').length > 0){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 4,
            loop: false,
            margin: 1,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            rewind: true
        });
    }

});
/*
* 取回錢包資料
*/
Vue.prototype.getbagmoney = function (session_data){

    if(session_data != ''){
        var ApiURL = API_Host + '/game/getmybagmoney';
        Vue.prototype.$http = axios;

        var self = this;
        this.$http.get(ApiURL, {cancelToken: source.token})
        .then(function (response) {
            this.json = response.data;
            if(this.json['code'] == '1'){
                var str_money = formatMoney(this.json['info']);
                self.setshowbagmony(str_money);
            }else if (this.json['code'] == '1003'){
                self.alertinfo(this.json['info']);
                self.logout('footer');
            }else{
                if(this.json['info'] != '' && this.json['info'] != undefined){
                    return this.json['info'];
                }
            }
        })
        .catch(function (error) {
            console.log(error);
            return '';
        });
    }

};
/*
* 設置錢包所顯示的金額
*/
Vue.prototype.setshowbagmony = function(str_money){
    $('#acc_money').html(str_money);    
    //如果是會員頁要另外指定
    if(location.pathname.indexOf('/mb/') != -1){
        $('#acc_bag_money').html(str_money);
        //如果是帳戶概況要另外指定
        if(location.pathname == '/mb/acc'){
            $('#mb_acc_money').html(str_money);                            
        }
    }
};
/*
* 取回訊息數量
*/
Vue.prototype.getmsgcount = function (session_data){

    if(session_data != ''){
        var ApiURL = API_Host + '/mb/message_count';
        Vue.prototype.$http = axios;

        var self = this;
        this.$http.get(ApiURL, {cancelToken: source.token})
        .then(function (response) {
            this.json = response.data;
            if(this.json['code'] == '1'){
                self.msg_count = this.json['info'];
                //如果是會員頁要另外指定
                if(location.pathname.indexOf('/mb/') != -1){
                    $('#span_msg_count').html(this.json['info']);
                }
            }else{
                self.alertinfo(this.json['info']);
                return;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

};
/*
* 進入遊戲遊玩頁面
*/
Vue.prototype.into_game = function (gtype, ptype){

    this.game_href = '/game/intogame/' + gtype + '/' + ptype;
    var self = this;
    setTimeout(function(){
        self.$refs['gamelink'].click();
    }, 500);

};
/*-----------------取電子遊戲類表start-----------------*/
/*
* 讀取遊戲列表js檔
* file : 檔案
* callback : 結束後的callback動作
*/
function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
};
/*
* 取得遊戲列表
*/
Vue.prototype.get_games = function (){

    var img_ext = '.png';
    if(arr_use_jpg.indexOf(this.corp_name) != '-1'){
        img_ext = '.jpg';
    }

    var arrData = new Array();
    var cnt = for_data.length;

    if(this.search_word != ''){
        //如果有搜尋條件
        var self = this;
        var arrSearch = new Array();
        //先整理一份搜尋條件的資料出來
        for(inti = 0; inti < cnt; inti++){
            var game_lang_name = '';
            $.each(for_data[inti]['nameset'], function(k, v){
                if(v['name'].toLowerCase().indexOf(self.search_word) != -1){
                    arrSearch.push(for_data[inti]);
                    return false;
                }
            });                               
        }

        for(inti = 0; inti < arrSearch.length; inti++ ){
            var game_lang_name = '';
            $.each(arrSearch[inti]['nameset'], function(k, v){
                if(v['lang'] == self.def_lang){                                        
                    game_lang_name = v['name'];
                    return false;
                }
            });
            var imgUrl = '/' + this.corp_name + '/' + self.def_lang + '/' + arrSearch[inti]['gamecode'] + img_ext;

            if(arr_has_gameid.indexOf(this.corp_name) != '-1'){
                arrData.push({'gamecode' : arrSearch[inti]['gamecode'], 'gamename' : game_lang_name, 'img': imgUrl, 'status': arrSearch[inti]['status'], 'gameid': arrSearch[inti]['gameid']});
            }else{
                arrData.push({'gamecode' : arrSearch[inti]['gamecode'], 'gamename' : game_lang_name, 'img': imgUrl, 'status': arrSearch[inti]['status']});
            }
            
        }

        this.maxPage = 1;
        this.pg = 1;
        this.show_pre = 0;
        this.show_pg1 = 0;
        this.show_pg3 = 0;
        this.show_next = 0;
        this.pg2 = 1;

    }else{

        this.maxPage = Math.ceil(cnt / this.perpage);

        sdata = (this.pg - 1) * this.perpage ;
        edata = this.pg * this.perpage;
        if(edata >= cnt){
            edata = edata - (edata - cnt);
        }
        var self = this;
        for(inti = sdata; inti < edata; inti++ ){
            var game_lang_name = '';
            $.each(for_data[inti]['nameset'], function(k, v){
                if(v['lang'] == self.def_lang){
                    game_lang_name = v['name'];
                    return false;
                }
            });
            var imgUrl = '/' + this.corp_name + '/' + self.def_lang + '/' + for_data[inti]['gamecode'] + img_ext;

            if(arr_has_gameid.indexOf(this.corp_name) != '-1'){
                arrData.push({'gamecode' : for_data[inti]['gamecode'], 'gamename' : game_lang_name, 'img': imgUrl, 'status': for_data[inti]['status'], 'gameid': for_data[inti]['gameid']});
            }else{
                arrData.push({'gamecode' : for_data[inti]['gamecode'], 'gamename' : game_lang_name, 'img': imgUrl, 'status': for_data[inti]['status']});
            }
        }                            
    }

    this.gamedatas = new Array();
    this.gamedatas = arrData;
    this.getPage();

};
/*
* 取得頁數
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.getPage = function (other_option = ''){

    this.ddl_page = this.pg;
    if(this.maxPage == 1){
        //表示只有一頁
        this.show_pre = 0;
        this.show_pg1 = 0;
        this.show_pg3 = 0;
        this.show_next = 0;
        this.pg2 = 1;
        this.show_first = 0;
        this.show_last = 0;

    }else{
        if(this.pg == this.maxPage){
            //表示是最後一頁
            this.show_first = 1;
            this.show_last = 0;
            this.show_pre = 1;
            this.show_next = 0;
            this.show_pg1 = 1;
            this.show_pg3 = 1;
            if((this.maxPage - this.minPage) >= 2){
                //表示前面有超過三頁
                this.show_pg3 = 1;
                this.pg3 = this.pg;
                this.pg2 = this.pg - 1;
                this.pg1 = this.pg - 2;
            }else{
                //表示前面剩不到三頁，最後一筆不顯示
                this.show_pg3 = 0;
                this.pg2 = this.pg;
                this.pg1 = this.pg - 1;

            }
        }else if(this.pg == this.minPage){
            //表示是第一頁
            this.show_first = 0;
            this.show_last = 1;
            this.show_pre = 0;
            this.show_pg1 = 1;
            this.show_next = 1;
            if((this.maxPage - this.pg) >= 2){
                //表示後面有超過三頁
                this.show_pg3 = 1;
                this.pg1 = this.pg;
                this.pg2 = this.pg + 1;
                this.pg3 = this.pg + 2;
            }else{
                //表示後面剩不到三頁，最後一筆不顯示
                this.show_pg3 = 0;
                this.pg1 = this.pg;
                this.pg2 = this.pg + 1;
            }
        }else{
            //表示是中間頁
            this.show_first = 1;
            this.show_last = 1;
            this.show_pre = 1;
            this.pg1 = this.pg-1;
            this.pg2 = this.pg;
            this.pg3 = this.pg + 1;
            this.show_next = 1;
            this.show_pg1 = 1;
            this.show_pg3 = 1;
        }
    }

};
/*
* 第一頁
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.go_first = function (other_option = ''){

    this.pg = 1;
   
    if(other_option != ''){
        switch(other_option){
            case 'mb_details':
                this.get_data();
                break;
            case 'show_history':
                this.show_records_data();
                break;
            case 'message':
                this.get_user_message();
                break;
        }
    }else{
        this.get_games();
    }

};
/*
* 上一頁
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.go_pre = function (other_option = ''){

    this.pg = this.pg - 1;
   
    if(other_option != ''){
        switch(other_option){
            case 'mb_details':
                this.get_data();
                break;
            case 'message':
                this.get_user_message();
                break;
            case 'show_history':
                this.show_records_data();
                break;
        }
    }else{
        this.get_games();
    }

};
/*
* 下一頁
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.go_next = function (other_option = ''){

    this.pg = this.pg + 1;

    if(other_option != ''){
        switch(other_option){
            case 'mb_details':
                this.get_data();
                break;
            case 'message':
                this.get_user_message();
                break;
            case 'show_history':
                this.show_records_data();
                break;
        }
    }else{
        this.get_games();
    }

};
/*
* 跳到最後一頁
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.go_last = function (other_option = ''){

    this.pg = this.maxPage;
   
    if(other_option != ''){
        switch(other_option){
            case 'mb_details':
                this.get_data();
                break;
            case 'show_history':
                this.show_records_data();
                break;
            case 'message':
                this.get_user_message();
                break;
        }
    }else{
        this.get_games();
    }

};
/*
* 跳到指定頁數
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.go_page = function (pg, other_option = ''){

    this.pg = pg;

    if(other_option != ''){
        switch(other_option){
            case 'mb_details':
                this.get_data();
                break;
            case 'message':
                this.get_user_message();
                break;
            case 'show_history':
                this.show_records_data();
                break;
        }
    }else{
        this.get_games();
    }

};
/* 
* 下拉選單指定頁數
* other_option : 有些頁面使用的function不同，以傳入的參數做分別(預設為空)
*/
Vue.prototype.select_go_page = function (other_option = ''){

    this.go_page(this.ddl_page, other_option);

};
/* 
* 搜尋資料動作
*/
Vue.prototype.search_data = function (){

    this.get_games();

};
/*
* 登出動作(目前會先做呼叫在線人數的api，才做登出動作)
* call_page : 呼叫的頁面(如果是head呼叫的，要把login_status改為0，不做頁面導向動作，其它的就走原本的動作)
* str_msg : 提示訊息(如果是head呼叫的才會需要這個參數，預設為空)
*/
Vue.prototype.logout = function (call_page, str_msg = ''){

    var ApiURL = API_Host + '/mb/setoffline/';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        //目前在線人數送出資料後未做任何判斷，後續如果有需要再來處理
        this.json = response.data;
        self.logout_act(call_page, str_msg);

    })
    .catch(function (error) {
        console.log(error);
    });

};
/*
* 登出動作(目前會先做呼叫在線人數的api，才做登出動作)
* call_page : 呼叫的頁面(如果是head呼叫的，要把login_status改為0，不做頁面導向動作，其它的就走原本的動作)
* str_msg : 提示訊息(如果是head呼叫的才會需要這個參數，預設為空)
*/
Vue.prototype.logout_act = function(call_page, str_msg = ''){
    
    source.cancel('logout');

    var ApiURL = API_Host + '/mb/user_logout';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL)
    .then(function (response) {
        this.json = response.data;
        if(this.json['code'] != '1'){
            self.alertinfo(this.json['info']);
            return;
        }else{
            self.del_login_cookie();
            if(call_page == 'head'){
                self.login_status = 0;
                self.alertinfo(str_msg, '/');
                return;
            }else{
                location.href = '/';
            }
        }
    })
    .catch(function (error) {
        console.log(error);
    });

};
/* 
* 清除登入cookie
*/
Vue.prototype.del_login_cookie = function(){

    var ApiURL = API_Host + '/login_cookie/del';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL)
    .then(function (response) {
    })
    .catch(function (error) {
        console.log(error);
    });

}
/* 
* 回到頁面最上面
*/
Vue.prototype.get_scroll_top = function (){

    this.show_mb_loading = 1;
    var bodyTop = 0;
    if (typeof window.pageYOffset != "undefined") {
        bodyTop = window.pageYOffset;

    } else if (typeof document.compatMode != "undefined"
    && document.compatMode != "BackCompat") {
        bodyTop = document.documentElement.scrollTop;

    } else if (typeof document.body != "undefined") {
        bodyTop = document.body.scrollTop;
    }
    
    setTimeout(function(){
        $('#div_mb_loading').css('top', bodyTop+'px');
    }, 100);

};
/*-----------------取電子遊戲類表end-------------------*/
/* 
* 跳alert錯誤訊息
* info : alert的錯誤訊息內容
* trans_url : 按下確定之後要導向的頁面(預設不導向)
*/
Vue.prototype.alertinfo = function (info, trans_url = ''){

	if(info != '' && info != undefined){
        alert(info);        
    }
    if(trans_url != ''){
        setTimeout(function(){
            location.href = trans_url;
        }, 1000);
    }
    return;

};
Vue.prototype.chk_index = function(){

    var is_index = 0;

    if(location.pathname == '/'){
        is_index = 1;
    }

    return is_index;

};