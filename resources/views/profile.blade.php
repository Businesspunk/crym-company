@extends('components.layout')

@section('after_css')
	<style>
		.left .btn.btn-danger{
			margin-top: 20px;
		}
	</style>
@endsection

@section('content')
<main>
	
	<section class="profile">
		<div class="container">
			<div class="left">
				@include('components.people')
				@auth
					@if( ( Auth::user() )->can('delete', $user) )
						<a class="btn btn-danger" data-toggle="modal" data-target="#deleteUser" href="#">Удалить пользователя</a>
					@endif
				@endauth
			</div>
			<div class="right">
				<div class="head">
					<div class="item">
						<div class="h4">
							<a class="in-sale active" data-target=".in-sale" href="#">В продаже</a>
						</div>
					</div>
					<div class="item">
						<div class="h4">
							<a class="in-sale" data-target=".from-sale" href="#">Продано</a>
						</div>
					</div>
				</div>
				<div class="body">
					<div class="in-sale active hiddable">
						<div class="items objects">
							@foreach( $activePosts as $post )
								@include('components/post')
							@endforeach
						</div>
					</div>
					<div class="from-sale hidden hiddable">
						<div class="items objects">
							@foreach( $closedPosts as $post )
								@include('components/post')
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Удалить пользователя?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<form method="POST" action="{{ route('user.delete', $user->id) }}">
						@csrf
						<button type="submit" class="btn btn-danger">Удалить</button>
					</form>
				</div>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection