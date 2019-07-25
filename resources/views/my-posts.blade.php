@extends('components.layout')

@section('content')
<main>
	<?php $activePage = 'my-posts.php'; ?>
	@include('components.profile-menu')
	<section class="my-posts">
		<div class="container">
			<div class="toggle_button">
				<div class="wrap">
					<div class="h4">
						<a data-target=".active" class="active myPostsChangeType" href="#" >Активные</a>
					</div>
					<div class="h4">
						<a data-target=".close" class="myPostsChangeType" href="#">Закрытые</a>
					</div>
				</div>
			</div>
			<div class="contt">
				<div class="active">
					<div class="wrap_g">
						<?php for($i = 0; $i < 2; $i++): ?>
								@include('components.post-2')
						<?php endfor; ?>
					</div>
				</div>
				<div class="close">
					<div class="wrap_g">
						<?php for($i = 0; $i < 7; $i++): ?>
								@include('components.post-2')
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection