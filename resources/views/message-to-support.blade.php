@extends('components/layout')

@section('content')
<main>
	@include('components/sub-menu', ['title' => 'Помощь'])
	<section class="message-to-support">
		<div class="container">
			<div class="h4">Написать в техподдержку </div>
			@if (\Session::has('success'))
				<div class="alert alert-success" role="alert">
					{{ \Session::get('success') }}
				</div>
			@endif
			<form method="POST">
				@csrf
				<div class="wrap topic">
					<div class="left">
						Имя
					</div>
					<div class="right">
						<input name="name" type="text" placeholder="Ваше имя">
					</div>
				</div>
				<div class="wrap email">
					<div class="left">
						Электронная почта
					</div>
					<div class="right">
						<input name="email" type="text" placeholder="Ваш email">
					</div>
				</div>
				
				<textarea name="message" placeholder="Сообщение" rows="10"></textarea>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</section>
</main>
@endsection