<div class="table desktop">
    <div class="row">
        <div class="button">
        </div>
        <div class="photo"></div>
        <div class="main_info">
            
        </div>
        <div class="exist">
            <div class="type">
                Блок «Премиум»
            </div>
            <div class="desc">
                Первые строчки результатов поиска
            </div>
        </div>
        <div class="exist">
            <div class="type">
                Блок «VIP»
            </div>
            <div class="desc">
                Промоблок в результатах поиска
            </div>
        </div>
        <div class="result">
            Первое место в результатах поиска
        </div>
    </div>
    @foreach( $promotions as $promo )
        <div class="row">
            <div class="button">
                <label class="ui_radio">
                    <input name="promotion_id" value="{{ $promo->id }}" type="radio">
                    <span class="ch"><span class="active"></span></span>
                </label>
            </div>
            <div class="photo">
                @if( $promo->icon )
                    <img src="{{ asset($promo->icon) }}" alt="">
                @endif
            </div>
            <div class="main_info">
                <div class="tit">
                    {{ $promo->name }}
                </div>
                <div class="cost">{{ get_price($promo->cost) }}</div>
            </div>
            <div class="exist">
                @if( $promo->block_1 == '-' )
                    <span class="not"></span>
                @else
                    <i class="fa fa-check" aria-hidden="true"></i>
                @endif
            </div>
            <div class="exist">
                @if( $promo->block_2 == '-' )
                    <span class="not"></span>
                @else
                    <i class="fa fa-check" aria-hidden="true"></i>
                @endif
            </div>
            <div class="result">{{ $promo->block_3 }}</div>
        </div>
    @endforeach
</div>

<div class="table mobile">
    @foreach( $promotions as $promo )
        <div class="row">
            <div class="button">
                <label class="ui_radio">
                    <input name="promotion_id" value="{{ $promo->id }}" type="radio">
                    <span class="ch"><span class="active"></span></span>
                </label>
            </div>
            <div class="photo">
                @if( $promo->icon )
                    <img src="{{ asset($promo->icon) }}" alt="">
                @endif
            </div>
            <div class="main_info">
                <div class="tit">
                    {{ $promo->name }}
                </div>
                <div class="cost">{{ get_price($promo->cost) }}</div>
            </div>
            <div class="icon_wrap">
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
        </div>
        <div class="added_info">
            <div class="item">
                <div class="bolder">
                    Первое место в результатах поиска: 
                </div>
                <div class="norm">
                    {{ $promo->block_3 }}
                </div>
            </div>
            @if( $promo->block_1 != '-' )
                <div class="item">
                    <div class="bolder">
                        Блок «Премиум» 
                    </div>
                    <div class="norm">
                        {{ $promo->block_1 }}
                    </div>
                </div>
            @endif
            @if( $promo->block_2 != '-' )
                <div class="item">
                    <div class="bolder">
                        Блок VIP 
                    </div>
                    <div class="norm">
                        {{ $promo->block_1 }}
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>