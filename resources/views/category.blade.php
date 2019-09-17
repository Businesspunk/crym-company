@extends('components.layout')

@section('content')
	<main>
		<form action="{{ route('search') }}">
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
						@isset($category)
							@foreach( $category->maincategory->attributes as $attrib )
								@include('components.attribute', ['attribute' => $attrib])
							@endforeach
						@endisset
						<div class="item filter">
							<div class="name">Цена</div>
							<div class="form">
								<div class="wrap">
									<input type="number" name="min_price" @if( request()->min_price ) value="{{ (request()->min_price) }}" @endif placeholder="От руб.">
									<input type="number" name="max_price" @if( request()->max_price ) value="{{ (request()->max_price) }}" @endif  placeholder="До руб.">
								</div>
								<div class="tac">
									<input type="submit" value="Поиск">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="right">
					{!! $posts !!}
				</div>
			</div>
		</section>
		</form>
	</main>
@endsection
