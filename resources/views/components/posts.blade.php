<div class="items objects">
    @forelse( $posts as $post )
        @include('components/post')
    @empty
        <p>Пока нет объявлений</p>
    @endforelse
</div>
@if( $posts->hasMorePages() )
<div data-type="{{ $type }}" data-page="2" class="btn showMorePosts">Показать еще объявления</div>
@endif