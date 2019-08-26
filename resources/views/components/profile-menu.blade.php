 <section class="profile-menu">
	<div class="container">
		<div class="left">
			<a href="{{ route('main') }}">
				<img src="{{ asset('img/logo.png') }}" alt="" class="logo_photo">
			</a>
		</div>
		<div class="right">
			<div class="links">
				<a href="{{ route('my-posts') }}">Мои объявления</a>
				<a href="{{ route('my-messages') }}">Мои сообщения</a>
				<a href="{{ route('my-bookmarks') }}">Закладки</a>
				<a href="{{ route('my-settings') }}">Настройки</a>
				<a href="{{ route('my-support') }}">Помощь</a>
			</div>
		</div>
	</div>
</section>