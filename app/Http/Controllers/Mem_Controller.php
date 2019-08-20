<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Basic_md;
use App\Share_md;
use Cookie;
use App;

class Mem_Controller extends Controller
{
    /**
    * 沒帶任何動作要顯示錯誤資料
    **/
    public function index($act = ''){

        Share_md::error_action('Member_Controller@index', 'no active!');

    }
    /**
    * 網頁顯示部份
    **/
    public function show_view(Request $request){

        $path = $request->path();

        $act = str_replace('mb/', '', $path);

        $view_data = Basic_md::get_mb_page($act, 'mb');

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

        $sharePrefix = Basic_md::get_share_css_prefix();

        //傳入的lang是做為載入不同css的依據
        return view($view_data['view_url'], array('key'=>$act, 'header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'mb_info_head'=>$view_data['mb_info_head'], 'mb_head_name'=>$view_data['mb_head_name'], 'mb_info_left'=>$view_data['mb_info_left'], 'lang'=>$lang, 'sharePrefix' => $sharePrefix));
    }
    /**
    * 進入登入頁(帶參數)
    * $gid : 遊戲平台
    * $gtype : 電子類的遊戲gamecode，其它類的遊戲大類(DZ-電子，CP-彩票，TY-體育，SX-視訊，QP-棋牌，或者一些特殊遊戲需要傳值)
    **/
    //進入登入頁(帶參數)
    public function into_login_page($gid = '', $gtype = ''){

        $view_data = Basic_md::get_mb_page('into_login_page', '');

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

        $sharePrefix = Basic_md::get_share_css_prefix();

        //傳入的lang是做為載入不同css的依據
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'gid'=>$gid, 'gtype'=>$gtype, 'lang'=>$lang, 'sharePrefix' => $sharePrefix));

    }
    /**
    * 會員註冊
    * $acc : 帳號
    * $pwd : 密碼
    * $mpwd : 確認密碼
    * $alias : 暱稱 目前韓總那邊將此欄位定義成 真實姓名
    * $browser_data : 瀏覽器資訊
    * $os_data : 作業系統資訊
    **/
    public function user_register($acc, $pwd, $mpwd, $alias, $browser_data, $os_data){

        if($pwd == $mpwd){

            $act = 'User/register';

            $url = Share_md::combinedUrl($act);

            $ip = Share_md::get_ip();

            if(request()->getHttpHost() == '127.0.0.1:8000' || request()->getHttpHost() == 'localhost:82'){
                //例外
                if(config('api_link_data.domain') !== null){
                    $domain = config('api_link_data.domain');
                }else{
                    Share_md::error_action('take_enterprise_config', 'Get Config Error');
                }
            }else{
                $domain = request()->getHttpHost();
            }

            $finger_data = md5($ip.$browser_data.$os_data);

            $param = array(
                           'enterprisecode'  => session('enterprisecode'),
                           'brandcode'       => session('brandcode'),
                           'loginaccount'    => $acc,
                           'loginpassword'   => $pwd,
                           'fundpassword'    => $pwd,
                           'displayalias'    => $alias,
                           'domain'          => $domain,
                           'ip'              => $ip,
                           'fingerprintcode' => $finger_data
                           );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            $result = Share_md::curl($url, $params, true);

            $json = json_decode($result, true);

        }else{

            $json['code'] = 0;
            $json['info'] = __('msg.pwd_dif_err');;

        }

        return $json;

    }
    /**
    * 登入
    * $acc : 帳號
    * $pwd : 密碼
    * $browser_data : 瀏覽器資訊
    * $os_data : 作業系統資訊
    **/
    public function user_login($acc, $pwd, $browser_data, $os_data, Request $request){

        $act = 'User/login';

        $url = Share_md::combinedUrl($act);

        $ip = Share_md::get_ip();

        $param = array(
                       'enterprisecode' => session('enterprisecode'),
                       'brandcode'      => session('brandcode'),
                       'loginaccount'   => $acc,
                       'loginpassword'  => $pwd,
                       'loginip'        => $ip,
                       'browserversion' => $browser_data,
                       'opratesystem'   => $os_data
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);
        
        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        if($json['code'] == '1'){
            //如果取回值正確，將值塞入SESSION
            $rtnData = Basic_md::call_token_sp('login', $json['info']['employeecode'], session('enterprisecode'));

            if($rtnData['code'] == '1'){

                session()->put('login_acc', $json['info']['loginaccount']);
                session()->put('login_eid', $json['info']['employeecode']);
                session()->put('login_nick', $json['info']['displayalias']);
                session()->put('login_token', $rtnData['info']);
                session()->save();

            }else{

                $json['code'] = 0;
                $json['info'] = __('msg.data_err');

            }

        }

        return $json;

    }
    /**
    * 設定登入的cookie，自動登入功能
    * $acc : 登入帳號
    * $pwd : 登入密碼
    **/
    public function set_login_cookie($acc = '', $pwd = '', Request $request){

        $response = new Response();

        if($acc != '' && $pwd != ''){

            $response->withCookie(cookie('login_acc', $acc, 1493791460));
            $response->withCookie(cookie('login_pwd', $pwd, 1493791460));

        }

        return $response;

    }
    /**
    * 取得自動登入功能cookie
    **/
    public function get_login_cookie(Request $request){

        $rtn_data = array();

        $rtn_data['login_acc'] = $request->cookie('login_acc');
        $rtn_data['login_pwd'] = $request->cookie('login_pwd');

        return $rtn_data;

    }
    /**
    * 清除自動登入功能cookie
    **/
    public function del_login_cookie(Request $request){

        $response = new Response();

        Cookie::queue(Cookie::forget('login_acc'));
        Cookie::queue(Cookie::forget('login_pwd'));

        return $response;

    }
    /**
    * 判斷目前登入狀態
    * $browser_data : 瀏覽器資訊
    * $os_data : 作業系統資訊
    **/
    public function chk_user_session($browser_data, $os_data, Request $request){

        if(session('login_acc') == '' || session('login_eid') == ''){
            //有任一個SESSION為空表示沒登入
            //如果有COOKIE，則自動幫他登入
            $arrCookie = self::get_login_cookie($request);

            if($arrCookie['login_acc'] != null && $arrCookie['login_pwd'] != null){

                $rtn_data = self::user_login($arrCookie['login_acc'], $arrCookie['login_pwd'], $browser_data, $os_data, 0, 'original', $request);

                if($rtn_data['code'] != '1'){
                    $json['code'] = 2;
                    $json['info'] = $rtn_data['info'];
                }else{
                    $json['code'] = 1;
                    $json['info']['acc'] = session('login_acc');
                    $json['info']['nick'] = session('login_nick');
                    $json['info']['eid'] = session('login_eid');
                }
            }else{
                $json['code'] = 0;
                $json['info'] = array();
            }
            
        }else{
            //如果是登入狀態，要判斷是否有其它地方登入
            $rtn_data = Basic_md::call_token_sp('chk_token', session('login_eid'), session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $json['code'] = 1;
                $json['info']['acc'] = session('login_acc');
                $json['info']['nick'] = session('login_nick');
                $json['info']['eid'] = session('login_eid');

            }else{
                
                $logout_data = self::user_logout();

                if($logout_data['code'] == 1){
                    $json['code'] = 3;
                    $json['info'] = __('msg.other_place_login');
                }

            }
        }

        return $json;

    }
    /**
    * 登出功能
    **/
    public function user_logout(){

        $rtn_arr = array('code' => 0);

        session()->forget('login_acc');
        session()->forget('login_eid');
        session()->forget('login_nick');
        session()->forget('login_token');
        //重新生成session id
        session()->regenerate();
        session()->save();

        $rtn_arr['code'] = 1;

        return $rtn_arr;

    }
    /**
    * 修改登錄密碼
    * $old_pwd : 舊密碼
    * $new_pwd : 新密碼
    **/
    public function update_pwd($old_pwd, $new_pwd){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'User/updatepwd';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode'   => session('enterprisecode'),
                           'brandcode'        => session('brandcode'),
                           'employeecode'     => $employee_code,
                           'oldloginpassword' => $old_pwd,
                           'newloginpassword' => $new_pwd
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
    * 修改資金密碼
    * $old_pwd : 舊密碼
    * $new_pwd : 新密碼
    **/
    public function update_fpwd($old_pwd, $new_pwd){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'User/updatefpwd';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode'   => session('enterprisecode'),
                           'brandcode'        => session('brandcode'),
                           'employeecode'     => $employee_code,
                           'oldfundpassword' => $old_pwd,
                           'newfundpassword' => $new_pwd
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
    * 取得會員資料
    **/
    public function take_employee(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'User/takeEmployee';

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
    * 用戶未讀站內信數量
    **/
    public function message_count(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'UserMessage/MessageCount';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           //'brandcode'      => session('brandcode'), 20190418 拔掉此參數才能正常取得訊息
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
    * 取回系統訊息
    * $start : 開始筆數
    * $limit : 取回筆數
    * $start_date : 開始日期
    * $end_date : 結束日期
    * $read_status : 讀取狀態
    **/
    public function sys_message($start, $limit, $start_date = 'nodata', $end_date = 'nodata', $read_status = 'nodata'){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'UserMessage/SysMessage';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           //'brandcode'      => session('brandcode'),20190418 拔掉此參數才能正常取得訊息
                           'employeecode'   => $employee_code,
                           'start'          => $start,
                           'limit'          => $limit
                          );

            if($start_date != '' && $start_date != 'nodata'){
                $param['startDate'] = $start_date;
            }

            if($end_date != '' && $end_date != 'nodata'){
                $param['endDate'] = $end_date;
            }

            if($read_status != '' && $read_status != 'nodata'){
                $param['readstatus'] = $read_status;
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
    * 訊息標註為已讀取
    * $msg_no : 訊息編號
    **/
    public function upd_system_message($msg_no){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'UserMessage/updateSysMessage';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code,
                           'messagecode'    => $msg_no
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
    * 更新會員資料
    * $email : email
    * $qq : qq號
    * wechat : 微信號
    * $line : line帳號
    * $skype : skype帳號
    * $phone_num : 電話號碼(要搭配驗證碼，目前暫無使用)
    * $verify_code : 手機驗證碼(目前暫無使用)
    **/
    public function update_info($rname, $email, $qq, $wechat, $line, $skype, $phone_num = '', $verify_code = ''){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            if($email == 'nodata'){
                $email = '';
            }

            if($phone_num == 'nodata'){
                $phone_num = '';
            }


            $act = 'User/updateInfo';

            $url = Share_md::combinedUrl($act);

            $param = array(
                           'enterprisecode' => session('enterprisecode'),
                           'brandcode'      => session('brandcode'),
                           'employeecode'   => $employee_code,
                           'email'          => $email,
                           'phoneno'        => $phone_num
                          );

            //非必填部份參數
            if($rname != '' && $rname != 'nodata'){
                $param['displayalias'] = $rname;
            }
            if($qq != '' && $qq != 'nodata'){
                $param['qq'] = $qq;
            }
            if($wechat != '' && $wechat != 'nodata'){
                $param['wechat'] = $wechat;
            }
            if($line != '' && $line != 'nodata'){
                $param['line'] = $line;
            }
            if($skype != '' && $skype != 'nodata'){
                $param['skype'] = $skype;
            }
            if($verify_code != '' && $verify_code != 'nodata'){
                $param['verifycode'] = $verify_code;
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
    * 添加用戶銀行卡
    * $payment_account : 銀行帳戶卡號
    * $account_name : 銀行帳戶名稱
    * $openning_bank : 銀行名稱 實際上韓總那邊 是將這個欄位改成"支行名稱"
    * $bank_code : 銀行編碼
    * $fund_password : 會員資金密碼
    **/
    public function add_ubankcard($payment_account, $account_name, $openning_bank, $bank_code, $fund_password){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/AddUBankCard';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'paymentaccount' => $payment_account,
                               'accountname'    => $account_name,
                               'openningbank'   => $openning_bank,
                               'bankcode'       => $bank_code,
                               'fundpassword'   => $fund_password
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
    * 編輯用戶銀行卡
    * $information_code : 銀行卡id
    * $fund_password : 會員資金密碼
    * $payment_account : 銀行帳戶卡號
    * $account_name : 銀行帳戶名稱
    * $openning_bank : 銀行名稱
    * $bank_code : 銀行編碼
    * $qq : qq號
    * $skype : skype帳號
    * $email : email
    **/
    public function edit_ubankcard($information_code, $fund_password, $payment_account, $account_name, $openning_bank, $bank_code, $qq = '', $skype = '', $email = ''){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/EditUBankCard';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode'  => session('enterprisecode'),
                               'brandcode'       => session('brandcode'),
                               'employeecode'    => $employee_code,
                               'informationcode' => $information_code,
                               'fundpassword'    => $fund_password,
                               'paymentaccount'  => $payment_account,
                               'accountname'     => $account_name,
                               'openningbank'    => $openning_bank,
                               'bankcode'        => $bank_code);

                if($qq != '' && $qq != 'nodata'){
                    $param['qq'] = $qq;
                }
                if($skype != '' && $skype != 'nodata'){
                    $param['skype'] = $skype;
                }
                if($email != '' && $email != 'nodata'){
                    $param['email'] = $email;
                }

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
    * 刪除用戶銀行卡
    * $information_code : 銀行卡id
    * $fund_password : 會員資金密碼
    **/
    public function delete_ubankcard($information_code, $fund_password){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/DeleteUBankCard';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode'  => session('enterprisecode'),
                               'brandcode'       => session('brandcode'),
                               'employeecode'    => $employee_code,
                               'informationcode' => $information_code,
                               'fundpassword'    => $fund_password
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
    * 查詢用戶銀行卡
    **/
    public function ubankcards(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $act = 'User/UBankCards';

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
    * 設置默認銀行卡
    * $information_code : 銀行卡id
    **/
    public function default_ubankcard($information_code){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/DefaultUBankCard';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode'  => session('enterprisecode'),
                               'brandcode'       => session('brandcode'),
                               'employeecode'    => $employee_code,
                               'informationcode' => $information_code
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
    * 用戶取款
    * $order_amount : 取款金額
    * $order_comment : 用戶留言
    * $information_code : 銀行卡id
    * $fund_password : 資金密碼
    **/
    public function taking_money($order_amount, $order_comment, $information_code, $fund_password){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'Funds/Taking';

                $url = Share_md::combinedUrl($act);

                $ip = Share_md::get_ip();

                $param = array(
                               'enterprisecode'  => session('enterprisecode'),
                               'brandcode'       => session('brandcode'),
                               'employeecode'    => $employee_code,
                               'orderamount'     => $order_amount,
                               'informationcode' => $information_code,
                               'traceip'         => $ip,
                               'fundpassword'    => $fund_password
                              );

                if($order_comment != '' && $order_comment != 'nodata'){
                    $param['ordercomment'] = $order_comment;
                }

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
    * 用戶入款
    * $order_amount : 取款金額
    * $order_comment : 用戶留言
    * $enterpriseinformationcode : 企業信息編碼(銀行卡id)
    * $employeepaymentbank : 支付用的銀行編碼
    * $employeepaymentaccount : 賬戶卡號
    * $employeepaymentname : 賬戶名稱
    * $ordercomment : 用戶留言
    **/
    public function saving_money($order_amount, $order_comment, $enterprise_information_code, $employee_payment_bank, $employee_payment_account, $employee_payment_name){

        $employee_code = Share_md::get_employee_code();
        // 判斷用戶在使用線下入款時 是否有綁定銀行卡
        $check_if_bind_bank_card = self::ubankcards();
        if ($check_if_bind_bank_card['code'] != 1){
            $json['code'] = 0;
            $json['info'] = __('msg.get_bank_card_error');
            return $json;
        }else{
            if (count($check_if_bind_bank_card['info']) == 0){
                $json['code'] = 2;
                $json['info'] = __('msg.please_bind_bank_card_first');
                return $json;
            }
        }
        // end 判斷用戶在使用線下入款時 是否有綁定銀行卡
        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'Funds/Saving';

                $url = Share_md::combinedUrl($act);

                $ip = Share_md::get_ip();
                
                $param = array(
                               'enterprisecode'             => session('enterprisecode'),
                               'brandcode'                  => session('brandcode'),
                               'employeecode'               => $employee_code,
                               'orderamount'                => $order_amount,
                               'enterpriseinformationcode'  => $enterprise_information_code,
                               'employeepaymentbank'        => $employee_payment_bank,
                               'employeepaymentaccount'     => $employee_payment_account,
                               'employeepaymentname'        => $employee_payment_name,
                               'traceip'                    => $ip
                              );

                if($order_comment != '' && $order_comment != 'nodata'){
                    $param['ordercomment'] = $order_comment;
                }
               
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
    * 存款紀錄
    * $order_status : 訂單狀態(1-處理中，2-已處理，3-駁回，4-拒絕，5-待出款)
    * $start : 起始索引
    * $limit : 取回筆數
    * $start_date : 紀錄開始日期
    * $end_date : 紀錄結束日期
    **/
    public function save_order($order_status, $start, $limit, $start_date, $end_date){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'Fetch/SaveOrder';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'start'          => $start,
                               'limit'          => $limit
                              );

                if($order_status != '' && $order_status != 'nodata'){
                    $param['orderstatus'] = $order_status;
                }

                if($start_date != '' && $start_date != 'nodata'){
                    $param['orderdate_begin'] = $start_date;
                }

                if($end_date != '' && $end_date != 'nodata'){
                    $param['orderdate_end'] = $end_date;
                }

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
    * 取款紀錄
    * $order_status : 訂單狀態(1-處理中，2-已處理，3-駁回，4-拒絕，5-待出款)
    * $start : 起始索引
    * $limit : 取回筆數
    * $start_date : 紀錄開始日期
    * $end_date : 紀錄結束日期
    **/
    public function take_order($order_status, $start, $limit, $start_date, $end_date){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'Fetch/TakeOrder';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'start'          => $start,
                               'limit'          => $limit
                              );

                if($order_status != '' && $order_status != 'nodata'){
                    $param['orderstatus'] = $order_status;
                }

                if($start_date != '' && $start_date != 'nodata'){
                    $param['orderdate_begin'] = $start_date;
                }

                if($end_date != '' && $end_date != 'nodata'){
                    $param['orderdate_end'] = $end_date;
                }

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
    * 用戶帳變紀錄
    * $start : 起始索引
    * $limit : 取回筆數
    * $start_date : 紀錄開始日期
    * $end_date : 紀錄結束日期
    * $change_type : 帳變類型
    **/
    public function find_account_change_record($start, $limit, $start_date, $end_date, $change_type){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/findAccountChange';

                $url = Share_md::combinedUrl($act);

                $param = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code,
                               'start'          => $start,
                               'limit'          => $limit,
                               'field'          => 'moneychangedate',
                               'direction'      => 'desc'
                              );

                if($change_type != '' && $change_type != 'nodata'){
                    $param['moneychangetypecode'] = $change_type;
                }

                if($start_date != '' && $start_date != 'nodata'){
                    $param['startDate'] = $start_date;
                }

                if($end_date != '' && $end_date != 'nodata'){
                    $param['endDate'] = $end_date;
                }

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
    * 獲取優惠活動內容
    **/
    public function brand_activity_trigger(){

        $act = 'BrandActivity/trigger';

        $url = Share_md::combinedUrl($act);

        $param = array(
                       'enterprisecode'      => session('enterprisecode'),
                       'enterprisebrandcode' => session('brandcode'),
                       'way'                 => 'List'
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        return $json;

    }
    /**
    * 獲取玩家的打碼資料
    **/
    public function inspection(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'Funds/Inspection';

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
    * 線上人數，玩家登入時接口
    **/
    public function setonline(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/setOnline';

                $url = Share_md::combinedUrl($act);

                $params = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code
                              );

                //$params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

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
    * 線上人數，玩家登出時接口
    **/
    public function setoffline(){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/setOffline';

                $url = Share_md::combinedUrl($act);

                $params = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code
                              );

                //$params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

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
    * 線上人數，玩家持續在線上接口
    **/
    public function setliving(){

        $json['code'] = '1';

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

            $rtn_data = Basic_md::call_token_sp('chk_token', $employee_code, session('enterprisecode'));

            if($rtn_data['info'] == session('login_token')){

                $act = 'User/setLiving';

                $url = Share_md::combinedUrl($act);

                $params = array(
                               'enterprisecode' => session('enterprisecode'),
                               'brandcode'      => session('brandcode'),
                               'employeecode'   => $employee_code
                              );

                //$params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

                $result = Share_md::curl($url, $params, true);

                $json = json_decode($result, true);
               
            }
        }

        return $json;

    }
}
