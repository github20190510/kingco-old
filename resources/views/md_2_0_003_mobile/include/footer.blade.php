<nav class="btn-group d-flex fixed-bottom c-alpha-grey align-items-center footer-menu" role="group">
    <button type="button" class="btn text-white bg-transparent d-flex flex-column align-items-center p-0 w-100" role="button" onclick="location.href='/'"><span class="f-icon home-btn"></span><span>{{ __('msg_fcs_1.home') }}</span></button>
    <div class="btn-group w-100 finance-drop m-0 p-0" role="group" id="divfooter">
        <button type="button" class="btn btn-sm text-white bg-transparent d-flex flex-column align-items-center p-0 dropdown-toggle w-100 f-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="f-icon finance-btn"></span><span>{{ __('msg_fcs_1.money_center') }}</span>
        </button>
        <div class="dropdown-menu c-alpha-black border-0">
            <div class="d-flex m-0">
                <a class="text-white w-100 d-flex flex-column align-items-center" href="/mb/details"><i class="fas fa-chart-line fa-2x"></i>{{ __('msg_fcs_1.money_record') }}</a>
                <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/showrecord"><i class="fas fa-gamepad fa-2x"></i>{{ __('msg_fcs_1.betting').__('msg_fcs_1.record') }}</a>
                <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/deposit"><i class="fas fa-piggy-bank fa-2x"></i>{{ __('msg_fcs_1.saving_money') }}</a>
                <a class="text-white w-100 f-btn d-flex flex-column align-items-center" href="/mb/withdraw"><i class="fas fa-hand-holding-usd fa-2x"></i><spen>{{ __('msg_fcs_1.geting_money') }}</spen></a>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm text-white bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button" onclick="location.href='/discount'"><span class="f-icon discount-btn"></span><span>{{ __('msg_fcs_1.promotion') }}</span></button>
    <button type="button" class="btn btn-sm text-white bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button" onclick="window.open('https://pc87.pechatshop.com/chat/Hotline/channel.jsp?cid=5011173&cnfid=4849&j=9432866353&s=1'); return false;"><span class="f-icon service-btn"></span><span>{{ __('msg_fcs_1.online_service') }}</span></button>
    <button type="button" class="btn btn-sm text-white bg-transparent d-flex flex-column align-items-center p-0 w-100 f-btn" role="button"><span class="f-icon favorite-btn"></span><span>{{ __('msg_fcs_1.my_favorite') }}</span></button>
</nav>

<script>

$(document).ready(function(){

    if (navigator.userAgent.toLowerCase().match(/micromessenger/i)[0] === "micromessenger") {

        window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }

        alert("<?php echo __('msg.wechat_alert'); ?>");

    }

    $('input[type=number]').keypress(function(e) { 
    　　if (!String.fromCharCode(e.keyCode).match(/[0-9.]/)) { 
    　　　　return false; 
    　　} 
    });

});

var ft = new Vue({
    el : '#divfooter',
    mounted : function(){

        var _this = this;
        var count = 0;
        this.timer = setInterval(function(){
            if(count >= 300){
                count = 1;
                _this.setliving();
            }else{
                count ++;
            }
        }, 1000);

    }
});

</script>