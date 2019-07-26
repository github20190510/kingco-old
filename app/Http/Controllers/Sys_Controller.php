<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic_md;
use App\Share_md;
use App;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class Sys_Controller extends Controller
{
    /**
    * 沒帶任何動作要顯示錯誤資料
    **/
    public function index(){

        Share_md::error_action('Sys_Controller@index', 'no active!');

    }
    /**
    * 查看系統相關資訊用
    **/
    public function info_page(){

        phpinfo();

    }
    /**
    * 網頁顯示部份
    **/
    public function show_view(Request $request){

        //判斷有沒有傳入參數，要拆掉
        $has_params = false;
        $params = array();
        $path = $request->path();

        if($request->route('aid')){
            $has_params = true;
            $params['aid'] = $request->route('aid');
        }

        if($has_params == true){
            $act = str_replace('/' . $request->route('aid'), '', str_replace('system/', '', $path));
        }else{
            $act = str_replace('system/', '', $path);
        }

        $view_data = Basic_md::get_sys_page($act);
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
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'mb_head_name'=>$view_data['mb_head_name'], 'footer_name'=>$view_data['footer_name'], 'lang'=>$lang, 'params'=>$params));

    }
    /**
    * 獲取所有網站標示
    **/
    public function take_all_domain_config(){

    	$act = 'Domain/TakeAllDomainConfig';

    	$url = Share_md::combinedUrl($act);

	    $params = array('enterprisecode' => session('enterprisecode'));

	    $result = Share_md::curl($url, $params, true);

	    $json = json_decode($result, true);
	    
        return $json;

    }
    /**
    * 獲取系統公告
    * $start : 開始的筆數(預設為0)
    * $limit : 取回的總筆數(預設10筆)
    **/
    public function notic($start = 0, $limit = 10){

    	$act = 'Notic/Notic';

    	$url = Share_md::combinedUrl($act);

        $param = array(
                        'enterprisecode' => session('enterprisecode'),
                        'brandcode'      => session('brandcode'),
                        'start'          => $start,
                        'limit'          => $limit
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);
        
        return $json;

    }
    /**
    * 企業聯絡方式
    **/
    public function contact(){

        $act = 'Domain/Contact';

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
    * 獲取手機驗證碼(暫無使用)
    * $phoneno : 手機號
    **/
    public function get_verifcode($phoneno){
        
        //phoneno = 15605403054
        $act = 'User/getVerifycode';

        $url = Share_md::combinedUrl($act);

        $ip = Share_md::get_ip();

        $param = array(
                        'enterprisecode' => session('enterprisecode'),
                        'brandcode'      => session('brandcode'),
                        'phoneno'        => $phoneno,
                        'ip'             => $ip
                       );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);

        return $json;

    }
    /**
    * 獲取品牌廣告圖
    * $btype : banner類型(PC or H5)
    **/
    public function get_banner($btype){

        $act = 'EnterpriseBrand/banner';

        $url = Share_md::combinedUrl($act);

        $param = array(
                        'enterprisecode' => session('enterprisecode'),
                        'brandcode'      => session('brandcode'),
                        'bannertype'     => $btype
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);
        
        return $json;

    }
    /**
    * 獲取線下支付-支付寶個及微信
    *qrtype: 二維碼類型，1-微信、2-支付寶[選填]
    *status: 二維碼狀態，1-啟用、0-禁用[前端查詢請一定傳1]
    **/
    public function get_aliwepays($qrtype=0,$status=1){

        $act = 'TPayment/EQrcodes';

        $url = Share_md::combinedUrl($act);
        if ($qrtype != "alltype"){
            $param = array(
                'enterprisecode' => session('enterprisecode'),
                'qrtype'         => $qrtype,
                'status'         => $status
            );
        }else{
            $param = array(
                'enterprisecode' => session('enterprisecode'),
                'status'         => $status
            );
        }
        

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);
        
        return $json;

    }
    /**
    * 獲取收款銀行
    **/
    public function ebankcards(){

        $act = 'Funds/EBankCards';

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
    * 獲取企業第三方支付
    * $type : 支付類型(PC or H5)
    **/
    public function get_ethirdpartys($type = 'PC'){

        $act = 'TPayment/EThirdpartys';

        $url = Share_md::combinedUrl($act);

        $param = array(
                        'enterprisecode' => session('enterprisecode'),
                        'brandcode'      => session('brandcode'),
                        'type'           => $type
                      );

        $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);
        
        $rtn_data = array();        

        $inti = 0;
        
        foreach($json['info'] as $k=>$v){
            foreach($v['banks']as $kk=>$vv){

                $vv['enterprisethirdpartycode'] = $v['enterprisethirdpartycode'];
                $vv['minmoney'] = $v['minmoney'];
                $vv['maxmoney'] = $v['maxmoney'];
                //這個bank_name是測試用的，顯示在支付列表，為了區別是什麼支付，等到正式上線後可移除(view的部份也需移除)
                $vv['bank_name'] = mb_substr($v['thirdpartypaymenttypename'], 0, 2, "utf-8");

                $rtn_data['info'][$vv['paymenttypebankcode']][] = $vv;

                $inti++;
            }            
        }

        $rtn_data['cnt'] = $inti;

        return $rtn_data;

    }
    /**
    * 進入付款頁
    * $amount : 金額
    * $thirdparty_code : 企業第三方支付編碼
    * $payment_bank_code : 第三方支付銀行編碼
    * $bank_code : 銀行編碼
    **/
    public function into_payment($amount, $thirdparty_code, $payment_bank_code, $bank_code){

        $view_data = Basic_md::get_sys_page('into_payment');

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
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'eid'=>session('login_eid'), 'amount'=>$amount, 'thirdpartycode'=>$thirdparty_code, 'paymenttypebankcode'=>$payment_bank_code, 'bankcode'=>$bank_code, 'lang'=>$lang));

    }
    /**
    * 進入付款頁
    * $amount : 金額
    * $thirdparty_code : 企業第三方支付編碼
    * $payment_bank_code : 第三方支付銀行編碼
    * $bank_code : 銀行編碼
    **/
    public function show_payment($amount, $enterprise_information_code){

        $view_data = Basic_md::get_sys_page('show_payment');

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
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'eid'=>session('login_eid'), 'amount'=>$amount, 'ent_code'=>$enterprise_information_code, 'lang'=>$lang));

    }
    /**
    * 進入付款頁
    * $amount : 金額
    * $thirdparty_code : 企業第三方支付編碼
    * $payment_bank_code : 第三方支付銀行編碼
    * $bank_code : 銀行編碼
    **/
    public function offline_payment($amount,$qrtype,$offline_account){

        $view_data = Basic_md::get_sys_page('offline_payment');

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
        return view($view_data['view_url'], array('header_name'=>$view_data['header_name'], 'head_name'=>$view_data['head_name'], 'footer_name'=>$view_data['footer_name'], 'eid'=>session('login_eid'), 'amount'=>$amount, 'qrtype'=>$qrtype, 'offline_account'=>$offline_account, 'lang'=>$lang));

    }
    /**
    * 獲取收款銀行
    * $amount : 金額
    * $thirdparty_code : 企業第三方支付編碼
    * $payment_bank_code : 第三方支付銀行編碼
    * $bank_code : 銀行編碼
    **/
    public function esaving($amount, $thirdparty_code, $payment_bank_code, $bank_code){

        $employee_code = Share_md::get_employee_code();

        if($employee_code != ''){

           $act = 'TPayment/ESaving';

            $url = Share_md::combinedUrl($act);

            $ip = Share_md::get_ip();

            $param = array(
                            'enterprisecode'           => session('enterprisecode'),
                            'brandcode'                => session('brandcode'),
                            'employeecode'             => $employee_code,
                            'orderamount'              => $amount,
                            'enterprisethirdpartycode' => $thirdparty_code,
                            'paymenttypebankcode'      => $payment_bank_code,
                            'traceip'                  => $ip,
                            'bankcode'                 => $bank_code
                          );

            $params = Share_md::data_encode($param, session('new_md5_key'), session('new_aes_key'), 'AES-128-ECB', OPENSSL_RAW_DATA);

            if(is_array($params)){
                $params = http_build_query($params);
            }

            $json['code'] = '1';
            $json['info'] = $url . '?' . $params;

         }else{

            $json['code'] = 0;
            $json['info'] = __('msg.data_err');

        }

        return $json;

    }
    /**
    * 獲取銀行資料
    **/
    public function banks(){

        $act = 'Funds/Banks';

        $url = Share_md::combinedUrl($act);

       
        $params = array(
                        'enterprisecode' => session('enterprisecode'),
                        'brandcode'      => session('brandcode')
                       );

        $result = Share_md::curl($url, $params, true);

        $json = json_decode($result, true);
       
        return $json;

    }
    //change model session
    public function change_model($model_type){

        session()->forget('model_type');
        session()->forget('sign');
        session()->save();

        session()->put('sign', $model_type);
        session()->put('model_type', $model_type);
        session()->save();

        return '1';

    }
    /**
    * 進入IDC彩票後台
    **/
    public function into_idc_manage($web_site_id, $web_site_key){

        //$web_site_id = 'dtapi';
        //$web_site_key = '@#$dt888%&*';
        $ip = Share_md::get_ip();

        if($ip == '114.35.87.71' || $ip == '60.249.186.121' || $ip == '60.249.186.122' || $ip == '60.249.186.123' || $ip == '60.249.186.124'){

            $url = 'http://01xudgw.yzcx928.com/API_CP_03_WS/';

            $param = md5(date('ymj').$web_site_id.urldecode($web_site_key));

            $rtn_data = Share_md::curl($url.'?op=Login&WebsiteId='.$web_site_id.'&Key='.$param.'&MemberId='.$web_site_id.'&Jump=1', '', true);

            $json_data = json_decode($rtn_data, true);

            if($json_data['ErrorCode'] == 0){

                header('Location:'.$json_data['Data']['WebUrl']);

            }else{
                
                echo 'Data Error!';

            }

        }else{

            echo 'Data Error!';

        }

    }
    /**
    * 產生game_list資料
    * $game_data_name : 列表的陣列名稱(例如cq9_game_data)
    * $game_corp_name : 遊戲平台名稱(例如cq9)
    * $file_name : 輸出檔案名稱(不需副檔名)
    * $game_tech : 遊戲類型(例如h5，如為nodata則為空)
    **/
    /*public function create_game_list($game_data_name, $game_corp_name, $file_name, $game_tech){

        if($game_data_name == '' || $game_corp_name == '' || $file_name == '' || $game_tech == ''){
            echo 'data error!';
            die();
        }

        if($game_tech == 'nodata'){
            $game_tech = '';
        }

        if(file_exists(storage_path().'/app/list.xlsx')){

            $excel_data = Excel::toArray(new UsersImport, 'list.xlsx');
            $intCount = count($excel_data[0]) - 1;

            $strPrint = '{'."\n";
            $strPrint .= '  "'.$game_data_name.'": ['."\n";

            //列印每一行的資料
            foreach($excel_data[0] as $key => $col)
            {
                if($key != '0' && $col[0] != ''){
                    $strPrint .= '      {'."\n";
                    $strPrint .= '          "gamehall": "'.$game_corp_name.'",'."\n";
                    $strPrint .= '          "gametype": "'.$col[4].'",'."\n";
                    $strPrint .= '          "gamecode": "'.$col[0].'",'."\n";
                    $strPrint .= '          "gamename": "'.$col[1].'",'."\n";
                    $strPrint .= '          "gametech": "'.$game_tech.'",'."\n";
                    $strPrint .= '          "gameplat": "web",'."\n";
                    $strPrint .= '          "lang": ['."\n";
                    $strPrint .= '              "en",'."\n";
                    $strPrint .= '              "zh_tw",'."\n";
                    $strPrint .= '              "zh_cn"'."\n";
                    $strPrint .= '          ],'."\n";
                    $strPrint .= '          "status": '.($col[5] == 'Y' ? "true" : "false").','."\n";
                    $strPrint .= '          "maintain": false,'."\n";
                    $strPrint .= '          "nameset": ['."\n";
                    $strPrint .= '              {'."\n";
                    $strPrint .= '                  "name": "'.$col[1].'",'."\n";
                    $strPrint .= '                  "lang": "en"'."\n";
                    $strPrint .= '              },'."\n";
                    $strPrint .= '              {'."\n";
                    $strPrint .= '                  "name": "'.$col[2].'",'."\n";
                    $strPrint .= '                  "lang": "zh_tw"'."\n";
                    $strPrint .= '              },'."\n";
                    $strPrint .= '              {'."\n";
                    $strPrint .= '                  "name": "'.$col[3].'",'."\n";
                    $strPrint .= '                  "lang": "zh_cn"'."\n";
                    $strPrint .= '              }'."\n";
                    $strPrint .= '          ]'."\n";
                    if($key != $intCount){
                        $strPrint .= '      },'."\n";
                    }else{
                        $strPrint .= '      }'."\n";
                    }
                    
                }
            }

            $strPrint .= '   ]'."\n";
            $strPrint .= '}';

            file_put_contents(public_path() . '/js/games/'.$file_name.'.js', $strPrint);

            shell_exec('chmod 775 '.public_path() . '/js/games/'.$file_name.'.js');

            echo 'ok';

        }else{
            echo 'no file!';
        }
        
    }*/

}
