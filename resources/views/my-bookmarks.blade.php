@extends('components.layout')

@section('main')
<main>
	<?php $activePage = 'my-bookmarks.php'; ?>
	@include('components.profile-menu')
	<section class="my-bookmarks">
		<div class="container">
			<div class="items objects">
			<?php for($i = 0; $i < 5; $i++): ?>
				@include('components.post')
			<?php endfor; ?>
			</div>
		</div>
	</section>
</main>
@endsection