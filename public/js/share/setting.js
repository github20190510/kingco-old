/*
* 電子遊戲規則(用在輪播)
*/
let elec_platform = [];

elec_platform['original'] = [
        	{'name':'CQ9', 'class_name':'item-1', 'act_name':'comCQ9', 'status':'1'},
        	{'name':'RTG', 'class_name':'item-14', 'act_name':'comRTG', 'status':'1'},
            // {'name':'SA', 'class_name':'item-15', 'act_name':'comSA', 'status':'1'},
            {'name':'Genesis', 'class_name':'item-16', 'act_name':'comGenesis', 'status':'1'},
            // {'name':'PG', 'class_name':'item-6', 'act_name':'comPG', 'status':'1'},
            // {'name':'SW', 'class_name':'item-8', 'act_name':'comSW', 'status':'1'},
            {'name':'PT', 'class_name':'item-17', 'act_name':'comVT', 'status':'1'},
            {'name':'MW', 'class_name':'item-12', 'act_name':'comMW', 'status':'1'}
	];

const Elec_Platform = elec_platform;

/************特殊規則部份start************/
/*
* 無法包在iframe中的廠商
*/
const arr_trans_page_game = ['N2Live', 'TCGGGame', 'SGGame', 'IDCGame', 'BGGame'];
/*
* 使用jpg圖檔的遊戲
*/
const arr_use_jpg = ['cq9', 'rtg', 'sa'];
/*
* 進入遊戲使用gameid的遊戲
*/
const arr_has_gameid = ['pg'];
/*
* 直立式的遊戲
*/
const arr_uplight = ['PGGame'];
/*
* 需要有第一頁及最後一頁的頁面
*/
const arr_other_option = ['mb_details', 'show_history'];

/************特殊規則部份end**************/
/*
* 跳至遊戲列表頁面
*/
Vue.prototype.goto_game = function (com_name){

    switch(com_name){
        case 'comCQ9':
            location.href = "/game/cq9list";
        break;
        case 'com818':
            location.href = "/game/lottery";
        break;
        case 'comGenesis':
            location.href = "/game/genesislist";
        break;
        case 'comRTG':
            location.href = "/game/rtglist";
        break;
        // case 'comPG':
        //     location.href = "/game/pglist";
        // break;
        case 'comSA':
            location.href = "/game/salist";
        break;
        case 'comSW':
            location.href = "/game/swlist";
        break;
        case 'comVT':
            location.href = "/game/vtlist";
        break;
        case 'comMW':
            location.href = "/game/mwlist";
        break;
        case 'comLEG':
            location.href = "/game/card_leg";
        break;
    }

};
/*
* 協助指定元件的click動作
*/
Vue.prototype.chk_game_login = function (elmid){

    this.$refs[elmid].click();

};
/* 
* 線上人數，玩家登入時接口
*/
Vue.prototype.setonline = function(){

    var ApiURL = API_Host + '/mb/setonline/';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        //目前在線人數送出資料後未做任何判斷，後續如果有需要再來處理
        this.json = response.data;
        //如果有需要寫入失敗的話強制登出時用的
        //self.logout('footer');
    })
    .catch(function (error) {
        console.log(error);
    });

};
/* 
* 線上人數，玩家持續在線上接口
*/
Vue.prototype.setliving = function(){

    var ApiURL = API_Host + '/mb/setliving/';
    Vue.prototype.$http = axios;

    var self = this;
    this.$http.get(ApiURL, {cancelToken: source.token})
    .then(function (response) {
        //目前在線人數送出資料後未做任何判斷，後續如果有需要再來處理
        this.json = response.data;
        //如果有需要寫入失敗的話強制登出時用的
        //self.logout('footer');
    })
    .catch(function (error) {
        console.log(error);
    });

};
/*
* 格式化金額(將長整數轉化成123,456.00之類的格式)
*/
function formatMoney(n, c, d, t) {

    var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

};
/*
* 正整數加上逗號
*/
function numFormat(num) {

    var res = num.toString().replace(/\d+/, function(n) {
        // 先提取整数部分
        return n.replace(/(\d)(?=(\d{3})+$)/g, function($1) {
            return $1 + ",";
        });
    })

    return res;

}
