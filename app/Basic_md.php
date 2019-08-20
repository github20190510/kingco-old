<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Share_md;
use View;
use DB;

class Basic_md extends Model
{
	/**
	* 取回網站基本資料流程
	**/
    public static function get_web_data_to_session(){

    	$rtn_data = '';

        $str_response = self::take_enterprise_config();
        if($str_response == ''){
            self::get_model_type();
            if(session('model_type') == ''){
                $str_response = 'SET MODEL FAILED!';
            }
        }

        if($str_response != ''){
           $rtn_data = $str_response;
        }
        
    	return $rtn_data;

    }
    /**
	* 取回廠商基本資料
	**/
    private static function take_enterprise_config(){

        $str_msg = '';
        //針對google ip做額外判斷
        /*$google_ip = explode(".", request()->getHttpHost());
        $google_ip_string = '';

        if(count($google_ip) > 3){
            $google_ip_string = $google_ip[0] . "." . $google_ip[1] . "." . $google_ip[2];
        }*/
        
        if(request()->getHttpHost() == '192.168.0.12:82' || request()->getHttpHost() == 'localhost:82' || request()->getHttpHost() == '192.168.0.209:82'){
            //例外
            if(config('api_link_data.domain') !== null){
                $domain = config('api_link_data.domain');
            }else{
                Share_md::error_action('take_enterprise_config', 'Get Config Error');
            }
        }else{
            $domain = request()->getHttpHost();
        }
        
        if(session('enterprisecode') == '' || session('brandcode') == ''){
            //清除原有資料
            session()->forget('enterprisecode');
            session()->forget('brandcode');
            session()->save();

            $act = 'Domain/TakeDomainConfig';
            $url = Share_md::combinedUrl($act);
            $params = array('domain' => $domain);

            $result = Share_md::curl($url, $params, true);
            $json = json_decode($result, true);
            if(isset($json['code']) && $json['code'] == '1'){
            	//取回的資料存放到session
                session()->put('enterprisecode', $json['info']['enterprisecode']);
                session()->put('brandcode', $json['info']['brandcode']);
                session()->put('sign', $json['info']['sign']);
                session()->put('domain', $domain);
                session()->save();

                $str_response = self::take_new_key();
                if($str_response != ''){
                	$str_msg = $str_response;
                }
            }else{
                $str_msg = 'GET_BASIC_CONFIG_ERROR!';
            }
        }

        return $str_msg;

    }
    /**
    * 取回新KEY
    **/
    private static function take_new_key(){
    	
        $strMsg = '';
        if(config('api_link_data.md5_key') !== null || config('api_link_data.aes_key') !== null){
            $md5key = config('api_link_data.md5_key');
            $aeskey = config('api_link_data.aes_key');
        }else{
        	//如果出錯，把相關session都清掉
        	session()->forget('enterprisecode');
            session()->forget('brandcode');
            session()->forget('sign');
            session()->forget('domain');

            Share_md::error_action('take_new_key', 'Get Config Error');
        }

        //如果有值就不需要重取
        if(session('new_md5_key') == '' && session('new_aes_key') == ''){

            $act = 'Domain/enterpriseInfo';
            $url = Share_md::combinedUrl($act);

            $param = array('enterprisecode' => session('enterprisecode'));

            $params = Share_md::data_encode($param, $md5key, $aeskey, 'AES-128-ECB', OPENSSL_RAW_DATA);
       
            $result = Share_md::curl($url, $params, true);
            $json = json_decode($result, true);
            if(isset($json['code']) && $json['code'] == '1'){
                $str_data = Share_md::aes_decode(urldecode($json['info']['params']), $aeskey, 'AES-128-ECB', OPENSSL_RAW_DATA);
                $arrData = explode('&', $str_data);
                //比對回傳值是否跟既有資料相符(避免資料中途被修改)
                if(md5($str_data.$md5key) == $json['info']['signature']){
                    $new_md5_key = $arrData[0];
                    $new_aes_key = $arrData[1];
                    //將新的KEY放到SESSSION
                    session()->put('new_md5_key', $new_md5_key);
                    session()->put('new_aes_key', $new_aes_key);
                    session()->save();
                }else{
                	//廠商驗證失敗
                    $strMsg = 'SIGNATURE ERROR!';
                }
            }else{
                $strMsg = 'GET SIGNATURE DATA ERROR!';
            }
        }

        return $strMsg;
    	
    }
    /**
    * 取回模版
    * 如果有session且session紀錄跟取回模組「不相符」，則清除原本session，再存放新的session
    * 如果有session且session紀錄跟取回模組「相符」，則跳過存放session的動作
    * 如果沒有session，則存放session
    * 判斷 如果$model_type_mobile = _mobile 且 其後面為001的版本 則直接跑最新的版本
    * 如 $model_type = md_4_0_001 且為手機版 則直接跑 md_3_0_001_mobile的版本
    **/
    public static function get_model_type(){

        $model_type = '';
        $modal_type_mobile = '';
        $bln_need_save = false;

        $bln_mobile = Share_md::isMobile();

        if($bln_mobile){
            $modal_type_mobile = '_mobile';
        }

        if(session('sign') != ''){            

            if(session('sign') == 'md_5_0_002'){
                $modal_type_mobile = '_mobile';
            }

            if (View::exists(session('sign').$modal_type_mobile.'.index')){
                $model_type = session('sign').$modal_type_mobile;
            }else{
                $model_type = 'md_2_0_001'.$modal_type_mobile;
            }
            //測試用預設版型程式
            /*if(session('sign') == 'MB2017031401' && env("APP_ENV",null) != "product"){
                $model_type = 'md_2_0_002'.$modal_type_mobile;
            }*/

            if($modal_type_mobile != ''){
                $tmp = explode('_', $model_type);
                if ($tmp[3] == "001"){
                    $model_type = 'md_3_0_'.$tmp[3].$modal_type_mobile;
                }else{
                    //$model_type = 'md_2_0_'.$tmp[3].$modal_type_mobile;
                }
            }
            //判斷是否有新版的手機版型 如果有 則預先套用新的手機版
                // if ($tmp[1] != "2"){
                //     $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
                //     $resources_path_dir = $ROOT_PATH."/../resources/views/";
                //     while (!file_exists($resources_path_dir.$model_type)) {
                //         $tmp[1]-=1;
                //         $model_type = $tmp[0]."_".$tmp[1]."_".$tmp[2]."_".$tmp[3].$modal_type_mobile;
                //         if ($tmp[1] == "2") {
                //             $model_type = 'md_2_0_'.$tmp[3].$modal_type_mobile;
                //             break;
                //         }
                //     }
                // }
            //判斷是否有新版的手機版型 如果有 則預先套用新的手機版
            if($model_type != ''){
            	if(session('model_type') !== null && session('model_type') != ''){
            		if(session('model_type') != $model_type){
            			session()->forget('model_type');
        				session()->save();
        				$bln_need_save = true;
            		}
            	}else{
            		$bln_need_save = true;
            	}

            	if($bln_need_save == true){
            		session()->put('model_type', $model_type);
	                session()->put('lang', 'zh_cn');
	                session()->save();
            	}
            }else{
                Share_md::error_action('get_model_type', 'Set Model Type Error(No Page)');
            }
        }else{
            Share_md::error_action('get_model_type', 'Get Model Type Error(No Sign)');
        }

    }
    /**
    * 取回member相關頁面
    * $act : 呼叫的路由行為
    * $page_type : 呼叫的頁面類型(因應手機版的會員內頁會有不同的head及footer)
    **/
    public static function get_mb_page($act = '', $page_type = ''){

        $page_name = 'mb/';

        if($act != ''){

            $rtn_array = array();

            switch($act){
                case 'register':
                    $page_name .= 'register';
                break;
                case 'epwd':
                    $page_name .= 'mb_edit_pwd';
                break;
                case 'eppwd':
                    $page_name .= 'mb_edit_paypwd';
                break;
                case 'edata':
                    $page_name .= 'mb_edit_data';
                break;
                case 'showrecord':
                    $page_name .= 'show_history';
                break;
                case 'acc':
                    $page_name .= 'mb_acc';
                break;
                case 'message':
                    $page_name .= 'mb_message';
                break;
                case 'notic':
                   if(strpos(session('model_type'), '_mobile') !== false || Basic_md::is_new_model_type()){
                        $page_name .= 'mb_notic';
                    }else{
                        header('Location:'.'/mb/mb_message');
                        exit();
                    }
                break;
                case 'bank_card':
                    $page_name .= 'mb_bank_card';
                break;
                case 'bank_card_add':
                    if(strpos(session('model_type'), '_mobile') !== false || Basic_md::is_new_model_type()){
                        $page_name .= 'mb_bank_card_add';
                    }else{
                        header('Location:'.'/mb/mb_bank_card');
                        exit();
                    }
                break;
                case 'deposit':
                    $page_name .= 'mb_deposit';
                break;
                case 'withdraw':
                    $page_name .= 'mb_withdraw';
                break;
                case 'details':
                    $page_name .= 'mb_details';
                break;
                case 'contact':
                    $page_name .= 'mb_contact';
                break;
                case 'into_login_page':
                    $page_name .= 'login_page';
                break;
                case 'mb_index':
                    if(strpos(session('model_type'), '_mobile') !== false || Basic_md::is_new_model_type()){
                        $page_name .= 'mb_index';
                    }else{
                        header('Location:'.'/mb/mb_acc');
                        exit();
                    }
                    
                break;
                case 'deposit_list':
                    if(strpos(session('model_type'), '_mobile') !== false || Basic_md::is_new_model_type()){
                        $page_name .= 'mb_deposit_list';
                    }else{
                        header('Location:'.'/mb/mb_details');
                        exit();
                    }
                break;
                case 'withdraw_list':
                    if(strpos(session('model_type'), '_mobile') !== false || Basic_md::is_new_model_type()){
                        $page_name .= 'mb_withdraw_list';
                    }else{
                        header('Location:'.'/mb/mb_details');
                        exit();
                    }
                    
                break;

            }

            if($page_name == 'mb/'){
            	Share_md::error_action('get_mb_page', 'Data Error');
            }else{

	            $rtn_array = self::combine_page_array($page_name, $page_type);

            	return $rtn_array;
            }

        }else{
            Share_md::error_action('get_mb_page', 'Data Error');
        }

    }
    /**
    * 取回system相關頁面
    * $act : 呼叫的路由行為
    **/
    public static function get_sys_page($act = ''){

        $page_name = '';

        if($act != ''){

            $rtn_array = array();

            switch($act){
                case '/':
                    $page_name = 'index';
                break;
                case 'agent':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:/');
                        exit();
                    }else{
                        $page_name = 'agent';
                    }
                break;
                case 'helpers':
                    $page_name = 'helpers';
                break;
                case 'app':
                    $page_name = 'app';
                break;
                case 'discount':
                    $page_name = 'discount';
                break;
                case 'discount_content':
                    $page_name = 'discount_content';
                break;
                case 'into_payment':
                    $page_name = 'into_payment';
                break;
                case 'show_payment':
                    $page_name = 'show_payment';
                break;
                case 'offline_payment':
                    $page_name = 'offline_payment';
                break;
            }

            if($page_name == ''){
            	Share_md::error_action('get_sys_page', 'Data Error');
            }else{
            	$rtn_array = self::combine_page_array($page_name);

            	return $rtn_array;
            }

        }else{
            Share_md::error_action('get_sys_page', 'Data Error');
        }

    }
    /**
    * 取回game相關頁面
    * $act : 呼叫的路由行為
    **/
    public static function get_game_page($act = ''){

        $page_name = 'games/';

        if($act != ''){

            $rtn_array = array();

            switch($act){               
                case 'cq9list':
                    $page_name .= 'cq9_list';
                break;
                case 'lottery':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:/');
                        exit();
                    }else{
                        $page_name .= 'lottery';
                    }
                break;
                case 'casino':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:'.'/');
                        exit();
                    }else{
                        $page_name .= 'casino_list';
                    }
                break;
                case 'sport':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:'.'/');
                        exit();
                    }else{
                        $page_name .= 'sports_list';
                    }
                break;
                case 'fish':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:'.'/');
                        exit();
                    }else{
                        $page_name .= 'fish';
                    }
                break;
                case 'card':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:'.'/');
                        exit();
                    }else{
                        $page_name .= 'card_index';
                    }
                break;
                case 'card_list':
                    if(strpos(session('model_type'), '_mobile') !== false){
                        header('Location:'.'/');
                        exit();
                    }else{
                        $page_name .= 'card_list';
                    }
                break;
                case 'into_game':
                    $page_name = 'into_game';
                break;
                case 'genesislist':
                    $page_name .= 'genesis_list';
                break;
                case 'rtglist':
                    $page_name .= 'rtg_list';
                break;
                case 'pglist':
                    $page_name .= 'pg_list';
                break;
                case 'salist':
                    $page_name .= 'sa_list';
                break;
                case 'swlist':
                    $page_name .= 'sw_list';
                break;
                case 'mwlist':
                    $page_name .= 'mw_list';
                break;
                case 'vtlist':
                    $page_name .= 'vt_list';
                break;
                case 'card_leg':
                    $page_name .= 'card_leg';
                break;
            }

            if($page_name == ''){
            	Share_md::error_action('get_game_page', 'Data Error');
            }else{
            	$rtn_array = self::combine_page_array($page_name);

            	return $rtn_array;
            }

        }else{
            Share_md::error_action('get_game_page', 'Data Error');
        }

    }
    /**
    * 組合頁面陣列
    **/
    private static function combine_page_array($page_name, $page_type = ''){

        // kingco版型才會進去if
        if(Basic_md::is_new_model_type()) {
            $prefix = 'md_5_0_002_mobile/';
            $rtn_array['view_url'] = $prefix. $page_name;
            $rtn_array['header_name'] = $prefix.'include/header';
            $rtn_array['head_name'] = $prefix.'include/head';
            $rtn_array['mb_head_name'] = $prefix.'include/mb_head';
            $rtn_array['footer_name'] = $prefix.'include/footer';
            $rtn_array['game_list'] = $prefix.'include/gamelist';

            if ($page_type == 'mb') {
                $rtn_array['mb_info_head'] = $prefix.'mb/mb_info_head';
                $rtn_array['mb_info_left'] = $prefix.'mb/mb_info_left';
            }
        } else {
            $rtn_array['view_url'] = session('model_type') . '/' . $page_name;
            $rtn_array['header_name'] = session('model_type') . '/include/header';
            $rtn_array['head_name'] = session('model_type') . '/include/head';
            $rtn_array['mb_head_name'] = session('model_type') . '/include/mb_head';
            $rtn_array['footer_name'] = session('model_type') . '/include/footer';
            $rtn_array['game_list'] = session('model_type') . '/include/gamelist';


            if ($page_type == 'mb') {
                $rtn_array['mb_info_head'] = session('model_type') . '/mb/mb_info_head';
                $rtn_array['mb_info_left'] = session('model_type') . '/mb/mb_info_left';
            }
        }
    	return $rtn_array;
    }
    /**
    * 呼叫會員token相關的sp
    * $act : 呼叫動作
    * $emp_code : 企業代碼
    **/
    public static function call_token_sp($act, $emp_code, $ent_code){
        
        $arr_data = array();
        $arr_data['code'] = '0';
        $arr_data['info'] = '';

        if ( env("APP_ENV",null) == "product" ){
            if($act == 'login'){

                $randoma = Share_md::get_random_num();

                if($randoma != ''){

                    $ip = Share_md::get_ip();

                    $rtn_dt = DB::select('call login_token_func(?, ?, ?, ?, ?)', array($emp_code, $ent_code, date('Y-m-d H:i:s'), $ip, $randoma));
                    if($rtn_dt[0]->result == '1'){
                        $arr_data['code'] = '1';
                        $arr_data['info'] = $randoma;
                    }
                }
            }else if($act == 'chk_token'){
                $rtn_dt = DB::select('call login_token_func(?, ?, ?, ?, ?)', array($emp_code, $ent_code, date('Y-m-d H:i:s'), '', ''));
                if(count($rtn_dt) > 0){
                    $arr_data['code'] = '1';
                    $arr_data['info'] = $rtn_dt[0]->token;
                }
            }else{
                Share_md::error_action('call_token_sp', 'Data Error');
            }
        }else{
            $arr_data['code'] = '1';
            $arr_data['info'] = '12345';
        }
        

        

        return $arr_data;

    }

    // kingco md_6_0_002 新版型手機版和PC版共用CSS路徑
    public static function get_share_css_prefix()
    {
        return (session('model_type') === 'md_6_0_002_mobile') ? 'md_6_0_002' : session('model_type');
    }

    // kingco md_6_0_002 新版型判斷 因為有的頁面原本寫法非md_5_002_mobile版型都會導向到其他頁面故新增此方法
    private static function is_new_model_type()
    {
        return (in_array(session('model_type'), array(
            'md_5_0_002_mobile',
            'md_6_0_002',
            'md_6_0_002_mobile',
        ))) ? true : false;
    }
}
