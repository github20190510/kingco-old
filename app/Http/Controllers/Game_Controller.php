<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic_md;
use App\Share_md;
use App;

class Game_Controller extends Controller
{
    /**
    * 沒帶任何動作要顯示錯誤資料
    **/
    public function index(){

        Share_md::error_action('Game_Controller@index', 'no active!');

    }
    /**
    * 網頁顯示部份
    **/
    public function show_view(Request $request){

        $path = $request->path();

        $act = str_replace('game/', '', $path);

        $view_data = Basic_md::get_game_page($act);

        $lang = 'zh_cn';
        if(session('lang') != ''){
            $lang = session('lang');
        }

        //取回目前語系設定值
        $locale = App::getLocale();
        if (App::isLocale($lang)){
            //如果語系相同不做事
        }else{
            //如果語系不相同要設定當下語系
            App::setLocale($lang);
        }

        //傳入的lang是做為載入不同css的依據
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'game_list'=>$view_data['game_list'], 'lang'=>$lang));

    }
    /**
    * 進入玩遊戲頁面
    * gid : 遊戲平台
    * gtype : 遊戲id(如果不是電子遊戲則是傳遊戲類型)
    **/
    public function into_game($gid, $gtype){

        $view_data = Basic_md::get_game_page('into_game');

        $lang = 'zh_cn';
        if(session('lang') == ''){
            $lang = session('lang');
        }

        //取回目前語系設定值
        $locale = App::getLocale();
        if (App::isLocale($lang)){
            //如果語系相同不做事
        }else{
            //如果語系不相同要設定當下語系
            App::setLocale($lang);
        }
        
        //傳入的lang是做為載入不同css的依據
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'eid'=>session('login_eid'), 'gid'=>$gid, 'gtype'=>$gtype, 'lang'=>$lang));

    }
    /**
    * 獲取玩家餘額
    **/
    public function game_balances(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'Game/balance';

            $url = Share_md::combinedUrl($act);

            $param = array(
                            'enterprisecode' => session('enterprisecode'),
                            'brandcode'      => session('brandcode'),
                            'employeecode'   => $employee_code,
                            'gameType'       => "CENTER"
                          );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

         }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 取回用戶所有遊戲及中心錢包餘額列表
    **/
    public function game_balances_all(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'Game/balancesAll';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code
                          );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }
        

        return $json;

    }
    /**
    * 取回我的錢包資訊
    **/
    public function get_bag_money(){

        $employee_code = Share_md::get_employee_code();
        
        if($employee_code != ''){

            $dt = self::game_balances();
            
            if($dt['code'] == '1'){

                $json['info'] = $dt['info'];

                $json['code'] = $dt['code'];

            }else{

                $json = $dt;

            }
         }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 取回帳號所有遊戲的餘額
    **/
    public function game_balances_all_acc(){

        $employee_code = Share_md::get_employee_code();
        
        if($employee_code != ''){

            $dt = self::game_balances_all();
            
            if($dt['code'] == '1'){

                foreach($dt['info'] as $k=>$v){
                    $json['info'][$v['gametype']] = $v['gamebalance'];
                }

                $json['code'] = $dt['code'];

            }else{

                $json = $dt;

            }
         }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 取回特定帳號單一遊戲的餘額
    **/
    public function gamebalance($game_type){

        $json = array();

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'Game/balance';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code,
                           'gameType'       => $game_type
                          );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

         }else{

            $json['code'] = 0;
            $json['info'] = __('msg.bal_reback_err');

        }

        return $json;

    }
    /**
    * 取回進入遊戲的連結
    * $gametype : 遊戲平台
    * $playtype : 電子類的遊戲gamecode，其它類的遊戲大類(DZ-電子，CP-彩票，TY-體育，SX-視訊，QP-棋牌，或者一些特殊遊戲需要傳值)
    * $homeurl : 網站首頁
    * $lobbyurl : 網站大廳
    * $depositurl : 網站存款頁面
    * $withdrawurl : 網站取款頁面
    * $transferurl : 不明url
    * $usercenterurl : 不明url
    **/
    public function game_play($game_type, $play_type, $home_url, $lobby_url, $deposit_url, $withdraw_url, $transfer_url, $usercenter_url){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'Game/play';

            $url = Share_md::combinedUrl($act);

            $home_url = urldecode($home_url);
            $lobby_url = urldecode($lobby_url);
            $deposit_url = urldecode($deposit_url);
            $withdraw_url = urldecode($withdraw_url);
            $transfer_url = urldecode($transfer_url);
            $usercenter_url = urldecode($usercenter_url);
            $agent_type = 'PC';

            if(session('model_type') != 'md_5_0_002_mobile'){
                if(strpos(session('model_type'), '_mobile') !== false){
                    $agent_type = 'h5';
                }
            }else{
                $bln_mobile = Share_md::isMobile();

                if($bln_mobile){
                    $agent_type = 'h5';
                }else{
                    $agent_type = 'PC';
                }
            }

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code,
                           'gametype'       => $game_type,
                           'playtype'       => $play_type,
                           'homeurl'        => $home_url,
                           'lobbyurl'       => $lobby_url,
                           'depositurl'     => $deposit_url,
                           'withdrawurl'    => $withdraw_url,
                           'transferurl'    => $transfer_url,
                           'usercenterurl'  => $usercenter_url,
                           'device'         => $agent_type
                          );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 獲取企業品牌下遊戲列表
    **/
    public function ebrandgame(){

        $act = 'EnterpriseBrand/EBrandGame';

        $url = Share_md::combinedUrl($act);

        $param = array(
                       'enterprisecode' => session('enterprisecode'),
                       'brandcode'      => session('brandcode')
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        return $json;

    }
    /**
    * 可用的遊戲列表
    **/
    public function ebrandgame_all(){

        $act = 'GRecords/BrandGameAll';

        $url = Share_md::combinedUrl($act);

        $param = array(
                       'enterprisecode' => session('enterprisecode'),
                       'brandcode'      => session('brandcode')
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        return $json;

    }
    /**
    * 遊戲紀錄
    * $start : 起始筆數
    * $limit : 取得筆數
    * $game_platform : 遊戲類型
    * $game_big_type : 遊戲大類
    * $start_date : 開始日期
    * $end_date : 結束日期
    * $only_win : 只看贏的數據
    **/
    public function records_all($start, $limit, $game_platform = '', $game_big_type = '', $start_date = '', $end_date = '', $only_win = ''){
        //時間格式yyyy-MM-dd HH:mm:ss
        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'GRecords/RecordsAll';

            $url = Share_md::combinedUrl($act);

            $param = array(
                       'enterprisecode' => session('enterprisecode'),
                       'brandcode'      => session('brandcode'),
                       'employeecode'   => $employee_code,
                       'start'          => $start,
                       'limit'          => $limit
                      );

            //非必填部份參數
            if($game_platform != '' && $game_platform != 'nodata'){
                $param['gamePlatform'] = $game_platform;
            }
            if($game_big_type != '' && $game_big_type != 'nodata'){
                $param['gameBigType'] = $game_big_type;
            }
            if($start_date != '' && $start_date != 'nodata'){
                $param['startDate'] = $start_date;
            }
            if($end_date != '' && $end_date != 'nodata'){
                $param['endDate'] = $end_date;
            }
            if($only_win != '' && $only_win != '0'){
                $param['onlyWin'] = $only_win;
            }

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 遊戲紀錄_詳細資料
    * $start : 起始筆數
    * $limit : 取得筆數
    * $game_type : 遊戲平台
    * $start_date : 開始日期
    * $end_date : 結束日期
    **/
    public function records($start, $limit, $game_type = '', $start_date = '', $end_date = ''){
        //時間格式yyyy-MM-dd HH:mm:ss
        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'GRecords/Records';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code,
                           'start'          => $start,
                           'limit'          => $limit
                           );

            //非必填部份參數
            if($game_type != '' && $game_type != 'nodata'){
                $param['gametype'] = $game_type;
            }
            if($start_date != '' && $start_date != 'nodata'){
                $param['startDate'] = $start_date;
            }
            if($end_date != '' && $end_date != 'nodata'){
                $param['endDate'] = $end_date;
            }

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params);

            $json = json_decode($result, true);

        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 遊戲上方
    * $game_type : 遊戲平台
    * $money : 上分金額
    **/
    public function upintegral_game($game_type, $money){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtnData = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));
        
            if($rtnData['info'] == session('login_token')){

                $act = 'Game/upIntegralGame';

                $url = Share_md::combinedUrl($act);
                
                $ip = Share_md::get_ip();

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'gametype'       => $game_type,
                               'money'          => $money,
                               'clientIp'       => $ip
                              );

                $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

                $result = Share_md::curl($url, $params, true);

                $json = json_decode($result, true);

            }else{

                self::user_logout();

                $json['code'] = 0;            
                $json['info'] = __('msg.other_place_login');
                
            }
        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 遊戲下分
    * $game_type : 遊戲平台
    * $money : 下分金額
    **/
    public function downintegral_game($game_type, $money){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtnData = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtnData['info'] == session('login_token')){
                
                $act = 'Game/downIntegralGame';

                $url = Share_md::combinedUrl($act);

                $ip = Share_md::get_ip();

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'gametype'       => $game_type,
                               'money'          => $money,
                               'clientIp'       => $ip
                              );

                $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

                $result = Share_md::curl($url, $params, true);

                $json = json_decode($result, true);

            }else{

                self::user_logout();

                $json['code'] = 0;            
                $json['info'] = __('msg.other_place_login');
                
            }
        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 一鍵轉出
    **/
    public function downintegral_all_game(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtnData = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtnData['info'] == session('login_token')){
                
                $act = 'Game/downIntegralAllGame';

                $url = Share_md::combinedUrl($act);

                $param = array(
                                'enterprisecode' => session('enterprisecode'),
                                'brandcode'      => session('brandcode'),
                                'employeecode'   => $employee_code
                              );

                $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

                $result = Share_md::curl($url, $params, true);

                $json = json_decode($result, true);

            }else{

                self::user_logout();

                $json['code'] = 0;
                $json['info'] = __('msg.other_place_login');
                
            }
        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 取回遊戲狀態
    * $game_type : 遊戲平台
    **/
    public function game_status($game_type){

        $act = 'Game/gamestatus';

        $url = Share_md::combinedUrl($act);

        $param = array(
                       'enterprisecode' => session('enterprisecode'),
                       'brandcode'      => session('brandcode'),
                       'gameType'       => $game_type
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        return $json;

    }
    /**
    * 登出動作
    **/
    public function user_logout(){

        session()->forget('login_acc');
        session()->forget('login_eid');
        session()->forget('login_nick');
        session()->forget('login_token');

        session()->regenerate();
        session()->save();

    }
    /**
    * 驗證token動作(判斷是否為同一個地方登入)
    **/
    public function chk_token(){

        $json = array();

        $json['code'] = 1;
        $json['info'] = '';

        $rtnData = Basic_md::call_token_sp('chk_token', session('login_eid'), session('enterprisecode'));

        if($rtnData['info'] != session('login_token')){

            self::user_logout();
            $json['code'] = 0;
            $json['info'] = __('msg.other_place_login');

        }

        return $json;

    }

}
