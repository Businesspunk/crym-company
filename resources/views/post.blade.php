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
							<div class="number">{{ views($post)->unique()->count() }}</div>
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
						@auth
							@if( ( Auth::user() )->can('delete', $post) )
							<div class="seven_line post_manage">
								<div class="left">
									<a href="#" class="btn btn-primary">Редактировать</a>
									<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete">Удалить</a>
								</div>
								<div class="right_t">
									<a href="#" class="btn btn-success" data-toggle="modal" data-target="#close">Закрыть объявление</a>
								</div>
							</div>		
							@endif
						@endauth
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
								{!! $relatedPosts !!}
							</div>
						</div>
					</div>
					<div class="right">
						
					</div>
				</div>
				
			</div>
		</section>
		<div class="modal fade" id="delete" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Удалить объявление?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<form method="POST" action="{{ route('post.delete', $post->id) }}">
						@csrf
						<button type="submit" class="btn btn-danger">Удалить</button>	
					</form>

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="close" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Закрыть объявление?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<form method="POST" action="{{ route('post.close', $post->id) }}">
						@csrf
						<button type="submit" class="btn btn-success">Закрыть</button>	
					</form>

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
				</div>
				</div>
			</div>
		</div>
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