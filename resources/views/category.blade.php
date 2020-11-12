@extends('components.layout')

@section('content')
	<main>
		<form action="{{ route('search') }}">

		<div class="container">
			@isset( $breadcrumbs )
				{{ $breadcrumbs }}
			@endisset
		</div>

		@include('components/category')
		<section class="fourth section--margin-top">
			<div class="container">
				<div class="main_title">
					<h1>
						@if( isset( $title ) )
							{{ upFirstLetter( $title ) }}
						@else
							{{ upFirstLetter( $category->name) }}
						@endif
					</h1>
					<span class="number">{{ $count }}</span>
				</div>

				@isset($attributes_links)
					<div class="attrib_links">
							@if( isset($category) )
								@foreach( $attributes_links as $attrib )
									@foreach( $attrib->getPairsNameAttribAndValue() as $attribute )
										<a href="{{ route('attributeByCategory', [ 
												'category' => $category->slug,
												'attribute' => $attrib->slug,
												'value' => $attribute['value'],
											] ) }}" 
											class="@if( url()->current() == route('attributeByCategory', [ 
												'category' => $category->slug,
												'attribute' => $attrib->slug,
												'value' => $attribute['value'],
											] ) ) active  @endif  btn btn-outline-primary">
											{{ $attribute['name'] }}
										</a>
									@endforeach
								@endforeach
							@else
								@foreach( $attributes_links as $attrib )
									@foreach( $attrib->getPairsNameAttribAndValue() as $attribute )
										<a href="{{ route('attributeByMaincategory', [ 
												'category' => $maincategory->slug,
												'attribute' => $attrib->slug,
												'value' => $attribute['value'],
											] ) }}" 
											class="@if( url()->current() == route('attributeByMaincategory', [ 
												'category' => $maincategory->slug,
												'attribute' => $attrib->slug,
												'value' => $attribute['value'],
											] ) ) active  @endif  btn btn-outline-primary">
											{{ $attribute['name'] }}
										</a>
									@endforeach
								@endforeach
							@endif
					</div>
				@endisset
			</div>
			<div class="container wrap_grid">
				<div class="left">
					<div class="items">
						<div class="item named">
						@if( isset( $title ) )
							{{ $title }}
						@else
							{{ $category->name }}
						@endif
						</div>
						@isset($attributes)
							@foreach( $attributes as $attrib )
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
					@include('components/posts', ['type' => 'category' ])
				</div>
			</div>
		</section>
		</form>
	</main>
@endsection
