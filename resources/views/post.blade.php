@extends('components/layout')

@section('after_css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
	<style>
		#map{
			height: 200px;
			margin-top: 20px; 
		}
		.hidden{
			display: none;
			text-align: center;
		}
		.phone a{
			font-size: 20px;
			color: #333;
		}
	</style>
@endsection

@section('content')
	<main>
		<form action="{{ route('search') }}">
			@include('components/category')
		</form>
		<section class="single_home">
			<div class="container">
				<div class="left">
					<div class="main">
						<div class="first_line">
							<div class="title">{{ $post->title }}</div>
								<i data-favorite-id="{{ $post->id }}" class="fa like-link fa-heart @if( in_array($post->id, $favorites) ) active @endif" aria-hidden="true"></i>
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
							<div class="wrap">
								<img src="{{ getSavedPhoto($post->main_photo) }}" alt="">
							</div>
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
						@if( issetCoord($post) )
							<div class="six_line">
								<div class="addr">
									<div class="de">Адрес:</div>
									<div class="info">{{ getNameByGeo($post) }}</div>
								</div>
								<div id="map"></div>
							</div>
						@endif
						<div class="seven_line">
							<div class="de">Описание:</div>
							<div class="info">
								{!! $post->description !!}
							</div>
						</div>
						@if($post->youtube)
							<div class="seven_line">
								<iframe width="100%" height="300" src="https://www.youtube.com/embed/{{ getVideoId($post->youtube) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						@endif
						@auth
							<div class="seven_line post_manage">
								<div class="left">
									@if( ( Auth::user() )->can('edit', $post) )
									<a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Редактировать</a>
									@endif

									@if( ( Auth::user() )->can('delete', $post) )
										<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete">Удалить</a>
									@endif									
								</div>
								<div class="right_t">
									@if( ( Auth::user() )->can('close', $post) )
										<a href="#" class="btn btn-success" data-toggle="modal" data-target="#close">Закрыть объявление</a>
									@endif
								</div>
							</div>		
						@endauth
					</div>
				</div>
					<div class="right">
						<div class="sticky">
							<a href="#" id="showPhone" class="blue_btn btn">Показать телефон</a>
							<div class="phone hidden">
								<a href="tel:{{ $post->user->profile->number }}">{{ $post->user->profile->number }}</a>	
							</div>
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
									<a href="{{ route('messageToSupport') }}" class="info">Пожаловаться</a>
								</div>
							</div>
							<div class="simmilar_posts">
								@if($relatedPosts->count())
								<div class="h4">Похожие объявления</div>
									<div class="items objects">
										@foreach($relatedPosts as $post)
											@include('components/post')
										@endforeach
									</div>
								@endif
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
	<script>	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey={{ env('Yandex_API_Key') }}" type="text/javascript"></script>
	@if( issetCoord($post) )	
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
					geometry: {
						type: "Point",
						coordinates: [{{ $post->coord_x }}, {{ $post->coord_y }}]
					},
				}, {
					preset: 'islands#icon',
					iconColor: '#0095b6'
				});

			myMap.geoObjects.add(myGeoObject);
		}
		</script>
	@endif
	<script>
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox();
		});
		$('#showPhone').click(function(e){
			e.preventDefault();
			$(this).slideUp(200, function(){
				$('.hidden.phone').fadeIn(200);
			})
		})
	</script>
@endsection