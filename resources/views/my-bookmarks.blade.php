@extends('components.layout')

@section('content')
<main>
	@auth
		@include('components.profile-menu')
	@endauth
	<section class="my-bookmarks">
		<div class="container">
			@if( $bookmarks->count() > 0 )
			<div class="items objects">
				@foreach( $bookmarks as $post )
					@include('components/post')
				@endforeach
			</div>
			@else
				В ваших закладках ничего нет
			@endif
		</div>
	</section>
</main>
@endsection