<?php 
$attribute_slug = $attribute->slug;

if( isset($stuff) ){
    $isPost = true;
}else{
    $stuff = request();
    $isPost = false;
}  ?>

@if( !$attribute->values[0]->value )
    <div class="item" data-maincat="@isset($maincat){{ $maincat }}@endisset">
        <div class="attribute_value" >
            <label class="ui_radio">
                <input
                    @if( $isPost ) 
                        @if( $stuff->isHaveValue($attribute_slug, null) )
                            {{ 'checked' }}
                        @endif
                    @else 
                        @if( $stuff->$attribute_slug )
                            {{ 'checked' }}
                        @endif
                    @endif
                    name="{{ $attribute_slug }}" 
                    value="{{ json_encode(null) }}" 
                    type="<?php if( isset($radio) ): echo 'radio';  else: echo 'checkbox'; endif; ?>">

                <span class="ch"><span class="active"></span></span>
            </label>
            <p class="attribute_name" >{{ $attribute->name }}</p>
        </div>
    </div>   
@else
    <div class="item" data-maincat="@isset($maincat){{ $maincat }}@endisset">
        <p class="attribute_name" >{{ $attribute->name }}</p>
        <div class="attribute_values" >
            @foreach( $attribute->values as $value )
                <div class="attribute_value" >
                    <label class="ui_radio">
                        <input 
                        @if( $isPost ) 
                            @if( $stuff->isHaveValue( $attribute_slug, $value->value_slug ) )
                                {{ 'checked' }}
                            @endif
                        @else 
                            @if( $stuff->$attribute_slug && in_array( $value->value_slug ,$stuff->$attribute_slug ) )
                                {{ 'checked' }}
                            @endif
                        @endif
                        name="{{ $attribute_slug }}@if(!$isPost)[]@endif" 
                        value="{{ $value->value_slug }}" 
                        type="<?php if( $isPost ): echo 'radio';  else: echo 'checkbox'; endif; ?>">
                        <span class="ch"><span class="active"></span></span>
                    </label>
                    <p>{{ $value->value }}</p>
                </div>
            @endforeach
        </div>
    </div> 
@endif