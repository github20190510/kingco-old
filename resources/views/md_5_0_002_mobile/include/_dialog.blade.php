<span class="enabled" data-toggle="modal" data-target="#into_game_dialog" id="open_dialog"></span>
<div class="modal fade mem-modal" id="into_game_dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display: none;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content c-alpha-white border-0">
            <div class="modal-header text-white c-purple border-0">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_zy_1.money_not_enough') }}</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display:none"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body mt-4">
                <div class="form-group row">
                    <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_zy_1.confirm_into_game') }}</label>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn border-0 btn-dark c-peach" @click="trans_point_page" id="trans_point_page">{{ __('msg_zy_1.into_point_page') }}</button>
                <button type="button" class="btn border-0 btn-dark c-peach" @click="confirm_into_game">{{ __('msg_zy_1.into_game') }}</button>
                <button type="button" class="btn border-0 btn-dark c-peach" @click="auto_trans_point('{{ __('msg_zy_1.trans_in_succ') }}', '{{ __('msg_zy_1.click_into_game_button') }}', '{{ __('msg_zy_1.trans_in_err') }}', '{{ __('msg_zy_1.bag_money_not_enough') }}', '{{ __('msg_zy_1.into_game') }}')" id="auto_trans_point">{{ __('msg_zy_1.auto_trans_point') }}</button>
            </div>
        </div>
    </div>
</div>
<!--
    <span class="enabled" data-toggle="modal" data-target="#into_game_dialog" id="open_dialog"></span>
    <div class="modal fade mem-modal" id="into_game_dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display: none;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content c-alpha-white border-0">
                <div class="modal-header text-white c-gold border-0">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('msg_zy_1.money_not_enough') }}</h6>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="set_money_close" style="display:none"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body mt-4">
                    <div class="form-group row">
                        <label for="exampleInputPassword1" class="col-sm-12 col-form-label" style="color:black" id="msg_data">{{ __('msg_zy_1.confirm_into_game') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border-0 btn-dark c-gold" @click="trans_point_page" id="trans_point_page">{{ __('msg_zy_1.into_point_page') }}</button>
                    <button type="button" class="btn border-0 btn-dark c-gold" @click="confirm_into_game">{{ __('msg_zy_1.into_game') }}</button>
                    <button type="button" class="btn border-0 btn-dark c-gold" @click="auto_trans_point('{{ __('msg_zy_1.trans_in_succ') }}', '{{ __('msg_zy_1.click_into_game_button') }}', '{{ __('msg_zy_1.trans_in_err') }}', '{{ __('msg_zy_1.bag_money_not_enough') }}', '{{ __('msg_zy_1.into_game') }}')" id="auto_trans_point">{{ __('msg_zy_1.auto_trans_point') }}</button>
                </div>
            </div>
        </div>
    </div>
-->