<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/****************************** with /api *******************************/
Route::group(['middleware' => ['api'], 'namespace' => 'API'], function () {
    Route::get('countries', 'CscController@countries');
    Route::get('states/{countries}', 'CscController@states');
    Route::get('cities/{states}', 'CscController@cities');
});



/***************** with /api and api password ***************************/
Route::group(['middleware' => ['api','checkPassword'], 'namespace' => 'API'], function () {
    //user
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'RegisterController@login');
    Route::post('handleFacebookLogin', 'RegisterController@handleFacebookLogin');
    Route::post('handleGoogleLogin', 'RegisterController@handleGoogleLogin');
    //home page
    Route::post('slide', 'PagesController@slide');
    Route::post('testimonial', 'PagesController@testimonial');
    Route::post('randomDogs', 'PagesController@randomDogs');
    //allPets page
    Route::post('allDogs', 'PagesController@allDogs');
    Route::post('filterDogs/{type}', 'PagesController@filterDogs');
    Route::post('search', 'PagesController@searchSDogs');
    //Service
    Route::post('service', 'PagesController@allService');
    Route::post('service/{type}', 'PagesController@service');
    //contactus
    Route::post('contactus', 'PagesController@contactus');
    //single page dog (userId or null)
    Route::post('single/{id}/{userId}', 'PagesController@showDog');
    //single page service (userId or null)
    Route::post('singleGuide/{id}/{type}/{userId}', 'PagesController@showSingleGuide');
    //getPost
    Route::post('getPost/{id}/{type}', 'CommentsController@getPost');
    //getComment
    Route::post('getComment/{postId}', 'CommentsController@getComment');
    //Rest password
    Route::post('ResetPasswordApi', 'RegisterController@ResetPasswordApi');
});

/********************** with /api and api password and token *************/
Route::group(['middleware' => ['auth:api','checkPassword'], 'namespace' => 'API'], function () {
    Route::post('detailsUser', 'RegisterController@detailsUser');
    Route::post('editUser', 'RegisterController@editUser');
    Route::post('removeProfile', 'RegisterController@removeProfile');
    //add rating dog
    Route::post('rating', 'TokenController@ratingDog');
    //add rating service
    Route::post('ratingService', 'TokenController@ratingGuide');
    //wishlist dog
    Route::post('wishlist', 'TokenController@wishlist');
    Route::post('getWishlist', 'TokenController@getWishlist');
    Route::post('destroyWishlist/{id}', 'TokenController@destroyWishlist');
    //insert post
    Route::post('post', 'CommentsController@post');
    //insert comment
    Route::post('makeComment', 'CommentsController@makeComment');
    //ReservationUser
    Route::post('ReservationUser', 'TokenController@ReservationUser');
    //add dog
    Route::post('add', 'TokenController@addDog');
    //add Accessories
    Route::post('addAccessories', 'TokenController@addAccessories');
    //displayed
    Route::post('displayed', 'TokenController@displayed');
    Route::post('destroyDisplayed/{id}', 'TokenController@destroyDisplayed');
    Route::post('destroyDisplayedRefusal/{id}', 'TokenController@destroyDisplayedRefusal');
    Route::post('destroyDisplayedGuide/{id}', 'TokenController@destroyDisplayedGuide');
    Route::post('destroyDisplayedUserR/{id}', 'TokenController@destroyDisplayedUserR');
    //sendReqUser
    Route::post('sendReqUser', 'TokenController@sendReqUser');
});


