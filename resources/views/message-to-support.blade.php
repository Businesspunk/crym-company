@extends('components/layout')

@section('after_js')
	{!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
<main>
	<div class="container">
		@isset( $breadcrumbs )
			{{ $breadcrumbs }}
		@endisset
	</div>
	@include('components/sub-menu', ['title' => 'Помощь'])

	
	<section class="message-to-support">
		<div class="container">
			<div class="h4">Написать в техподдержку </div>
			@if($errors->hasBag('captcha'))
				<div class="alert alert-danger" role="alert">
					{{ $errors->captcha->first('g-recaptcha-response') }}
				</div>
			@endif

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
						<input name="name" value="{{ old('name') }}" type="text" placeholder="Ваше имя">
					</div>
				</div>
				<div class="wrap email">
					<div class="left">
						Электронная почта
					</div>
					<div class="right">
						<input name="email" value="{{ old('email') }}" type="text" placeholder="Ваш email">
					</div>
				</div>
				
				<textarea style="margin-bottom: 20px;" name="message" placeholder="Сообщение" rows="10">{{ old('message') }}</textarea>
				{!! htmlFormSnippet() !!}
				<input type="submit" value="Отправить">
			</form>
		</div>
	</section>
</main>
@endsection