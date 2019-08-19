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

Auth::routes();

Route::post('/register', 'Auth\RegisterController@register')->name('registerPost');
Route::post('/login', 'Auth\LoginController@login')->name('loginPost');


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', "IndexController@profile")->name('my-profile');
    
    Route::post('/settings', "ProfileController@saveSettings");
    Route::post('/settings/avatarPermanent', "ProfileController@permanentUpload")->name('permanentUploadAvatar');
    Route::post('/settings/updateAvatar', "ProfileController@updateAvatar")->name('updateAvatar');


    Route::get('/settings', "IndexController@settings")->name('my-settings');
    Route::get('/support', "IndexController@support")->name('my-support');
    Route::get('/bookmarks', "IndexController@bookmarks")->name('my-bookmarks');
    Route::get('/messages', "IndexController@messages")->name('my-messages');
    Route::get('/posts', "IndexController@posts")->name('my-posts');

    Route::get('/add', "IndexController@add")->name('addPost');
    Route::post('/add', "PostController@post");
    Route::post('/add/images/ajax', "PostController@ajaxUploadImages")->name('ajaxUploadImages');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/{slug}', 'IndexController@category')->name('category');
Route::get('/posts/{id}', 'IndexController@post')->name('post');

Route::post('/posts/{id}/delete', 'PostController@delete')->name('post.delete');
Route::post('/posts/{id}/close', 'PostController@close')->name('post.close');
