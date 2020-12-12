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
<?php $page_type = 'page_'.$type; 
    $page = request()->input($page_type);
    $page = $page ? (int) $page + 1 : 2;
    ?>
<div data-type="{{ $type }}" data-page="{{ $page }}" class="btn showMorePosts">Показать еще объявления</div>
@endif