<section class="first">
	<div class="container">
		<div class="first">
			<div class="left">
				<div class="logo">
					<a href="{{ route('main') }}">
						<img class="logo_photo" src="{{ asset('img/logo.png') }}" alt="">
					</a>
				</div>
			</div>
			<div class="right">
				<form action="category.php" method="POST">
					<div class="line_1">
						<div>
							<select name="category" id="salutation">
								<option selected>Все категории</option>
								
								@foreach($maincategories as $maincat)
								@foreach($maincat->categories as $cat)									  	
									<option value="{{ $cat->slug }}" >{{ $cat->name }}</option>
								@endforeach
								@endforeach

							</select>
						</div>
						<div class="wrap_input">
							<input placeholder="Поиск по объявлениям" type="text">
						</div>
						<div>
							<select name="geography" id="salutation_2">
								<option selected>Крым</option>
								@foreach($cities as $city)
								<option value="{{ $city->slug }}" >{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="search">
							<input type="submit" value="Поиск">
						</div>
					</div>
					<div class="line_2">
						<div class="part">
							<label class="wrap_checkbox">
								<input type="checkbox">
								<span class="icon">
									<i class="fa fa-check" aria-hidden="true"></i>
								</span>
								<span class="text">только в названиях</span>
							</label>
						</div>
						<div class="part">
							<label class="wrap_checkbox">
								<input type="checkbox">
								<span class="icon">
									<i class="fa fa-check" aria-hidden="true"></i>
								</span>
								<span class="text">только с фото</span>
							</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>