@extends('components.layout')

@section('content')
	<main>
		@include('components/category')
		<section class="fourth section--margin-top">
			<div class="container">
				<div class="main_title">
					<span>
						@if( isset( $catalog ) )
							Объявления
						@else
							{{ $category->name }}
						@endif
					</span>
					<span class="number">{{ $count }}</span>
				</div>
			</div>
			<div class="container wrap_grid">
				<div class="left">
					<div class="items">
						<div class="item named">
						@if( isset($catalog) )
							Объявления
						@else
							{{ $category->name }}
						@endif
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
					{!! $posts !!}
				</div>
			</div>
		</section>
	</main>
@endsection
