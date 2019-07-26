<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/', 'Controller@test');
Route::get('/', 'Sys_Controller@show_view')->middleware('act');
//Route::get('/into_game/{gid}/{gtype}', 'Game_Controller@into_game')->middleware('act');
Route::get('/login_cookie/set/{acc}/{pwd}','Mem_Controller@set_login_cookie');
Route::get('/login_cookie/get','Mem_Controller@get_login_cookie');
Route::get('/login_cookie/del','Mem_Controller@del_login_cookie');
Route::get('/agent', 'Sys_Controller@show_view')->middleware('act');
Route::get('/helpers', 'Sys_Controller@show_view')->middleware('act');
Route::get('/app', 'Sys_Controller@show_view')->middleware('act');
Route::get('/discount', 'Sys_Controller@show_view')->middleware('act');
//Route::get('/create_game_list/{game_data_name}/{game_corp_name}/{file_name}/{game_tech}', 'Sys_Controller@create_game_list');
Route::get('/info_page', 'Sys_Controller@info_page');

Route::get('/discount_content/{aid}', 'Sys_Controller@show_view')->middleware('act');

Route::get('/change_model/{model_type}', 'Sys_Controller@change_model')->middleware('act');

Route::get('into_idc_manage/{web_site_id}/{web_site_key}', 'Sys_Controller@into_idc_manage');

Route::group(['prefix'=>'system', 'middleware'=>'act'], function(){
    Route::get('/', 'Sys_Controller@index');
    Route::get('/takealldomainconfig', 'Sys_Controller@take_all_domain_config');
    Route::get('/notic/{start?}/{limit?}', 'Sys_Controller@notic');
    // Route::get('/contact', 'Sys_Controller@contact');
    Route::get('/get_verifcode/{phonenum}', 'Sys_Controller@get_verifcode');
    Route::get('/get_banner/PC', 'Sys_Controller@get_banner');
    Route::get('/get_banner/H5', 'Sys_Controller@get_banner');
    Route::get('/ebankcards', 'Sys_Controller@ebankcards');
    Route::get('/aliwepay/{qrtype}/{status}', 'Sys_Controller@get_aliwepays');
    Route::get('/get_ethirdpartys/{type}', 'Sys_Controller@get_ethirdpartys');
    Route::get('/into_payment/{amount}/{thirdpartycode}/{paybankcode}/{bankcode}', 'Sys_Controller@into_payment');
    Route::get('/show_payment/{amount}/{ent_code}', 'Sys_Controller@show_payment');
    Route::get('/offline_payment/{amount}/{qrtype}/{offline_account}', 'Sys_Controller@offline_payment');
    Route::get('/esaving/{amount}/{thirdpartycode}/{paybankcode}/{bankcode}', 'Sys_Controller@esaving');
    Route::get('/banks', 'Sys_Controller@banks');
});

Route::group(['prefix'=>'mb'], function(){
    Route::get('/mb_index', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/register', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/epwd', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/eppwd', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/edata', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/showrecord', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/acc', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/message', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/notic', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/bank_card', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/bank_card_add', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/deposit', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/deposit_list', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/withdraw', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/withdraw_list', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/details', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/contact', 'Mem_Controller@show_view')->middleware('act');
    Route::get('/login_page/{gid?}/{gtype?}', 'Mem_Controller@into_login_page')->middleware('act');;
    Route::get('/chk_user_session/{browser_data}/{os_data}', 'Mem_Controller@chk_user_session');
    Route::get('/user_logout', 'Mem_Controller@user_logout');
    Route::get('/user_register/{acc}/{pwd}/{mpwd}/{nick}/{browser_data}/{os_data}', 'Mem_Controller@user_register')->middleware('act');
    Route::get('/user_login/{acc}/{pwd}/{browserversion}/{opratesystem}/{rmb_pwd?}', 'Mem_Controller@user_login')->middleware('act');
    Route::get('/upd_pwd/{opwd}/{npwd}', 'Mem_Controller@update_pwd');
    Route::get('/upd_ppwd/{opwd}/{npwd}', 'Mem_Controller@update_fpwd')->middleware('act');
    Route::get('/user_info', 'Mem_Controller@take_employee')->middleware('act');
    Route::get('/message_count', 'Mem_Controller@message_count')->middleware('act');
    Route::get('/sysmessage/{start}/{limit}/{sdate?}/{edate?}/{readstatus?}', 'Mem_Controller@sys_message')->middleware('act');
    Route::get('/updsysmessage/{msgno}', 'Mem_Controller@upd_system_message')->middleware('act');
    Route::get('/updateinfo/{rname}/{email}/{qq}/{wechat}/{line}/{skype}/{phonenum?}/{verifycode?}', 'Mem_Controller@update_info')->middleware('act');
    Route::get('/addubankcard/{paymentaccount}/{accountname}/{openningbank}/{bankcode}/{fundpassword}', 'Mem_Controller@add_ubankcard')->middleware('act');
    Route::get('/editubankcard/{informationcode}/{fundpassword}/{paymentaccount}/{accountname}/{openningbank}/{bankcode}/{qq?}/{skype?}/{email?}', 'Mem_Controller@edit_ubankcard')->middleware('act');
    Route::get('/deleteubankcard/{informationcode}/{fundpassword}', 'Mem_Controller@delete_ubankcard')->middleware('act');
    Route::get('/ubankcards', 'Mem_Controller@ubankcards')->middleware('act');
    Route::get('/defaultubankcard/{informationcode}', 'Mem_Controller@default_ubankcard')->middleware('act');
    Route::get('/takingmoney/{orderamount}/{ordercomment}/{informationcode}/{fundpassword}', 'Mem_Controller@taking_money')->middleware('act');
    Route::get('/savingmoney/{orderamount}/{ordercomment}/{info_code}/{bank}/{acc}/{name}', 'Mem_Controller@saving_money')->middleware('act');
    Route::get('/saveorder/{orderstatus}/{start}/{limit}/{orderdate_begin}/{orderdate_end}', 'Mem_Controller@save_order')->middleware('act');
    Route::get('/takeorder/{orderstatus}/{start}/{limit}/{orderdate_begin}/{orderdate_end}', 'Mem_Controller@take_order')->middleware('act');
    Route::get('/findaccountchange/{start}/{limit}/{orderdate_begin}/{orderdate_end}/{changetype}', 'Mem_Controller@find_account_change_record')->middleware('act');
    Route::get('/brandactivitytrigger', 'Mem_Controller@brand_activity_trigger')->middleware('act');
    Route::get('/inspection', 'Mem_Controller@inspection')->middleware('act');
    Route::get('/setonline', 'Mem_Controller@setonline')->middleware('act');
    Route::get('/setoffline', 'Mem_Controller@setoffline')->middleware('act');
    Route::get('/setliving', 'Mem_Controller@setliving')->middleware('act');
    Route::get('/', 'Mem_Controller@index')->middleware('act');
});

Route::group(['prefix'=>'game', 'middleware'=>'act'], function(){
    Route::get('/gamebalances/{emp_code}', 'Game_Controller@game_balances');
    Route::get('/getmybagmoney/{emp_code?}', 'Game_Controller@get_bag_money');
    Route::get('/ebrandgame', 'Game_Controller@ebrandgame');
    Route::get('/ebrandgameall', 'Game_Controller@ebrandgame_all');
    //Route::get('/gamebalancesall/{emp_code}', 'Game_Controller@gamebalancesall');
    Route::get('/gamebalancesall_acc', 'Game_Controller@game_balances_all');
    Route::get('/gamebalance/{gtype}', 'Game_Controller@gamebalance');
    Route::get('/gameplay/{gametype}/{playtype}/{homeurl}/{lobbyurl}/{depositurl}/{withdrawurl}/{transferurl}/{usercenterurl}', 'Game_Controller@game_play');
    Route::get('/cq9list', 'Game_Controller@show_view');
    Route::get('/genesislist', 'Game_Controller@show_view');
    Route::get('/rtglist', 'Game_Controller@show_view');
    Route::get('/pglist', 'Game_Controller@show_view');
    Route::get('/lottery', 'Game_Controller@show_view');
    Route::get('/casino', 'Game_Controller@show_view');
    Route::get('/sport', 'Game_Controller@show_view');
    Route::get('/fish', 'Game_Controller@show_view');
    Route::get('/card', 'Game_Controller@show_view');
    Route::get('/card_list', 'Game_Controller@show_view');
    Route::get('/salist', 'Game_Controller@show_view');
    Route::get('/swlist', 'Game_Controller@show_view');
    Route::get('/mwlist', 'Game_Controller@show_view');
    Route::get('/vtlist', 'Game_Controller@show_view');
    Route::get('/card_leg', 'Game_Controller@show_view');
    Route::get('/get_recordsall/{start}/{limit}/{gameplatform?}/{gamebigtype?}/{startdate?}/{enddate?}/{onlyone?}', 'Game_Controller@records_all');
    Route::get('/get_records/{start}/{limit}/{gametype?}/{startdate?}/{enddate?}', 'Game_Controller@records');
    Route::get('/intogame/{gid}/{gtype}', 'Game_Controller@into_game');
    Route::get('/setmoney/{gtype}/{money}', 'Game_Controller@upintegral_game');
    Route::get('/getmoney/{gtype}/{money}', 'Game_Controller@downintegral_game');
    Route::get('/downintegralallgame', 'Game_Controller@downintegral_all_game');
    Route::get('/chk_token', 'Game_Controller@chk_token');
});
/**
* 驗證碼用
**/
Route::get('captchacpt/{captcha}', function($captcha)
{
	$arrJson = array();
    $rules = ['captcha' => 'required|captcha'];
    $validator = Validator::make(array('captcha'=>$captcha), $rules);
    if ($validator->fails())
    {
        $arrJson['data'] = 'nomatch';
    }
    else
    {
        $arrJson['data'] = 'match';
    }

    return json_encode($arrJson);
});
/**
* gcp訪問測試用
**/
Route::get('/gcp_health',function(){
    return 'okok';
});
