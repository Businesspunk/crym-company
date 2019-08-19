<div class="people">
	<div class="line_1">
		<div class="left_2">
			<img src="{{ getAvatarSrc($post->user) }}" alt="">
		</div>
		<div class="right_2">
			<div class="line_11">
				<div class="name">{{ $post->user->name }}</div>
				<div class="isOnline">Онлайн</div>
			</div>
			<div class="line_33">
				( {{ trans_choice('messages.posts', $post->user->posts->count(),  ['count' => $post->user->posts->count()]) }} )
			</div>
		</div>
	</div>
	<div class="line_2">
		Адрес:
		<div class="address">
			{{ getNameByGeo($post) }}
		</div>
	</div>
</div>