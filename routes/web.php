<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "IndexController@mainPage")->name('main');

Route::get('/agreement', "IndexController@agreementUser")->name('agreement.user');
Route::get('/privacypolicy', "IndexController@privacyPolicy")->name('agreement.privacyPolicy');
Route::get('/oferta', "IndexController@oferta")->name('agreement.oferta');

Route::get('/pay', "PaymentController@payForPomotion")->name('payForPomotion');

Route::post('/successpayment', 'PaymentController@successPayment');

Route::post('/promotion/calculate', "PromotionController@getPromoTemplate")->name('getPromoTemplate');


Auth::routes();

Route::post('/register', 'Auth\RegisterController@register')->name('registerPost');
Route::post('/login', 'Auth\LoginController@login')->name('loginPost');

Route::get('/message-to-support', "IndexController@messageToSupport")->name('messageToSupport');
Route::post('/message-to-support', "MailController@messageToAdmin");

Route::get('/nedvizhimost-na-osobyh-usloviyah', "IndexController@goodOffers")->name('goodOffers');

Route::get('/maincategory/{maincategory}', "IndexController@maincategory")->name('maincategory');
Route::get('/category/{maincategory}/{slug}', 'IndexController@category')->name('category');

Route::get('/category/{category}/attribute/{attribute}/{value?}', "IndexController@categoryByAttribute")->name('attributeByCategory');

Route::get('/maincategory/{category}/attribute/{attribute}/{value?}', "IndexController@maincategoryByAttribute")->name('attributeByMaincategory');


Route::middleware(['auth'])->group(function () {

    Route::post('/setaccounttype', 'ProfileController@chooseAccountType')->name('setaccounttype');


    Route::get('/messages/to/{to}/{post_id}', "MessageController@writeMessage")->name('dialog.start');
    Route::post('/messages/send', "MessageController@send")->name('message.send');

    Route::post('/settings', "ProfileController@saveSettings");
    Route::post('/settings/avatarPermanent', "ProfileController@permanentUpload")->name('permanentUploadAvatar');
    Route::post('/settings/updateAvatar', "ProfileController@updateAvatar")->name('updateAvatar');


    Route::get('/settings', "IndexController@settings")->name('my-settings');
    Route::get('/support', "IndexController@support")->name('my-support');
    Route::get('/messages', "MessageController@messages")->name('messages');
    
    Route::get('/logout', 'IndexController@logout')->name('logout');

    Route::get('/my-posts', "IndexController@myposts")->name('my-posts');

    Route::get('/add', "IndexController@add")->name('addPost');
    Route::post('/add', "PostController@post");
    Route::post('/add/images/ajax', "PostController@ajaxUploadImages")->name('ajaxUploadImages');

    Route::get('/posts/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::post('/posts/{id}/edit', 'PostController@update')->name('post.update');
    Route::post('/posts/{id}/delete', 'PostController@delete')->name('post.delete');
    Route::post('/posts/{id}/close', 'PostController@close')->name('post.close');

    Route::post('/profiles/{id}/delete', 'ProfileController@deleteUser')->name('user.delete');

    Route::post('/changepassword', 'ProfileController@changePasswordVip')->name('vip.changepassword');

    
});

Route::get('/bookmarks', "IndexController@bookmarks")->name('my-bookmarks');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/vk', 'SocialAuthController@authByVk')->name('authByVk');
Route::get('/auth/facebook', 'SocialAuthController@authByFB')->name('authByFacebook');



Route::get('/search', 'IndexController@searchCheck')->name('search');

Route::get('/posts', 'IndexController@posts')->name('posts');

Route::get('/posts/{id}', 'IndexController@post')->name('post');



Route::get('/profile/{id}', 'IndexController@profile')->name('profile.other');
