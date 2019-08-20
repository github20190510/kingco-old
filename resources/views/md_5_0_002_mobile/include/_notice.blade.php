@switch(session('model_type'))
    @case('md_6_0_002_mobile')
    @case('md_6_0_002')
        <div class="notice-module d-flex align-items-center" id="index_data">
            <span class="ml-3 mr-2"><i class=" fas fa-volume-up"></i></span>
            <marquee class="marquee m-0">
                <a v-for="(notice,index) in notic_data">
                    @{{index+1}}.@{{ notice.content }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </a>
            </marquee>
        </div>
        @break
    @default
        <div class="notice-module d-flex align-items-center" id="index_data">
            <span class="mr-2 msg-icon"></span>
            <marquee class="marquee m-0">
                <a v-for="(notice,index) in notic_data">
                    @{{index+1}}.@{{ notice.content }}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </a>
            </marquee>
        </div>
@endswitch