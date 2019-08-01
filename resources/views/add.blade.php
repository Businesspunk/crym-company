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
</style>
@endsection

@section('content')
<main>
<form class="added_post" method="POST">
	@csrf
	<section class="add">
		<div class="container">
				<div class="header">
					<div class="left">
						<img class="logo_photo" src="{{ asset('img/logo.png') }}" alt="">
					</div>
					<div class="right">Новое объявление</div>
				</div>
				<div class="choose_cat">
					<div class="title_m">Выберите категорию</div>
					<div class="second_container">
						<div class="wrap left_s">
							<div class="left ui_shadow">
								@foreach( $maincategories as $maincat )
								<ul>
									<li class="title category">{{ $maincat->name }}</li>
									@foreach( $maincat->categories as $cat )
									<li class="select">
										<label>
											<input type="radio" name="category_id" value="{{ $cat->id }}">
											<div class="text category">{{ $cat->name }}</div>
										</label>
									</li>
									@endforeach
								</ul>
								@endforeach

							</div>
						</div>
						<div class="right_s"></div>
					</div>
				</div>
		</div>
	</section>
	<section class="add_choose">
		<div class="container">
			<div class="wrap">
				<div class="left">
					Кто разместил
				</div>
				<div class="right">
					<div class="choosen">
						<label>
							<input type="radio" name="owner" value="Собственник" id="">
							<div class="text">Собственник</div>
						</label>
						<label>
							<input type="radio" name="owner" value="Агенство" id="">
							<div class="text">Агенство</div>
						</label>
					</div>
				</div>
			</div>
			<div class="wrap period">
				<div class="left">
					Срок владения
				</div>
				<div class="right">
					<input name="ownTime" type="text">
				</div>
			</div>
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
					<input name="title" type="text" placeholder="Название">
				</div>
			</div>
			<div class="wrap desc">
				<div class="left">
					Описание
				</div>
				<div class="right">
					<textarea name="description" placeholder="Опишите объект" rows="10"></textarea>
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
					<div class="notice">Перетащите фото сюда или <span class="blue">выберите их на своем компьютере</span></div>
					<div class="wrap_m">
						<div class="item">
							<i class="fa fa-camera" aria-hidden="true"></i>
							<div class="text">Добавить</div>
						</div>
					</div>
					<div class="desc">
						Первое фото будет отображаться в результатах поиска, выберите наиболее удачное.
						Вы можете загрузить до 20 фотографий в формате JPG или PNG.
						Максимальный размер фото — 25MB.
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
		<div class="container service">
			<div class="title">Услуги продвижения</div>
			<div class="desc">Сравните и выберите услуги продвижения, если вы хотите ускорить продажу</div>
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
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="1" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo"></div>
					<div class="main_info">
						<div class="tit">
							Без продвижения
						</div>
						<div class="cost">0 руб</div>
					</div>
					<div class="exist"><span class="not"></span></div>
					<div class="exist"><span class="not"></span></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="2" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-1.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							VIP-размещение
						</div>
						<div class="cost">139 руб</div>
					</div>
					<div class="exist">
						<span class="not"></span>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="3" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-2.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Премиум
						</div>
						<div class="cost">250 руб</div>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="exist"><span class="not"></span></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="4" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-3.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Быстрая продажа
						</div>
						<div class="cost">329 руб</div>
					</div>
					<div class="exist"><span class="not"></span></div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">
						<p>4 раза</p>
						<p>Каждые 48 часов</p>
					</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="5" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-4.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Турбо-продажа
						</div>
						<div class="cost">539 руб</div>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">
						<p>7 раз</p>
						<p>Каждые 24 часа</p>
					</div>
				</div>
			</div>

			<div class="table mobile">
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="1" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo"></div>
					<div class="main_info">
						<div class="tit">
							Без продвижения
						</div>
						<div class="cost">0 руб</div>
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
							1 раз
						</div>
					</div>
				</div>

				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="2" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-1.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							VIP-размещение
						</div>
						<div class="cost">139 руб</div>
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
							1 раз
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>

				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="3" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-2.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Премиум
						</div>
						<div class="cost">250 руб</div>
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
							1 раз
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «Премиум». 
						</div>
						<div class="norm">
							Первые строчки результатов поиска
						</div>
					</div>
				</div>

				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="4" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-3.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Быстрая продажа
						</div>
						<div class="cost">329 руб</div>
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
							4 раза. Каждые 48 часов
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typeOfPromote" value="5" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-4.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Турбо-продажа
						</div>
						<div class="cost">539 руб</div>
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
							7 раз. Каждые 24 часа
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «Премиум». 
						</div>
						<div class="norm">
							Первые строчки результатов поиска
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>
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
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=dc3fa49b-c3d3-4e3c-aba7-20e78aa1167b" type="text/javascript"></script>
	<script>
		function init() {
			var myMap = new ymaps.Map('map', {
				center: [55.74, 37.58],
				zoom: 13,
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
	</script>
@endsection