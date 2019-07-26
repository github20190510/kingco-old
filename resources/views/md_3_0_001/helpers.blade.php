<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include($header_name)
    <body>
        <div class="container-fluid px-0 header_bg">
            @include($head_name)
        </div>
        <div id="banner" class="container-fluid px-0 banner">
            <div class="banner_help"></div>
        </div>
        <div class="main main help-main" id="helpers">
            <div class="content">
                <div class="help-tab">
                    <nav>
                        <div class="nav nav-tabs help-menu" id="help-menu" role="tablist">
                            <a class="nav-item nav-link active" id="nav-about-tab" href="#nav-about" data-toggle="tab" role="tab" aria-controls="nav-about" aria-selected="true">{{ __('msg_dt_1.about_us') }}</a>
                            <a class="nav-item nav-link" id="nav-general-tab" href="#nav-general" data-toggle="tab" role="tab" aria-controls="nav-general" aria-selected="false">{{ __('msg_dt_1.QandA') }}</a>
                            <a class="nav-item nav-link" id="nav-rules-tab" href="#nav-rules" data-toggle="tab" role="tab" aria-controls="nav-rules" aria-selected="false">{{ __('msg_dt_1.rule') }}</a>
                            <a class="nav-item nav-link" id="nav-betting-tab" href="#nav-betting" data-toggle="tab" role="tab" aria-controls="nav-betting" aria-selected="false">{{ __('msg_dt_1.responsibility_bitting') }}</a>
                            <a class="nav-item nav-link" id="nav-play-tab" href="#nav-play" data-toggle="tab" role="tab" aria-controls="nav-play" aria-selected="false">{{ __('msg_dt_1.betting_play') }}</a>
                            <a class="nav-item nav-link" id="nav-terms-tab" href="#nav-terms" data-toggle="tab" role="tab" aria-controls="nav-terms" aria-selected="false">{{ __('msg_dt_1.trems_of_use') }}</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" href="#nav-contact" data-toggle="tab" role="tab" aria-controls="nav-contact" aria-selected="false">{{ __('msg_dt_1.contact_us') }}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!--關於我們-->
                        <div class="tab-pane fade show active" id="nav-about" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="help-rules">
                                <ul>
                                    <li>
                                        <h4>{{ __('msg_dt_1.LS_introduction_title1') }}</h4>
                                        <p>{{ __('msg_dt_1.LS_intro_desc1') }}<br>
                                        </p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.LS_introduction_title2') }}</h4>
                                        <p>{{ __('msg_dt_1.LS_intro_desc2') }}<br>
                                            {{ __('msg_dt_1.LS_intro_desc3') }}<br>
                                            {{ __('msg_dt_1.LS_intro_desc4') }}</p>
                                        <p>{{ __('msg_dt_1.LS_intro_desc5') }}</p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.LS_introduction_title3') }}</h4>
                                        <p>{{ __('msg_dt_1.LS_intro_desc6') }}</p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.LS_introduction_title4') }}</h4>
                                        <p>{{ __('msg_dt_1.LS_intro_desc7') }}</p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.LS_introduction_title5') }}</h4>
                                        <p>{{ __('msg_dt_1.LS_intro_desc8') }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--常見問題-->
                        <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <nav class="sub-dropdowns">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-common-tab" data-toggle="tab" href="#nav-common" role="tab" aria-controls="nav-common" aria-selected="true">{{ __('msg_dt_1.common') }}{{ __('msg_dt_1.QandA') }}</a>
                                    <a class="nav-item nav-link" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="false">{{ __('msg_dt_1.deposit') }}</a>
                                    <a class="nav-item nav-link" id="nav-withdrawal-tab" data-toggle="tab" href="#nav-withdrawal" role="tab" aria-controls="nav-withdrawal" aria-selected="false">{{ __('msg_dt_1.withdrawal') }}</a>
                                    <a class="nav-item nav-link" id="nav-acount-tab" data-toggle="tab" href="#nav-acount" role="tab" aria-controls="nav-acount" aria-selected="false">{{ __('msg_dt_1.my_account') }}</a>
                                    <a class="nav-item nav-link" id="nav-casino-tab" data-toggle="tab" href="#nav-casino" role="tab" aria-controls="nav-casino" aria-selected="false">{{ __('msg_dt_1.casino') }}</a>
                                    <a class="nav-item nav-link" id="nav-sport-tab" data-toggle="tab" href="#nav-sport" role="tab" aria-controls="nav-sport" aria-selected="false">{{ __('msg_dt_1.ls_sport') }}</a>
                                    <a class="nav-item nav-link" id="nav-mobile-tab" data-toggle="tab" href="#nav-mobile" role="tab" aria-controls="nav-mobile" aria-selected="false">{{ __('msg_dt_1.mobile_bet') }}</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabGeneral">
                                <!--一般常见问题-->
                                <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">
                                    <div class="help-rules">
                                        <ul>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q1') }}</h4>
                                                <p>{{ __('msg_dt_1.common_A1_1') }}<br>
                                                    {{ __('msg_dt_1.common_A1_2') }}<br>
                                                    {{ __('msg_dt_1.common_A1_3') }}</p>
                                                <ol class="help-ol">
                                                    <li>{{ __('msg_dt_1.common_A1_4') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_5') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_6') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_7') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_8') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_9') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_10') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A1_11') }}</li>
                                                </ol>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q2') }}</h4>
                                                <p>{{ __('msg_dt_1.common_A2_1') }}</p>
                                                <ol>
                                                    <li>{{ __('msg_dt_1.common_A2_2') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A2_3') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A2_4') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A2_5') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A2_6') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A2_7') }}</li>
                                                </ol>
                                                <p>{{ __('msg_dt_1.common_A2_8') }}<br>
                                                    {{ __('msg_dt_1.common_A2_9') }}<br>
                                                    {{ __('msg_dt_1.common_A2_10') }}<br>
                                                </p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q3') }}</h4>
                                                <p>{{ __('msg_dt_1.common_A3_1') }}<br>
                                                    {{ __('msg_dt_1.common_A3_2') }}<br>
                                                </p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q4') }}</h4>
                                                <p>{{ __('msg_dt_1.common_A4_1') }}</p>
                                                <p>{{ __('msg_dt_1.common_A4_2') }}</p>
                                                <p><span>{{ __('msg_dt_1.common_A4_3') }}</span>{{ __('msg_dt_1.common_A4_4') }}</p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q5') }}</h4>
                                                <p>{{ __('msg_dt_1.common_A5_1') }}<br>
                                                    {{ __('msg_dt_1.common_A5_2') }}<br>
                                                    {{ __('msg_dt_1.common_A5_3') }}<br>
                                                    {{ __('msg_dt_1.common_A5_4') }}</p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.common_Q6') }}</h4>
                                            </li>
                                            <p>{{ __('msg_dt_1.common_A6_1') }}</p>
                                            <ol>
                                                <li>{{ __('msg_dt_1.common_A6_2') }}</li>
                                                <li>{{ __('msg_dt_1.common_A6_3') }}</li>
                                                <p>{{ __('msg_dt_1.common_A6_4') }}</p>
                                                <ul>
                                                    <li>{{ __('msg_dt_1.common_A6_5') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_6') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_7') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_8') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_9') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_10') }}</li>
                                                    <li>{{ __('msg_dt_1.common_A6_11') }}</li>
                                                </ul>
                                                <p>{{ __('msg_dt_1.common_A6_12') }}<br>
                                                    {{ __('msg_dt_1.common_A6_13') }}</p>
                                            </ol>
                                        </ul>
                                    </div>
                                </div>
                                <!--存款-->
                                <div class="tab-pane fade" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
                                    <div class="help-rules">
                                        <ul>
                                            <li>
                                                <h4>{{ __('msg_dt_1.deposit_Q1') }}</h4>
                                                <p>{{ __('msg_dt_1.deposit_A1_1') }}</p>
                                                <ul>
                                                    <li>{{ __('msg_dt_1.deposit_A1_2') }}</li>
                                                    <li>{{ __('msg_dt_1.deposit_A1_3') }}</li>
                                                    <li>{{ __('msg_dt_1.deposit_A1_4') }}</li>
                                                    <li>{{ __('msg_dt_1.deposit_A1_5') }}</li>
                                                    <li>{{ __('msg_dt_1.deposit_A1_6') }}</li>
                                                </ul>
                                                <p>{{ __('msg_dt_1.deposit_A1_7') }}</p>
                                                <p>{{ __('msg_dt_1.deposit_A1_8') }}</p>
                                                <p>{{ __('msg_dt_1.deposit_A1_9') }}</p>
                                                <p>{{ __('msg_dt_1.deposit_A1_10') }}</p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.deposit_Q2') }}</h4>
                                                <p>{{ __('msg_dt_1.deposit_A2_1') }}</p>
                                                <ol>
                                                    <li>{{ __('msg_dt_1.deposit_A2_2') }}</li>
                                                    <p>{{ __('msg_dt_1.deposit_A2_3') }}</p>
                                                    <p>{{ __('msg_dt_1.deposit_A2_4') }}</p>
                                                    <p>{{ __('msg_dt_1.deposit_A2_5') }}</p>
                                                    <p>{{ __('msg_dt_1.deposit_A2_6') }}</p>
                                                </ol>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.deposit_Q3') }}</h4>
                                                <p>{{ __('msg_dt_1.deposit_A3_1') }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--提款-->
                                <div class="tab-pane fade" id="nav-withdrawal" role="tabpanel" aria-labelledby="nav-withdrawal-tab">
                                    <div class="help-rules">
                                        <ul>
                                            <li>
                                                <h4>{{ __('msg_dt_1.withdrawal_Q1') }}</h4>
                                                <p>{{ __('msg_dt_1.withdrawal_A1_1') }}<br>
                                                    {{ __('msg_dt_1.withdrawal_A1_2') }}<br>
                                                    {{ __('msg_dt_1.withdrawal_A1_3') }}<br>
                                                    {{ __('msg_dt_1.withdrawal_A1_4') }}<br>
                                                    <br>
                                                    <br>
                                                    {{ __('msg_dt_1.withdrawal_A1_5') }}<br>
                                                    {{ __('msg_dt_1.withdrawal_A1_6') }}<br>
                                                    <br>
                                                    <br>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--我的账号-->
                                <div class="tab-pane fade" id="nav-acount" role="tabpanel" aria-labelledby="nav-acount-tab">
                                    <div class="help-rules">
                                        <ul>
                                            <li>
                                                <h4>{{ __('msg_dt_1.acount_Q1') }}</h4>
                                                <p> {{ __('msg_dt_1.acount_A1_1') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_2') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_3') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_4') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_5') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_6') }}<br>
                                                    {{ __('msg_dt_1.acount_A1_7') }}<br>
                                                </p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.acount_Q2') }}</h4>
                                                <p>{{ __('msg_dt_1.acount_A2_1') }}<br>
                                                {{ __('msg_dt_1.acount_A2_2') }}<br>
                                                    {{ __('msg_dt_1.acount_A2_3') }}<br>
                                                    {{ __('msg_dt_1.acount_A2_4') }}</p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.acount_Q3') }}</h4>
                                                <p>{{ __('msg_dt_1.acount_A3_1') }}<br>
                                                {{ __('msg_dt_1.acount_A3_2') }}<br>
                                                    {{ __('msg_dt_1.acount_A3_3') }}<br>
                                                    {{ __('msg_dt_1.acount_A3_4') }}<br>
                                                    {{ __('msg_dt_1.acount_A3_5') }}</p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.acount_Q4') }}</h4>
                                                <p>{{ __('msg_dt_1.acount_A4_1') }}<br>
                                                    {{ __('msg_dt_1.acount_A4_2') }}<br>
                                                    {{ __('msg_dt_1.acount_A4_3') }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--娱乐城-->
                                <div class="tab-pane fade" id="nav-casino" role="tabpanel" aria-labelledby="nav-casino-tab">
                                    <div class="help-rules">
                                        <ul>
                                            <li>
                                                <h4>{{ __('msg_dt_1.casino_Q1') }}</h4>
                                                <p>{{ __('msg_dt_1.casino_A1_1') }}</p>
                                                <p>{{ __('msg_dt_1.casino_A1_2') }}<br>
                                                    {{ __('msg_dt_1.casino_A1_3') }}<br>
                                                    {{ __('msg_dt_1.casino_A1_4') }}<br>
                                                    {{ __('msg_dt_1.casino_A1_5') }}<br>
                                                </p>
                                                <p>
                                                <table class="tab-TFinfo" cellpadding="0" cellspacing="0" style="border: 2px solid; text-align: center;">
                                                    <tbody>
                                                        <tr class="tab-tr-red">
                                                            <td width="263" class="paddding10" style="border-right-width: 3px; border-right-style: solid;">{{ __('msg_dt_1.casino_A1_6') }}</td>
                                                            <td width="160" style="border-right-width: 3px; border-right-style: solid;"><strong>{{ __('msg_dt_1.casino_A1_7') }}</strong></td>
                                                            <td width="217" style="border-right-width: 3px; border-right-style: solid;">{{ __('msg_dt_1.casino_A1_8') }}</td>
                                                        </tr>
                                                        <tr class="tab-tr-red">
                                                            <td class="paddding10" rowspan="4" style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_9') }}</td>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_10') }}</td>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_11') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_12') }}</td>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_13') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_14') }}</td>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_15') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_16') }}</td>
                                                            <td style="border: 2px solid;">{{ __('msg_dt_1.casino_A1_17') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </p>
                                            </li>
                                            <li>
                                                <h4>{{ __('msg_dt_1.casino_Q2') }}</h4>
                                                <p>{{ __('msg_dt_1.casino_A2_1') }}<br>
                                                    {{ __('msg_dt_1.casino_A2_2') }}<br>
                                                    {{ __('msg_dt_1.casino_A2_3') }}<br>
                                                    {{ __('msg_dt_1.casino_A2_4') }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--龍豪娱乐城体育-->
                                <div class="tab-pane fade" id="nav-sport" role="tabpanel" aria-labelledby="nav-sport-tab">
                                    <div class="help-rules" id="rule_lh">

                                    </div>
                                </div>
                                <!--手机下注-->
                                <div class="tab-pane fade" id="nav-mobile" role="tabpanel" aria-labelledby="nav-mobile-tab">
                                    <div class="help-rules" id="rule_mobile">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--規則-->
                        <div class="tab-pane fade" id="nav-rules" role="tabpanel" aria-labelledby="nav-rules-tab">
                            <nav class="sub-dropdowns">
                                <div class="nav nav-tabs" id="nav-tab-rules" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-preferential-tab" data-toggle="tab" href="#nav-preferential" role="tab" aria-controls="nav-preferential" aria-selected="true">{{ __('msg_dt_1.dis_and_rule') }}</a>
                                    <a class="nav-item nav-link" id="nav-bettingrules-tab" data-toggle="tab" href="#nav-bettingrules" role="tab" aria-controls="nav-bettingrules" aria-selected="false">{{ __('msg_dt_1.betting_rule') }}</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabPreferential">
                                <!--优惠条款及规则-->
                                <div class="tab-pane fade show active" id="nav-preferential" role="tabpanel" aria-labelledby="nav-preferential-tab">
                                    <div class="help-rules" id="preferential">

                                    </div>
                                </div>
                                <!--投注规则-->
                                <div class="tab-pane fade" id="nav-bettingrules" role="tabpanel" aria-labelledby="nav-bettingrules-tab">
                                    <div class="help-rules" id="bettingrules">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--責任博彩-->
                        <div class="tab-pane fade" id="nav-betting" role="tabpanel" aria-labelledby="nav-betting-tab">
                            <div class="help-rules">
                                <ul>
                                    <li>
                                        <h4>{{ __('msg_dt_1.resp_title1') }}</h4>
                                        <p>{{ __('msg_dt_1.resp_desc1_1') }}</p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.resp_title2') }}</h4>
                                        <p>{{ __('msg_dt_1.resp_desc2_1') }}</p>
                                        <p>{{ __('msg_dt_1.resp_desc2_2') }}</p>
                                    </li>
                                    <li>
                                        <h4>{{ __('msg_dt_1.resp_title3') }}</h4>
                                        <p>{{ __('msg_dt_1.resp_desc3_1') }}</p>
                                        <p>{{ __('msg_dt_1.resp_desc3_2') }}<a href="http://www.netnanny.com/" target="_blank">{{ __('msg_dt_1.resp_desc3_3') }}</a></p>
                                        <p>{{ __('msg_dt_1.resp_desc3_4') }}<a href="http://www.cybersitter.com/" target="_blank">{{ __('msg_dt_1.resp_desc3_5') }}</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--彩种玩法-->
                        <div class="tab-pane fade" id="nav-play" role="tabpanel" aria-labelledby="nav-play-tab">
                            <nav class="sub-dropdowns">
                                <div class="nav nav-tabs" id="nav-tab-play" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-lt01-tab" data-toggle="tab" href="#nav-lt01" role="tab" aria-controls="nav-lt01" aria-selected="true">{{ __('msg_dt_1.play_title01') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt02-tab" data-toggle="tab" href="#nav-lt02" role="tab" aria-controls="nav-lt02" aria-selected="false">{{ __('msg_dt_1.play_title02') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt03-tab" data-toggle="tab" href="#nav-lt03" role="tab" aria-controls="nav-lt03" aria-selected="false">{{ __('msg_dt_1.play_title03') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt04-tab" data-toggle="tab" href="#nav-lt04" role="tab" aria-controls="nav-lt04" aria-selected="false">{{ __('msg_dt_1.play_title04') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt05-tab" data-toggle="tab" href="#nav-lt05" role="tab" aria-controls="nav-lt05" aria-selected="false">{{ __('msg_dt_1.play_title05') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt06-tab" data-toggle="tab" href="#nav-lt06" role="tab" aria-controls="nav-lt06" aria-selected="false">{{ __('msg_dt_1.play_title06') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt07-tab" data-toggle="tab" href="#nav-lt07" role="tab" aria-controls="nav-lt07" aria-selected="false">{{ __('msg_dt_1.play_title07') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt08-tab" data-toggle="tab" href="#nav-lt08" role="tab" aria-controls="nav-lt08" aria-selected="false">{{ __('msg_dt_1.play_title08') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt09-tab" data-toggle="tab" href="#nav-lt09" role="tab" aria-controls="nav-lt09" aria-selected="false">{{ __('msg_dt_1.play_title09') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt10-tab" data-toggle="tab" href="#nav-lt10" role="tab" aria-controls="nav-lt10" aria-selected="false">{{ __('msg_dt_1.play_title10') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt11-tab" data-toggle="tab" href="#nav-lt11" role="tab" aria-controls="nav-lt11" aria-selected="false">{{ __('msg_dt_1.play_title11') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt12-tab" data-toggle="tab" href="#nav-lt12" role="tab" aria-controls="nav-lt12" aria-selected="false">{{ __('msg_dt_1.play_title12') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt13-tab" data-toggle="tab" href="#nav-lt13" role="tab" aria-controls="nav-lt13" aria-selected="false">{{ __('msg_dt_1.play_title13') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt14-tab" data-toggle="tab" href="#nav-lt14" role="tab" aria-controls="nav-lt14" aria-selected="false">{{ __('msg_dt_1.play_title14') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt15-tab" data-toggle="tab" href="#nav-lt15" role="tab" aria-controls="nav-lt15" aria-selected="false">{{ __('msg_dt_1.play_title15') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt16-tab" data-toggle="tab" href="#nav-lt16" role="tab" aria-controls="nav-lt16" aria-selected="false">{{ __('msg_dt_1.play_title16') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt17-tab" data-toggle="tab" href="#nav-lt17" role="tab" aria-controls="nav-lt17" aria-selected="false">{{ __('msg_dt_1.play_title17') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt18-tab" data-toggle="tab" href="#nav-lt18" role="tab" aria-controls="nav-lt18" aria-selected="false">{{ __('msg_dt_1.play_title18') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt19-tab" data-toggle="tab" href="#nav-lt19" role="tab" aria-controls="nav-lt19" aria-selected="false">{{ __('msg_dt_1.play_title19') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt20-tab" data-toggle="tab" href="#nav-lt20" role="tab" aria-controls="nav-lt20" aria-selected="false">{{ __('msg_dt_1.play_title20') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt21-tab" data-toggle="tab" href="#nav-lt21" role="tab" aria-controls="nav-lt21" aria-selected="false">{{ __('msg_dt_1.play_title21') }}</a>
                                    <a class="nav-item nav-link" id="nav-lt22-tab" data-toggle="tab" href="#nav-lt22" role="tab" aria-controls="nav-lt22" aria-selected="false">{{ __('msg_dt_1.play_title22') }}</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabplay">
                                <div class="tab-pane fade show active" id="nav-lt01" role="tabpanel" aria-labelledby="nav-lt01-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt02" role="tabpanel" aria-labelledby="nav-lt02-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt03" role="tabpanel" aria-labelledby="nav-lt03-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt04" role="tabpanel" aria-labelledby="nav-lt04-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt05" role="tabpanel" aria-labelledby="nav-lt05-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt06" role="tabpanel" aria-labelledby="nav-lt06-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt07" role="tabpanel" aria-labelledby="nav-lt07-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt08" role="tabpanel" aria-labelledby="nav-lt08-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt09" role="tabpanel" aria-labelledby="nav-lt09-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt10" role="tabpanel" aria-labelledby="nav-lt10-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt11" role="tabpanel" aria-labelledby="nav-lt11-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt12" role="tabpanel" aria-labelledby="nav-lt12-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt13" role="tabpanel" aria-labelledby="nav-lt13-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt14" role="tabpanel" aria-labelledby="nav-lt14-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt15" role="tabpanel" aria-labelledby="nav-lt15-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt16" role="tabpanel" aria-labelledby="nav-lt16-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt17" role="tabpanel" aria-labelledby="nav-lt17-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt18" role="tabpanel" aria-labelledby="nav-lt18-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt19" role="tabpanel" aria-labelledby="nav-lt19-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt20" role="tabpanel" aria-labelledby="nav-lt20-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt21" role="tabpanel" aria-labelledby="nav-lt21-tab"><div class="help-rules"></div></div>
                                <div class="tab-pane fade" id="nav-lt22" role="tabpanel" aria-labelledby="nav-lt22-tab"><div class="help-rules"></div></div>
                            </div>
                        </div>
                        <!--使用條款-->
                        <div class="tab-pane fade" id="nav-terms" role="tabpanel" aria-labelledby="nav-terms-tab">
                            <div class="help-rules" id="terms">
                                {{ __('msg_dt_1.trems_of_use') }}
                            </div>
                        </div>
                        <!--聯繫我們-->
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="help-rules">
                                <div>
                                    <h4><span class="qq-icon"></span></h4>
                                    <p>{{ __('msg_dt_1.contact_desc1') }}</p>
                                    <h4>{{ __('msg_dt_1.online_service') }}</h4>
                                    <p>{{ __('msg_dt_1.contact_desc2') }}<br>
                                        {{ __('msg_dt_1.contact_desc3') }}
                                    </p>
                                </div>
                                <hr>
                                <div>
                                    <h3>{{ __('msg_dt_1.instant_consultation') }}</h3>
                                    <p>{{ __('msg_dt_1.contact_desc4') }}</p>
                                    <button type="button" class="btn btn-danger px-5 d-flex"><span class="waiter-icon mr-1"></span>{{ __('msg_dt_1.click_here') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($footer_name)
    </body>
    <script>
        var helpers = new Vue({
            el: '#helpers',
            data:{
            },
            created: function(){
                var file_path = "{{asset('js/')}}/" + Folder_Name + '/rules/rule_lh.txt';

                axios.get(file_path).then(function(response){
                    $('#rule_lh').html(response.data);
                });

                var file_path = "{{asset('js/')}}/" + Folder_Name + '/rules/rule_mobile.txt';

                axios.get(file_path).then(function(response){
                    $('#rule_mobile').html(response.data);
                });

                var file_path = "{{asset('js/')}}/" + Folder_Name + '/rules/preferential.txt';

                axios.get(file_path).then(function(response){
                    $('#preferential').html(response.data);
                });

                var file_path = "{{asset('js/')}}/" + Folder_Name + '/rules/bettingrules.txt';

                axios.get(file_path).then(function(response){
                    $('#bettingrules').html(response.data);
                });

                var file_path = "{{asset('js/')}}/" + Folder_Name + '/rules/rule_terms.txt';

                axios.get(file_path).then(function(response){
                    $('#terms').html(response.data);
                });

                switch(location.hash){
                    case '#nav-acount':
                        setTimeout(function(){
                            $('#nav-general-tab').click();
                            $('#nav-acount-tab').click();
                        }, 500);
                    break;
                    case '#nav-deposit':
                        setTimeout(function(){
                            $('#nav-general-tab').click();
                            $('#nav-deposit-tab').click();
                        }, 500);
                    break;
                    case '#nav-withdrawal':
                        setTimeout(function(){
                            $('#nav-general-tab').click();
                            $('#nav-withdrawal-tab').click();
                        }, 500);
                    break;

                }
            }
        });
    </script>
</html>
