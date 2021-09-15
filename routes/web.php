<?php

use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT_USER',12);

//Home
Auth::routes();
Route::get('/', 'PagesController@index')->name('home');
Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('not-active', 'HomeController@notActive')->name('not-active');

//allPets
Route::get('allPets', 'PagesController@allPets')->name('allPets');
Route::get('allDogs', 'PagesController@allDogs')->name('allDogs');
Route::get('filterDogs/{type}', 'PagesController@filterDogs')->name('filterDogs');

//DynamicDependent
Route::get('sign-up', 'DynamicDependent@index')->name('sign-up');
Route::post('reg/fetch', 'DynamicDependent@fetch')->name('reg.fetch');

//user->type = active (1)
Route::get('add', 'HomeController@add')->name('add');
Route::post('add','SelldogsController@store');

//profile
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/fetch', 'HomeController@profileFetch')->name('profile.fetch');
Route::post('profile', 'HomeController@updateProfile')->name('profile');
Route::post('removeProfile', 'HomeController@removeProfile')->name('removeProfile');

//guides
Route::get('addGuides', 'GuideController@index')->name('addGuides');
Route::post('addGuides','GuideController@store')->name('addGuides');

//displayed
Route::get('displayed', 'HomeController@displayed')->name('displayed');
Route::get('displayed/delete/{id}','HomeController@destroyDisplayed')->name('displayed.delete');
Route::get('destroyDisplayedRefusal/delete/{id}','HomeController@destroyDisplayedRefusal')->name('destroyDisplayedRefusal.delete');
Route::get('destroyDisplayedGuide/delete/{id}','HomeController@destroyDisplayedGuide')->name('destroyDisplayedGuide.delete');
Route::get('destroyDisplayedUserR/delete/{id}','HomeController@destroyDisplayedUserR')->name('destroyDisplayedUserR.delete');

//single
Route::get('single/{id}', 'PagesController@show')->name('single');
Route::post('rating', 'SelldogsController@rating')->name('single.rating');

//single guide
Route::get('singleGuide/{id}/{type}', 'PagesController@singleGuide')->name('singleGuide');
Route::post('ratingGuide', 'GuideController@ratingGuide')->name('singleGuide.ratingGuide');

//Comment System
Route::post('post', 'PostController@post')->name('post');
Route::get('show/{id}/{type}', 'PostController@getPost')->name('show');
Route::get('getcomment', 'PostController@getComment')->name('getcomment');
Route::post('writecomment', 'PostController@makeComment')->name('writecomment');

//About Us
Route::get('about', 'PagesController@about')->name('about');

//contact Us
Route::get('contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@store')->name('contact');

//Our Service
Route::get('clinic', 'PagesController@clinic')->name('clinic');
Route::get('pharmacy', 'PagesController@pharmacy')->name('pharmacy');
Route::get('market', 'PagesController@market')->name('market');
Route::get('company', 'PagesController@company')->name('company');
Route::get('school', 'PagesController@school')->name('school');

//send sms or email 
route::post('/sendSms','GuideController@sendSms')->name('sendSms');

//reqUser
Route::get('reqUser', 'HomeController@reqUser')->name('reqUser');
Route::post('sendReqUser', 'HomeController@sendReqUser')->name('sendReqUser');

//wishlist
Route::post('wishlist', 'SelldogsController@wishlist')->name('single.wishlist');
Route::post('wishlist/delete','SelldogsController@deleteWishlist')->name('single.deleteWishlist');
Route::get('getWishlist', 'SelldogsController@getWishlist')->name('getWishlist');
Route::get('getWishlist/delete/{id}','SelldogsController@destroyGetWishlist')->name('getWishlist.delete');

//Accessories
Route::get('accessories', 'HomeController@accessories')->name('accessories');
Route::post('addAccessories', 'SelldogsController@addAccessories')->name('addAccessories');

//facebook
Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('/callback/facebook', 'Auth\LoginController@handleFacebookCallback'); Route::get('privacy-policy', 'PagesController@privacyPolicy');

//Google
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

//search
Route::get('search', 'PagesController@search')->name('search');
