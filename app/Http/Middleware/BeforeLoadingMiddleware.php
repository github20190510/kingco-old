<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\Basic_md;
use App\Share_md;

class BeforeLoadingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //取回api所需資料
        $rtn_data = Basic_md::get_web_data_to_session();

        //多國語言設定
        $lang = session()->get('lang') ?? 'zh_cn';
        App::setLocale($lang);

        if($rtn_data != ''){
            //表示有錯誤訊息
            Share_md::error_action('BeforeLoadingMiddleware_handle', $rtn_data);
        }else{
            //無錯誤訊息，判斷session是否存在，不存在要報錯
            if(session('enterprisecode') == '' || session('brandcode') == '' || session('new_md5_key') == '' || session('new_aes_key') == '' || session('sign') == ''){
                Share_md::error_action('BeforeLoadingMiddleware_handle', 'Get Session Error!');
            }
        }

        return $next($request);

    }
}
