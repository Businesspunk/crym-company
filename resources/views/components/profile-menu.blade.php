 <section class="profile-menu">
	<div class="container">
		<div class="left">
			<a href="{{ route('main') }}">
				<img src="{{ asset('img/logo.png?v=2') }}" alt="" class="logo_photo">
			</a>
		</div>
		<div class="right">
			<div class="links">
				<a href="{{ route('my-posts') }}">Мои объявления</a>
				<a href="{{ route('my-bookmarks') }}">Закладки</a>
				<a href="{{ route('my-settings') }}">Настройки</a>
				<a href="{{ route('messageToSupport') }}">Помощь</a>
			</div>
		</div>
	</div>
</section>