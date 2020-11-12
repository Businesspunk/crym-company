<div class="item">
	<a href="{{ route('post', $post->id) }}" class="photo">
		<i data-favorite-id="{{ $post->id }}" class="fa fa-heart like-link @if( in_array($post->id, $favorites) ) active @endif" aria-hidden="true"></i>
		<img src="{{ getPostPhotoSrc( $post->main_photo ) }}" alt="">
	</a>
	<div class="title">
		<a href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
	</div>
	<div class="cost">{{ get_price($post->cost) }}</div>
	<div class="time">{{ $post->created_at->diffForHumans() }}</div>
</div>
