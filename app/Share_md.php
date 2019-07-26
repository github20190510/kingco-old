<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Share_md extends Model
{
    /**
    *  組網址
    *  $act : 呼叫的api動作
    *  $cfg_type : 設定檔
    **/
    public static function combinedUrl($act){

        if(config('api_link_data.api_url') !== null){
            $api_url = config('api_link_data.api_url');
            return $api_url.$act;
        }else{
            self::error_action('combinedUrl', 'Get Config Error!');
        }

    }
    /**
    * 資料加密
    * $arr_data : 要加密的資料陣列
    * $md5_key : 加密的md5 key
	* $aes_key : 加密的aes key
	* $aes_type : 加密的aes編碼型式
	* $enc_option : 編碼規則
    **/
    public static function data_encode($arr_data, $md5_key, $aes_key, $aes_type, $enc_option){

        $str_params = urldecode(http_build_query($arr_data));

        $signature = md5($str_params.$md5_key);

        $param = base64_encode(openssl_encrypt($str_params, $aes_type, $aes_key, $enc_option));

        $params = $arr_data;

        $params['params'] = $param;
        $params['signature'] = $signature;

        return $params;

    }
    /**
    * 資料解密
    * $str_data : 要解密的資料
	* $aes_key : 加密的aes key
	* $aes_type : 加密的aes編碼型式
	* $enc_option : 編碼規則
    **/
    public static function aes_decode($str_data, $aes_key, $aes_type, $enc_option){

        $rtn_data = openssl_decrypt(base64_decode($str_data), $aes_type, $aes_key, $enc_option);

        return $rtn_data;

    }
    /**
    * CURL函式
    * $url : 要呼叫的url
    * $params : 傳入的參數
	* $ispost : 是否為post
	* $https : 是否為https
    */
    public static function curl($url, $params = false, $ispost = 0, $https = 0){

        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 檢查認證證書
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 從證書檢查SSL加密算法是否存在
        }
        if($ispost){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        }else{
        	//目前的controller都是用post模式在傳遞參數，get模式用作debug用
            if($params){
                if(is_array($params)){
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
                echo $url . '?' . $params;
                die();
            }else{
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE){
            return false;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));

        curl_close($ch);

        return $response;

    }
    /**
    * 判斷來源是否為手機裝置
    **/
    public static function isMobile(){

        if(isset($_SERVER['HTTP_USER_AGENT'])){
            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
            $clientkeywords = array(
                'iphone','android','phone','mobile','wap','netfront','java','opera mobi',
                'opera mini','ucweb','windows ce','symbian','series','webos','sony','blackberry','dopod',
                'nokia','samsung','palmsource','xda','pieplus','meizu','midp','cldc','motorola','foma',
                'docomo','up.browser','up.link','blazer','helio','hosin','huawei','novarra','coolpad',
                'techfaith','alcatel','amoi','ktouch','nexian','ericsson','philips','sagem','wellcom',
                'bunjalloo','maui','smartphone','iemobile','spice','bird','zte-','longcos','pantech',
                'gionee','portalmmm','jig browser','hiptop','benq','haier','^lct','320x320','240x320',
                '176x220','windows phone','cect','compal','ctl','lg','nec','tcl','daxian','dbtel','eastcom',
                'konka','kejian','lenovo','mot','soutec','sgh','sed','capitel','panasonic','sonyericsson',
                'sharp','panda','zte','acer','acoon','acs-','abacho','ahong','airness','anywhereyougo.com',
                'applewebkit/525','applewebkit/532','asus','audio','au-mic','avantogo','becker','bilbo',
                'bleu','cdm-','danger','elaine','eric','etouch','fly ','fly_','fly-','go.web','goodaccess',
                'gradiente','grundig','hedy','hitachi','htc','hutchison','inno','ipad','ipaq','ipod',
                'jbrowser','kddi','kgt','kwc','lg ','lg2','lg3','lg4','lg5','lg7','lg8','lg9','lg-','lge-',
                'lge9','maemo','mercator','meridian','micromax','mini','mitsu','mmm','mmp','mobi','mot-',
                'moto','nec-','newgen','nf-browser','nintendo','nitro','nook','obigo','palm','pg-',
                'playstation','pocket','pt-','qc-','qtek','rover','sama','samu','sanyo','sch-','scooter',
                'sec-','sendo','sgh-','siemens','sie-','softbank','sprint','spv','tablet','talkabout',
                'tcl-','teleca','telit','tianyu','tim-','toshiba','tsm','utec','utstar','verykool','virgin',
                'vk-','voda','voxtel','vx','wellco','wig browser','wii','wireless','xde','pad','gt-p1000'
            );

            $is_mobile = false;
            foreach ($clientkeywords as $device) {  
                if (stristr($userAgent, $device)) {  
                    $is_mobile = true;  
                    break;  
                }
            }

            return $is_mobile;
        }

        return false;

    }
    /**
    * 取回client的ip
    */
    public static function get_ip(){

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
           $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
           $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
           $user_ip = $_SERVER['REMOTE_ADDR'];
        }

        $arr_ip = explode(',', $user_ip);

        return $arr_ip[0];

    }
    /**
    * 錯誤寫入log並導到錯誤頁
    **/
    public static function error_action($act, $err_msg){

        //指定LOG檔名(5.4版適用)
        //Log::useFiles(storage_path('logs/model/error_'.date('Ymd').'.log')); 
        $str_err = 'act:'.$act.', msg:'.$err_msg;
        Log::channel('model')->info($str_err);
        abort(403, $err_msg);

    }
    /**
    * 取得亂數
    * $int_length : 亂數長度
    **/
    public static function get_random_num($int_length = 10){

        $randoma = '';

        for($inti = 1; $inti <= $int_length; $inti = $inti + 1){
            //亂數$c設定三種亂數資料格式大寫、小寫、數字，隨機產生
            $c = rand(1, 3);
            //在$c==1的情況下，設定$a亂數取值為97-122之間，並用chr()將數值轉變為對應英文，儲存在$b
            if($c == 1){
                $a = rand(97, 122);
                $b = chr($a);
            }
            //在$c==2的情況下，設定$a亂數取值為65-90之間，並用chr()將數值轉變為對應英文，儲存在$b
            if($c == 2){
                $a = rand(65, 90);
                $b = chr($a);
            }
            //在$c==3的情況下，設定$b亂數取值為0-9之間的數字
            if($c == 3){
                $b = rand(0, 9);
            }
            //使用$randoma連接$b
            $randoma = $randoma.$b;
        }

        return $randoma;

    }
    /**
    * 取回employee_code
    **/
    public static function get_employee_code(){

        $employee_code = '';

        if(!empty(session('login_eid'))){
            $employee_code = session('login_eid');
        }

        return $employee_code;
    }
}
