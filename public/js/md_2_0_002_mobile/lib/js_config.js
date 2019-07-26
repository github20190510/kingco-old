var now_host = window.location.host;
var now_protocol = window.location.protocol;

const API_Host = now_protocol + '//' + now_host;
const game_list_key = 'kc';
/*
* 中斷axios用的斷點token
*/
const CancelToken = axios.CancelToken;
const source = CancelToken.source();
/*
* 定義文件位置
*/
const Folder_Name = 'md_2_0_002_mobile';
//輪播套件初始化
$(document).ready(function(){

    if($('.owl-carousel').length > 0){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 9,
            loop: false,
            margin: 1,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            rewind: true,
            responsive:{
                0:{
                        items:4
                },
                600:{
                        items:4
                },  
                768:{
                        items:6
                },
                960:{
                        items:8
                },
                1200:{
                        items:9
                }
            }
        });
    }

});
/*
* 取回錢包資料
*/
Vue.prototype.getbagmoney = function (session_data, strMoney, acc_money = ''){

    if(session_data != ''){
    	var ApiURL = API_Host + '/game/getmybagmoney';
        Vue.prototype.$http = axios;

        var self = this;
        this.$http.get(ApiURL, {cancelToken: source.token})
        .then(function (response) {
            this.json = response.data;
            if(this.json['code'] == '1'){
                var str_money = formatMoney(this.json['info']);
            	self.setshowbagmony(str_money,strMoney);
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
Vue.prototype.setshowbagmony = function(str_money,strMoney){
    $('#acc_money').html('<i class="fas fa-wallet fa-fw"></i> ' + strMoney + str_money);
    //如果是會員頁要另外指定
    if($('#mb_acc_money').length > 0){
        $('#mb_acc_money').html('<i class="fas fa-wallet fa-fw"></i> ' + strMoney + str_money);
    }
    
    if(location.pathname == '/mb/acc'){
        $('#acc_money_h3').html(str_money);
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
                if(location.pathname == '/mb/mb_index'){
                    if(self.msg_count > 0){
                        $('#btnMsg').addClass('new-msg');
                    }
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
Vue.prototype.into_game = function (gid, gtype, msg1, msg2){

    this.g_id = gid;
    this.g_type = gtype;
    
    var ua = new UserAgent();
    var browser_data = ua['_BROWSER'] + ' ' + ua['_BROWSER_ENGINE'] + ' ' + ua['_BROWSER_VERSION'];
    var os_data = ua['_OS'] + ' ' + ua['_OS_VERSION'];

    var ApiURL = API_Host + '/mb/chk_user_session/' + browser_data + '/' + os_data;
    Vue.prototype.$http = axios;
    var newPage = window.open('about:blank');
    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        this.json = response.data;
        if(this.json['code'] == '1'){
            //確認點數
            self.chk_has_money(msg1, msg2, newPage);
        }else{
            //導到登入頁
            newPage.close();
            location.href = '/mb/login_page/' + self.g_id + '/' + self.g_type;
        }
    })
    .catch(function (error) {
        console.log(error);
    });

};
/*
* 確認遊戲餘額是否足夠
* msg1~msg2 : 訊息資料
* newPage : 新頁面選取器
*/
Vue.prototype.chk_has_money = function (msg1, msg2, newPage){

    var ApiURL = API_Host + '/game/gamebalance/' + this.g_id;
    Vue.prototype.$http = axios;
    
    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        this.json = response.data;
        if(this.json['code'] == '1'){
            self.game_href = '/game/intogame/' + self.g_id + '/' + self.g_type;
            //進入遊戲            
            if(parseInt(this.json['info']) >= 1){
                //self.change_msg(msg1, msg2);
                newPage.location.href = self.game_href;
            }else{
                newPage.close();
                $('#open_dialog').click();                
            }
        }else{
            //導到首頁
            if(this.json['info'] == '用户不存在'){
                newPage.close();
                $('#open_dialog').click();                
            }else{
                newPage.close();
                self.alertinfo(this.json['info'], '/');                
                return;
            }
        }
    })
    .catch(function (error) {
        newPage.close();
        console.log(error);
    });

};
/*
* 回到轉點頁
*/
Vue.prototype.trans_point_page = function (){

   location.href = '/mb/acc';

};
/*
* 回到儲值頁
*/
Vue.prototype.trans_deposit_page = function (){

   location.href = '/mb/deposit';

};
/*
* 自動轉點
* msg1~msg5 : 不同顯示訊息
*/
Vue.prototype.auto_trans_point = function (msg1, msg2, msg3, msg4, msg5){

    //先取回錢包金額
    $('#set_money_close').click();
    var ApiURL = API_Host + '/game/getmybagmoney';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        this.json = response.data;
        if(this.json['code'] == '1'){
            self.trans_point(this.json['info'], msg1, msg2, msg3, msg4, msg5);
        }else{
            self.alertinfo(this.json['info'], '/');
            return;
        }
    })
    .catch(function (error) {
        console.log(error);
    });

};
/* 自動轉點行為
* money : 金額
* msg1~msg5 : 不同顯示訊息
*/
Vue.prototype.trans_point = function (money, msg1, msg2, msg3, msg4, msg5){

    var game_url = '/game/intogame/' + this.g_id + '/' + this.g_type;

    if(parseInt(money) != NaN && parseInt(money) > 0){
        if(this.g_id != ''){
            var ApiURL = API_Host + '/game/setmoney/' + this.g_id + '/' + money;
            Vue.prototype.$http = axios;

            var self = this;
            this.$http.get(ApiURL, {cancelToken: source.token})
            .then(function (response) {
                this.json = response.data;
                if(this.json['code'] == '1'){
                    //self.alertinfo(msg1 + msg2, '/');
                    self.change_msg(msg1 + msg2, msg5);
                    $('#open_dialog').click();
                }else{
                    self.alertinfo(this.json['info']);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }else{
            this.alertinfo(msg3);
            return;
        }
    }else{
        if(confirm(msg4)){
            this.change_msg(msg2, msg5);
            $('#open_dialog').click();
        }else{
            this.trans_deposit_page();
        }
    }

};
/*
* 改變dialog顯示文字
* msg2~msg5 : 要顯示的文字
*/
Vue.prototype.change_msg = function (msg2, msg5){

    $('#trans_point_page').hide();
    $('#auto_trans_point').hide();
    $('#msg_data').html(msg2);
    $('#exampleModalLabel').html(msg5);

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

    }else{

        var self = this;
        for(inti = 0; inti < cnt; inti++ ){
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

};
/* 
* 搜尋資料動作
*/
Vue.prototype.search_data = function (){

    this.get_games();

};
/*
* 更改日期動作
* date_mode : 動作模式
*/
Vue.prototype.change_date_act = function (date_mode){

    this.mdate = date_mode;

    if(this.mdate != 'nodata'){
        switch(this.mdate){
            case '0':
                //全部資料
                this.sdate = 'nodata';
                this.edate = 'nodata';
            break;
            case '1':
                //今天
                this.sdate = this.fdate(0) + ' 00:00:00';
                this.edate = this.fdate(0) + ' 23:59:59';
            break;
            case '2':
                //昨天
                this.sdate = this.fdate(-1) + ' 00:00:00';
                this.edate = this.fdate(-1) + ' 23:59:59';
            break;
            case '3':
                //一個禮拜
                this.sdate = this.fdate(-6) + ' 00:00:00';
                this.edate = this.fdate(0) + ' 23:59:59';
            break;
            case '4':
                //30天
                this.sdate = this.fdate(-29) + ' 00:00:00';
                this.edate = this.fdate(0) + ' 23:59:59';
            break;
        }
    }

};
/*
* 格式化日期
* index : 天數索引值
*/
Vue.prototype.fdate = function (index){

    var date = new Date();
    var newDate = new Date();
    newDate.setDate(date.getDate() + index);

    var year = newDate.getFullYear();
    var month = (newDate.getMonth() + 1);
    var day = newDate.getDate();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    var time =  [year, month, day].join('-');
    
    return time;

};
/*
* 回傳訂單狀態
* os : 訂單狀態
* str1~str5 : 訂單狀態中文名稱
*/
Vue.prototype.get_order_status = function (os, str1, str2, str3, str4, str5){

    vstrStatus = '';
    switch(os){
        case 1:
            strStatus = str1;
            break;
        case 2:
            strStatus = str2;
            break;
        case 3:
            strStatus = str3;
            break;
        case 4:
            strStatus = str4;
            break;
        case 5:
            strStatus = str5;
            break;
    }

    return strStatus;

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
            //self.del_login_cookie();
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
        location.href = trans_url;
    }

};