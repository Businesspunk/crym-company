@extends('components.layout')

@section('content')
<main>
	@include('components.category')
	<section class="profile">
		<div class="container">
			<div class="left">
				@include('components.people')
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
							<?php for($i = 0; $i < 2; $i++): ?>
									@include('components.post')
							<?php endfor; ?>
						</div>
					</div>
					<div class="from-sale hidden hiddable">
						<div class="items objects">
							<?php for($i = 0; $i < 2; $i++): ?>
									@include('components.post')
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection