@extends('components.layout')

@section('content')
	<main>
		@include('components/category')
		<section class="fourth section--margin-top">
			<div class="container">
				<div class="main_title">
					<span>{{ $category->name }}</span>
					<span class="number">{{ $category->posts->count() }}</span>
				</div>
			</div>
			<div class="container wrap_grid">
				<div class="left">
					<div class="items">
						<div class="item named">
						{{ $category->name }}
						</div>
						<div class="item filter">
							<div class="name">Цена</div>
							<form action="">
								<div class="wrap">
									<input type="text" name="" placeholder="От" id="">
									<input type="text" name="" placeholder="До" id="">
								</div>
								<div class="tac">
									<input type="submit" value="Показать 5000 объявлений">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="right">
					<div class="items objects">
						@forelse( $category->posts as $post )
							@include('components/post')
						@empty
							Актуальных объявлений на данную категорию нет.
						@endforelse
					</div>
					@if( $category->posts->count() )
						<div class="btn">Показать еще объявления</div>
					@endif
				</div>
			</div>
		</section>
	</main>
@endsection
