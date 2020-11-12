<section class="first">
	<div class="container">
		<div class="first">
			<div class="left">
				<div class="logo">
					<a href="{{ route('main') }}">
						<img class="logo_photo" src="{{ asset('img/logo.png?v=2') }}" alt="">
					</a>
				</div>
			</div>
			<div class="right">
				<div class="form">
					@csrf
					<div class="line_1">
						<div class="widthDirect">
							<select name="category" id="salutation">
								<option value="0">Все категории</option>
								@foreach($maincategories as $maincat)
								
									<option @if( url()->current() == route('maincategory', $maincat->slug ) ) ) selected  @endif value="{{ json_encode([ $maincat->slug ]) }}" >{{ $maincat->name }}</option>
									@foreach($maincat->categories as $cat)									  	
										<option @if( url()->current() == route('category', [ $maincat->slug ,$cat->slug] ) ) ) selected  @endif value="{{ json_encode([ $maincat->slug ,$cat->slug]) }}" >{{ $cat->name }}</option>
									@endforeach
								@endforeach

							</select>
						</div>
						<div class="wrap_input">
							<input name="s" value="{{ request()->s }}" placeholder="Поиск по объявлениям" type="text">
						</div>
						<div class="widthCities">
							<select name="city" id="salutation_2">
								<option value="0">Все города</option>
								@foreach($cities as $city)
								<option @if($city->name == request()->city) selected @endif value="{{ $city->name }}" >{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="search">
							<input type="submit" value="Поиск">
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</section>