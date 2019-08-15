@extends('components/layout')

@section('after_css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
	<style>
		#map{
			height: 200px;
			margin-top: 20px; 
		}
	</style>
@endsection

@section('content')
	<main>
		@include('components/category')
		<section class="single_home">
			<div class="container">
				<div class="left">
					<div class="main">
						<div class="first_line">
							<div class="title">{{ $post->title }}</div>
							<a href="" class="like">
								<i class="fa fa-heart" aria-hidden="true"></i>
							</a>
						</div>
						<div class="second_line">
							Размещено {{ $post->created_at->diffForHumans() }}
						</div>
						<div class="third_line cost">{{ get_price($post->cost) }}</div>
						<div class="fourth_line views">
							<i class="fa fa-eye"></i>
							<div class="number">{{ $post->views }}</div>
						</div>
						<div class="big_photo">
							<a href="{{ getSavedPhoto($post->main_photo) }}" data-toggle="lightbox" data-gallery="example-gallery">
								<img class="img-fluid" src="{{ getSavedPhoto($post->main_photo) }}">
							</a>
						</div>
						<div class="small_photos">
							@foreach( $post->photos as $photo )
								<a href="{{ getSavedPhoto($photo->url) }}" data-toggle="lightbox" data-gallery="example-gallery">
									<img data-toggle="lightbox" src="{{ getSavedPhoto($photo->url) }}" class="img-fluid">
								</a>
							@endforeach
						</div>
						<div class="six_line">
							<div class="addr">
								<div class="de">Адрес:</div>
								<div class="info">{{ getNameByGeo($post) }}</div>
							</div>
							<div id="map"></div>
						</div>
						<div class="seven_line">
							<div class="de">Описание:</div>
							<div class="info">
								{!! $post->description !!}
							</div>
						</div>
					</div>
				</div>
					<div class="right">
						<div class="sticky">
							<a href="#" class="blue_btn btn">Показать телефон</a>
							<a href="#" class="gray_btn btn">Написать сообщение</a>
							@include('components/people')
						</div>
					</div>
				</div>
				<div class="container">
					<div class="left">
						<div class="add_info">
							<div class="eight_line">
								<div class="social">
									<a href="#"><img src="{{ asset('img/icons/vk.svg') }}" alt=""></a>
									<a href="#"><img src="{{ asset('img/icons/facebook.svg') }}" alt=""></a>
								</div>
								<div class="report">
									<a href="#" class="info">Пожаловаться</a>
								</div>
							</div>
							<div class="simmilar_posts">
								<div class="h4">Похожие объявления</div>
								<div class="items objects">
								<?php for($i = 0; $i < 1; $i++): ?>
									<div class="item">
										<div class="photo">
											<i class="fa fa-heart" aria-hidden="true"></i>
											<img src="img/tests/two.png" alt="">
										</div>
										<div class="title">
											<a href="single-post.php">Частный дом 1</a>
										</div>
										<div class="cost">1 200 000 рублей</div>
										<div class="desc">Lorem ipsum dolor sit amet, consectetur</div>
										<div class="time">Сегодня в 07:32</div>
									</div>
								<?php endfor; ?>
								</div>
								<div class="btn">Показать еще объявления</div>
							</div>
						</div>
					</div>
					<div class="right">
						
					</div>
				</div>
				
			</div>
		</section>
	</main>
@endsection

@section('after_js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey={{ env('Yandex_API_Key') }}" type="text/javascript"></script>
	<script>
	ymaps.ready(init);
	function init() {

    var myMap = new ymaps.Map("map", {
            center: [{{ $post->coord_x }}, {{ $post->coord_y }}],
            zoom: 12
        }, {
            searchControlProvider: 'yandex#search'
        }),

        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [{{ $post->coord_x }}, {{ $post->coord_y }}]
            },
            // Свойства.
            properties: {
                //iconContent: 'Я тащусь',
                //hintContent: 'Ну давай уже тащи'
            }
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        });

    myMap.geoObjects.add(myGeoObject);
}
	</script>
	<script>
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox();
		});
	</script>
@endsection