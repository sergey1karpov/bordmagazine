<?php

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('', 'MainPageController@index')->name('musics'); //Main Page

Route::resource('/post', 'PostController'); //Music
Route::resource('/video', 'VideoController'); //Video
Route::resource('/article', 'ArticleController'); //Article
Route::resource('/blog', 'BlogController'); //Blog

Route::post('/post/{id}/', 'CommentController@store')->name('addMusicComment'); //Music comments
Route::delete('/post/delete/{id}', 'CommentController@deleteMusicComment')->name('delMusicComment');

Route::post('/video/{id}/', 'CommentController@video_store')->name('addVideoComment'); //Video comments
Route::delete('/video/delete/{id}', 'CommentController@deleteVideoComment')->name('delVideoComment');

Route::post('/article/{id}/', 'CommentController@article_store')->name('addArticleComment'); //Article comments
Route::delete('/article/delete/{id}', 'CommentController@deleteArticleComment')->name('delArticleComment');

Route::get('/contacts', 'SendEmailController@index'); //Send Mail
Route::post('/contacts/send', 'SendEmailController@send');

Route::get('search', 'SearchController@search')->name('search'); //Search

Route::get('home', 'AdminController@admin')->name('home'); //Admin page
Route::patch('home/edit/{userId}', 'AdminController@editAdminForUsers')->name('editAdminForUsers');

// Profile
// Route::get('/id{id}', 'ProfileController@index')->name('profile'); //Отобр профиля

// Route::post('/{id}/store', 'ProfileController@store')->name('profile.store')->middleware('throttle:20,1440'); //Публикует пост

// Route::get('/id{id}/post/{postId}', 'ProfileController@post')->name('userPost');
// Route::patch('/id{id}/{postId}/edit', 'ProfileController@editPost')->name('editPost');

// Route::get('/{id}/edit', 'ProfileController@showEditProfileInformationPage')->name('editProfile'); //Показ стр редакт
// Route::patch('/{id}/edit', 'ProfileController@editProfileInformation')->name('editProfileInformation'); //Редакт
// Route::delete('delete/{id}', 'ProfileController@delete')->name('deletePost');

// Route::get('/id{id}/video', 'ProfileController@allVideo')->name('allVideo');
// Route::get('/id{id}/video/{video}', 'ProfileController@video')->name('video');
// Route::post('/id{id}/video/create', 'ProfileController@addProfileVideo')->name('addProfileVideo')->middleware('throttle:10,1440');
// Route::patch('/id{id}/video/{video}/update', 'ProfileController@updateVideo')->name('updateVideo');
// Route::delete('/id{id}/video/delete', 'ProfileController@deleteVideo')->name('deleteVideo');

// Route::get('/id{id}/audio', 'ProfileController@allAlbums')->name('allAlbums');
// Route::get('/id{id}/audio/{album}', 'ProfileController@album')->name('album');
// Route::post('/id{id}/audio/create', 'ProfileController@addProfileAlbums')->name('addProfileAlbums')->middleware('throttle:10,1440');
// Route::patch('/id{id}/audio/{album}/update', 'ProfileController@updateAlbum')->name('updateAlbum');
// Route::delete('/id{id}/audio/delete', 'ProfileController@deleteAlbums')->name('deleteAlbums');

// Route::get('about', 'MainPageController@about')->name('about');
// Route::get('rules', 'MainPageController@rules')->name('rules');
// Route::get('reference', 'MainPageController@reference')->name('reference');

// Route::get('/id{id}/events', 'ProfileController@events')->name('events');
// Route::get('/id{id}/events/{event}', 'ProfileController@event')->name('event');
// Route::post('/id{id}/events/addevent', 'ProfileController@addEvent')->name('addEvent')->middleware('throttle:40,1440');
// Route::patch('/id{id}/events/{event}/edit', 'ProfileController@editEvent')->name('editEvent');
// Route::delete('/id{id}/events/{event}/delete', 'ProfileController@deleteEvent')->name('deleteEvent');

// Route::delete('/{id}/delete', 'ProfileController@deleteUser')->name('deleteUser');
// Route::patch('/{id}/deletebanner', 'ProfileController@deleteBanner')->name('deleteBanner');


























