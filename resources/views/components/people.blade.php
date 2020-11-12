<div class="people">
	<div class="line_1">
		<div class="left_2">
			<img src="{{ getAvatarSrc($user) }}" alt="">
		</div>
		<div class="right_2">
			<div class="line_11">
				<a href="{{ route('profile.other', $user->id) }}" class="name">{{ $user->name }}</a>
				<!--<div class="isOnline">Онлайн</div> -->
			</div>
			<div class="line_33">
				( {{ num_decline($user->posts->count(), ['объявление', 'объявления', 'объявлений']) }} )
			</div>
			<div class="site_date_from" >Зарегистрирован на сайте с {{ $user->created_at->format('m.Y') }}</div>
		</div>
	</div>
</div>