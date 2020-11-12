@extends('components.layout')

@section('after_css')
<style>
	#map {
        width: 100%; height: 300px; padding: 0; margin: 0;
	}
	.alert_geo{
		display: none;
	}
	.alert{
		font-size: 13px;
	}
	#uploadPhotos, #uploadMainPhoto{
		display: none;
	}
	.spinner-border{
		display: none;
	}
	.preloader_photos, .preloader_main_photo{
		position: absolute;
		top: 0;
		left: 0;
	}
	section.add_choose .photo .notice.notice_second{
		margin-top: 40px;
	}
	section.add_choose .photo .wrap_main_photo .wrap_m{
		grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
	}
	.wrap_for_photos{
		position: relative;
	}
	.hidden{
		display: none;
	}
</style>
@endsection

@section('content')
<main>
<div class="container">
		@isset( $breadcrumbs )
			{{ $breadcrumbs }}
		@endisset
</div>
<form class="added_post" method="POST">
	@csrf
	<section class="add">
		<div class="container">
				<div class="header">
					<div class="left">
						<img class="logo_photo" src="{{ asset('img/logo.png?v=2') }}" alt="">
					</div>
					<div class="right">Новое объявление</div>
				</div>
				@if ($errors->any())
					<div class="validation">
						@foreach ($errors->all() as $error)
							<div class="alert alert-danger">
								{{ $error }}
							</div>
						@endforeach
					</div>
				@endif
				<div class="choose_cat">
					<div class="title_m">Выберите категорию</div>
						<div class="wrap left_s">
							<div class="left ui_shadow">
								<?php 
									if( (Auth::user())->isVip() ){
										$maincategories = $maincategories->where('id', 1);
									}
								?>
								
								@foreach( $maincategories as $maincat )
									@if( $loop->iteration % 2 == 1 )
										<div class="col">
									@endif
										<ul>
											<li class="title category">{{ $maincat->name }}</li>
											@foreach( $maincat->categories as $cat )
											<li class="select">
												<label>
													<input type="radio" data-maincat="{{ $maincat->slug }}"  name="category_id" value="{{ $cat->id }}">
													<div class="text category">{{ $cat->name }}</div>
												</label>
											</li>
											@endforeach
										</ul>
									@if( $loop->iteration % 2 == 0 )
										</div>
									@endif
								@endforeach

								
							</div>
						</div>
				</div>
				<div>
					<div class="attributes">
					<div class="title_m">Укажите атрибуты объекта</div>	
							@foreach( $maincategories as $maincat )
								@foreach( $maincat->attributes as $attribute )
									@include('components.attribute', 
										['attribute' => $attribute, 
										'maincat' => $maincat->slug, 
										'radio' => true ])
								@endforeach
							@endforeach
					</div>
				</div>
		</div>
	</section>
	<section class="add_choose">
		<div class="container">
			<div class="wrap local">
				<div class="left">
					Месторасположение
				</div>
				<div class="right">
					<div class="second_wr">
						<div class="alert alert_find alert-warning" role="alert">
							Найдите свой объект
						</div>
						<div class="alert alert_geo alert-success" role="alert">
							Геопозиция добавлена
						</div>
					</div>
					<input type="hidden" name="coord_x">
					<input type="hidden" name="coord_y">
					<div id="map" class="map_block"></div>
				</div>
			</div>
			<div class="wrap name">
				<div class="left">
					Название объявления
				</div>
				<div class="right">
					<input required name="title" type="text" placeholder="Название">
				</div>
			</div>
			<div class="wrap desc">
				<div class="left">
					Описание
				</div>
				<div class="right">
					<textarea required minlength=20 name="description" placeholder="Опишите объявление" rows="10"></textarea>
				</div>
			</div>
			<div class="wrap name">
				<div class="left">Номер телефона</div>
				<div class="right">
					<input required name="phone_number" type="text" value="{{ Auth::user()->profile->number }}" placeholder="Номер телефона">
				</div>
			</div>

			<div class="wrap name">
				<div class="left">Цена</div>
				<div class="right">
					<input required name="cost" type="number" placeholder="руб.">
				</div>
			</div>
		</div>
	</section>
	<section class="add_choose">
		<div class="divider"> <div class="line"></div> </div>
		<div class="container">
			<div class="wrap photo">
				<div class="left">
					Фотографии
				</div>
				<div class="right">
					<div class="notice">Загрузите главную фотографию объявления. </div>
					<div class="wrap_main_photo">
						<div class="wrap_m">
							<label for="uploadMainPhoto" class="item uploadMainPhotoWrap">
								<input type="hidden" name="main_photo">
								<div class="spinner-border preloader_main_photo text-primary" role="status">
									<span class="sr-only">Loading...</span>
								</div>
								<i class="fa fa-camera" aria-hidden="true"></i>
								<div class="text">Добавить</div>
							</label>
							<input type="file" id="uploadMainPhoto">
						</div>
						<div id="main_photo" class="main_photo">
							
						</div>
					</div>
					<div class="notice notice_second">Загрузите дополнительные фотографии объявления</span></div>
						<div class="wrap_m wrap_for_photos">
							<input type="hidden" name="images">
							<label for="uploadPhotos" class="item">
								<div class="spinner-border preloader_photos text-primary" role="status">
									<span class="sr-only">Loading...</span>
								</div>
								<i class="fa fa-camera" aria-hidden="true"></i>
								<div class="text">Добавить</div>
							</label>
						</div>
					<input type="file" name="photos" multiple id="uploadPhotos">
					<div class="desc">
						Вы можете загрузить до 20 фотографий в формате JPG или PNG.
					</div>
				</div>
			</div>
			<div class="wrap youtube">
				<div class="left">
					Видео с YouTube
				</div>
				<div class="right">
					<input name="youtube" type="text" placeholder="Вставьте ссылку">
				</div>
			</div>
		</div>
		<div class="divider"><div class="line"></div></div>
		<div class="container lastFreePublications">
			<div class="title">Бесплатные публикации</div>
			<div class="alert alert-warning" role="alert">
				У вас осталось {{ Auth::user()->getLastFreePublications() }}
			</div>
			@if( Auth::user()->free_publications == 0 )
				<div class="alert alert-warning" role="alert">
					Дополнительное объявление стоит {{ $costOne }} руб.
				</div>
			@endif
		</div>
		<div class="container service">
			<div class="title">Услуги продвижения</div>
			<div class="desc">Сравните и выберите услуги продвижения, если вы хотите ускорить продажу</div>
			<div class="wrap_promotion_block">
				@include('components/promotion')
			</div>
			<div class="total">
				<div class="btn">
					<input type="submit" value="Далее">
				</div>
			</div>
		</div>
	</section>
</form>
</main>
@endsection

@section('after_js')
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey={{ env('Yandex_API_Key') }}" type="text/javascript"></script>
	<script>
		function init() {
			var myMap = new ymaps.Map('map', {
				center: [45.281124, 34.449232],
				zoom: 8,
				controls: []
			});
			
			var searchControl = new ymaps.control.SearchControl({
				options: {
					provider: 'yandex#search',
				}
			});

			var mySearchResults = new ymaps.GeoObjectCollection(null, {
				hintContentLayout: ymaps.templateLayoutFactory.createClass('$[properties.name]')
			});

			myMap.controls.add(searchControl);
			myMap.geoObjects.add(mySearchResults);

			searchControl.events.add('resultselect', function (e) {
				var result = searchControl.getResult(0);
				result.then(function (res) {
					var coordinates = res.geometry.getCoordinates();
					$('[name="coord_x"]').val( coordinates[0] );
					$('[name="coord_y"]').val( coordinates[1] );

					$('.alert_find').slideUp( 300 );
					$('.alert_geo').slideDown( 300 );
				}, function (err) {
					console.log("Ошибка");
				});
			});
		}

		ymaps.ready(init);

		$('#uploadPhotos').change(function(){
				$preloader = $('.preloader_photos');
				$files = $('#uploadPhotos')[0].files;
				var count = $files.length;
				for( $i = count - 1; $i >= 0; $i-- ){
					var formData = new FormData();
					formData.append('photo', $files[$i]);
					$preloader.fadeIn();
						$.ajax({
							url: "{{ route('ajaxUploadImages') }}",
							type: 'POST',
							data: formData,
							cache: false,
							processData: false, 
							contentType: false,
							success: function (data) {
								$preloader.fadeOut();
								if( data.error ){
									showErrors( data.messages );
									return;
								}
								$input = $('.wrap_for_photos').find('[name=images]');
								if( !$input.val() ){
									$input.val( JSON.stringify([]) );
								}
								$res = JSON.parse( $input.val() );
								$res.push(data.paths);
								$input.val( JSON.stringify( $res ) );

								$elem = $(data.block);
								$elem.appendTo( $('.wrap_for_photos') );
								$elem.removeClass('hidden');
							}
						});
				} 
			})

			$uploadMainWrap = $('.uploadMainPhotoWrap');
			$('#uploadMainPhoto').change(function(){
				$preloader = $('.preloader_main_photo');
				$files = $('#uploadMainPhoto')[0].files;
					var formData = new FormData();
					formData.append('photo', $files[0]);
					$preloader.fadeIn();
					$.ajax({
						url: "{{ route('ajaxUploadImages') }}",
						type: 'POST',
						data: formData,
						cache: false,
						processData: false, 
						contentType: false,
						success: function (data) {
							$preloader.fadeOut();
							if( data.error ){
								showErrors(data.messages);
								return;
							}
							$uploadMainWrap.find('[name=main_photo]').val( data.paths );
							$uploadMainWrap.fadeOut(300, function(){
								$elem = $(data.block);
								$elem.appendTo( $('.main_photo') );
								$elem.removeClass('hidden');
							});
						}
					});
			})

			$(document).click(function(e){
				$t = $(e.target);
				if( $t.is('.deleteImage') ){
					$item = $t.closest('.item');
					$item.fadeOut(300, function(){
						if( $item.closest('.main_photo').length ){
							$uploadMainWrap.fadeIn(300);
							$uploadMainWrap.find('[name=main_photo]').val('');                            
						}
						if( $item.closest('.wrap_for_photos').length ){
							$inputImages = $('[name="images"]');
							var array = JSON.parse( $inputImages.val() );
							array = removeA( array, $t.data('path') );
							var result = array.length > 0 ? JSON.stringify(array) : '';
							$inputImages.val( result );
						}
						$item.remove();
					})

				}
			})

			$(document).ready(function(){
				$('[name="category_id"]').change(function(e){
					var category_id = $(this).val();
					$.ajax({
						url: "{{ route('getPromoTemplate') }}",
						type: 'POST',
						data: {
							category_id: category_id,
							isAdded: false
						},
						success: function (data) {
							$('.wrap_promotion_block').empty().append(data);
						}
					});
				})
			});

	</script>
@endsection