<?php 

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('main'));
});

Breadcrumbs::for('all_posts', function ($trail) {
    $trail->parent('home');
    $trail->push('Объявления', route('posts'));
});

Breadcrumbs::for('maincategory', function ($trail, $maincategory) {
    
    $trail->parent('all_posts');
    $trail->push( cyrFLtoUpper( $maincategory->name ) , route('maincategory', $maincategory->slug));

});

Breadcrumbs::for('category', function ($trail, $maincategory, $category) {
    
    $trail->parent('maincategory', $maincategory);
    $trail->push( cyrFLtoUpper( $category->name ) , route('category', [
        'maincategory' => $maincategory->slug,
        'slug' => $category->slug
    ]));

});


Breadcrumbs::for('categoryByAttribute', function ($trail, $maincategory, $category, $attribute_value , $attribute) {
    
    $trail->parent('category', $maincategory, $category);


    if( $attribute_value->value ){
        $name = $attribute_value->value.' '.$attribute->name;
    }else{
        $name = $attribute->name;
    }

    $trail->push( cyrFLtoUpper( $name ) , route('attributeByCategory', [
        'category' => $category->slug,
        'attribute' => $attribute->slug,
        'value' => $attribute_value->value_slug
    ]));


});


Breadcrumbs::for('maincategoryByAttribute', function ($trail, $maincategory, $attribute_value , $attribute) {
    
    $trail->parent('maincategory', $maincategory);

    if( $attribute_value->value ){
        $name = $attribute_value->value.' '.$attribute->name;
    }else{
        $name = $attribute->name;
    }

    $trail->push( cyrFLtoUpper( $name ) , route('attributeByMaincategory', [
        'category' => $maincategory->slug,
        'attribute' => $attribute->slug,
        'value' => $attribute_value->value_slug
    ]));


});


Breadcrumbs::for('messageToSupport', function ($trail) {
    $trail->parent('home');
    $trail->push('Помощь', route('messageToSupport'));
});

Breadcrumbs::for('goodOffers', function ($trail) {
    $trail->parent('home');
    $trail->push('Недвижимость на особых условиях', route('goodOffers'));
});

Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('all_posts');
    $trail->push( cyrFLtoUpper( $post->title ), route('post', $post->id));
});

Breadcrumbs::for('my-posts', function ($trail) {
    $trail->parent('home');
    $trail->push( 'Мои объявления', route('my-posts'));
});

Breadcrumbs::for('bookmarks', function ($trail) {
    $trail->parent('home');
    $trail->push( 'Закладки', route('my-bookmarks'));
});

Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push( 'Настройки', route('my-settings'));
});

Breadcrumbs::for('add_post', function ($trail) {
    $trail->parent('home');
    $trail->push( 'Добавление объявления', route('addPost'));
});


Breadcrumbs::for('edit_post', function ($trail, $post) {
    $trail->parent('post', $post);
    $trail->push( 'Редактирование объявления', route('post.edit', $post->id ));
});

Breadcrumbs::for('my_messages', function ($trail) {
    $trail->parent('home');
    $trail->push( 'Мои сообщения', route('messages'));
});