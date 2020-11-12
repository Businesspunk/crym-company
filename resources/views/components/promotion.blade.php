<div class="table desktop">
    <div class="row">
        <div class="button">
        </div>
        <div class="photo"></div>
        <div class="main_info">
            
        </div>
   
        <div class="result">
            Удержание первых мест в результатах поиска
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
            <div class="result">
                @if( $promo->desc )
                    {{ $promo->desc }}
                @else
                    {{ get_days( $promo->days ) }}
                @endif
            </div>
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
                    Удержание первых мест в результатах поиска
                </div>
                <div class="norm">
                    @if( $promo->desc )
                        {{ $promo->desc }}
                    @else
                        {{ get_days( $promo->days ) }}
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>