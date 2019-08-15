@extends('components.layout')

@section('content')
	<main>
		@include('components/category')
		<section class="first">
			<div class="container">
				<div class="second">
					<div class="item">
						<a href="category.php">
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
					<?php for($i = 0; $i < 10; $i++): ?>
		
						<div class="item">
							<a href="category.php">
								<img src="{{ asset('img/tests/one.png') }}" alt="">
								<span class="text">
									Недвижимость
								</span>
							</a>
						</div>
					
					<?php endfor; ?>
				</div>
			</div>
		</section>
		<section class="second section--margin-top">
			<div class="container wrap_grid">
				<div class="left">
					<div class="h4">VIP-объявления</div>
					<div class="items objects">
					<!-- for($i = 0; $i < 2; $i++)
						include('components/post')
					endfor -->
					</div>
					<div class="btn">Показать еще объявления</div>
				</div>
				<div class="right">
					<div class="h4">Сервисы и услуги</div>
					<div class="items">
						<div class="item">
							Сервисы и услуги
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="third section--margin-top">
			<div class="container wrap_grid">
				<div class="left">
					<div class="h4">Новые объявления</div>
					<div class="items objects">
						<!-- for($i = 0; $i < 12; $i++)
							include('components/post')
						endfor -->
					</div>
					<div class="btn">Показать еще объявления</div>
				</div>
				<div class="right">
					<div class="items">
						<div class="item">
							Реклама
						</div>
					</div>
				</div>
			</div>
		</section>
		</main>
@endsection
		