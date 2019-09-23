@extends('components.layout')

@section('content')
	<main>
		<form action="{{ route('search') }}">
			@include('components/category')
		</form>
			<section class="first">
			<div class="container">
				<div class="second">
					<div class="item">
						<a href="{{ route('posts') }}">
							<div class="all_item">
								<span class="rise_1 rise"></span>
								<span class="rise_1 rise"></span>
								<span class="rise_2 rise"></span>
							</div>
							<span class="text">
								Все категории
							</span>
						</a>
					</div>
					@foreach( $maincategories as $maincat )
						@foreach( $maincat->categories as $cat )
							<div class="item">
								<a href="{{ route('category', [ 'maincategory' => $maincat->slug , 'slug' => $cat->slug]) }}">
									<img src="{{ asset('img/tests/one.png') }}" alt="">
									<span class="text">{{ $cat->name }}</span>
								</a>
							</div>
						@endforeach
					@endforeach
				</div>
			</div>
		</section>
		<section class="second section--margin-top">
			<div class="container wrap_grid">
				<div class="left">
					<div class="h4">VIP-объявления</div>
					@include('components/posts', [ 'posts' => $vipposts, 'type' => 'vip' ])
				</div>
			</div>
		</section>
		<section class="third section--margin-top">
			<div class="container wrap_grid">
				<div class="left">
					<div class="h4">Новые объявления</div>
					@include('components/posts', [ 'posts' => $newest, 'type' => 'new' ])
				</div>
				<div class="right">
					<div class="items">
						<div class="item">
							Здесь может быть Ваша реклама
						</div>
					</div>
				</div>
			</div>
		</section>
		</main>
@endsection
		