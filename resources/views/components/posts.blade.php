@if($posts->count()) 
    <div class="items objects">
        @foreach( $posts as $post )
            @include('components/post')
        @endforeach
    </div>
@else
    <div class="alert alert-secondary nothing_found" role="alert">
        Объявления не найдены
    </div>
@endif
@if( $posts->hasMorePages() )
<div data-type="{{ $type }}" data-page="2" class="btn showMorePosts">Показать еще объявления</div>
@endif