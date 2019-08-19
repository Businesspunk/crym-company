<div class="items objects">
    @foreach( $posts as $post )
        @include('components/post')
    @endforeach
</div>
@if( $posts->hasMorePages() )
<div data-type="{{ $type }}" data-page="2" class="btn showMorePosts">Показать еще объявления</div>
@endif