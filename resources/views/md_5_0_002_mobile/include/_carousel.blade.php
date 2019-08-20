@switch(session('model_type'))
    @case('md_6_0_002')
        @break
    @case('md_6_0_002_mobile')
        @break
    @default
        <div id="carouselExampleIndicators" class="carousel slide coverflow" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item header-carousel-item carousel-1 active"></div>
                <div class="carousel-item header-carousel-item carousel-2"></div>
                <div class="carousel-item header-carousel-item carousel-3"></div>
                <div class="carousel-item header-carousel-item carousel-4"></div>
                <div class="carousel-item header-carousel-item carousel-5"></div>
            </div>
        </div>
@endswitch