<div class="item">
	<div class="photo">
		<i class="fa fa-heart" aria-hidden="true"></i>
		<img src="{{ getSavedPhoto( $post->main_photo ) }}" alt="">
	</div>
	<div class="title">
		<a href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
	</div>
	<div class="cost">{{ get_price($post->cost) }}</div>
	<div class="time">{{ $post->created_at->diffForHumans() }}</div>
</div>
