<?php

use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT',99999);
Route::group(['namespace'=>'Admin','middleware' => 'auth:admin'], function() {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');

    ### users ###
    Route::group(['prefix' => 'users'], function () {
        Route::get('/','UsersController@index') -> name('admin.users');
        Route::get('create','UsersController@create') -> name('admin.users.create');
        Route::post('create/fetch', 'UsersController@fetch')->name('create/fetch');
        Route::post('store','UsersController@store') -> name('admin.users.store');
        Route::get('edit/{id}','UsersController@edit') -> name('admin.users.edit');
        Route::post('update/{id}','UsersController@update') -> name('admin.users.update');
        Route::get('delete/{id}','UsersController@destroy') -> name('admin.users.delete');
        Route::get('changeStatus/{id}','UsersController@changeStatus') -> name('admin.users.status');
    });


     ### dogs ###
     Route::group(['prefix' => 'dogs'], function () {
        Route::resource('fetch', 'DogsController');
        Route::post('refusal/insertRefusal', 'DogsController@insertRefusal')->name('refusal.insertRefusal');
        Route::get('/','DogsController@index') -> name('admin.dogs');
        Route::get('create','DogsController@create') -> name('admin.dogs.create');
        Route::post('store','DogsController@store') -> name('admin.dogs.store');
        Route::get('createAccessories','DogsController@createAccessories') -> name('admin.dogs.createAccessories');
        Route::post('storeAccessories','DogsController@storeAccessories') -> name('admin.dogs.storeAccessories');
        Route::get('delete/{id}','DogsController@destroy') -> name('admin.dogs.delete');
        Route::get('changeStatus/{id}','DogsController@changeStatus') -> name('admin.dogs.status');
    });

    ### guides ###
    Route::group(['prefix' => 'guides'], function () {
        Route::resource('fetch', 'GuidesController');
        Route::post('refusal/insertRefusalTwo', 'GuidesController@insertRefusalTwo')->name('refusal.insertRefusalTwo');
        Route::get('/','GuidesController@index') -> name('admin.guides');
        Route::get('create','GuidesController@create') -> name('admin.guides.create');
        Route::post('store','GuidesController@store') -> name('admin.guides.store');
        Route::get('delete/{id}','GuidesController@destroy') -> name('admin.guides.delete');
        Route::get('changeStatus/{id}','GuidesController@changeStatus') -> name('admin.guides.status');
    });

        ### slides ###
        Route::group(['prefix' => 'slides'], function () {
            Route::get('/','SlidesController@index') -> name('admin.slides');
            Route::get('create','SlidesController@create') -> name('admin.slides.create');
            Route::post('store','SlidesController@store') -> name('admin.slides.store');
            Route::get('edit/{id}','SlidesController@edit') -> name('admin.slides.edit');
            Route::post('update/{id}','SlidesController@update') -> name('admin.slides.update');
            Route::get('delete/{id}','SlidesController@destroy') -> name('admin.slides.delete');
            Route::get('changeStatus/{id}','SlidesController@changeStatus') -> name('admin.slides.status');
        });

        ### areas ###
        Route::group(['prefix' => 'areas'], function () {
            Route::get('/','AreasController@index') -> name('admin.areas');
            Route::get('create','AreasController@create') -> name('admin.areas.create');
            Route::post('store','AreasController@store') -> name('admin.areas.store');
            Route::get('edit/{id}','AreasController@edit') -> name('admin.areas.edit');
            Route::post('update/{id}','AreasController@update') -> name('admin.areas.update');
            Route::get('delete/{id}','AreasController@destroy') -> name('admin.areas.delete');
            Route::get('changeStatus/{id}','AreasController@changeStatus') -> name('admin.areas.status');
        });

        ### testimonials ###
        Route::group(['prefix' => 'testimonials'], function () {
            Route::get('/','TestimonialsController@index') -> name('admin.testimonials');
            Route::get('create','TestimonialsController@create') -> name('admin.testimonials.create');
            Route::post('store','TestimonialsController@store') -> name('admin.testimonials.store');
            Route::get('edit/{id}','TestimonialsController@edit') -> name('admin.testimonials.edit');
            Route::post('update/{id}','TestimonialsController@update') -> name('admin.testimonials.update');
            Route::get('delete/{id}','TestimonialsController@destroy') -> name('admin.testimonials.delete');
            Route::get('changeStatus/{id}','TestimonialsController@changeStatus') -> name('admin.testimonials.status');
        });

        ### requestsUser ###
        Route::group(['prefix' => 'requestsUser'], function () {
            Route::get('/','RequestsUserController@index') -> name('admin.requestsUser');
            Route::get('acc/{userId}/{type}/{id}','RequestsUserController@acc') -> name('admin.requestsUser.acc');
            Route::post('refusal/insertRefusalThree', 'RequestsUserController@insertRefusalThree')->name('refusal.insertRefusalThree');
            Route::get('delete/{id}','RequestsUserController@destroy') -> name('admin.requestsUser.delete');
        });
        
        ### BackUP ###
        Route::group(['prefix' => 'backup'], function () {
            Route::get('/','BackupController@index')->name('admin.backup');
            Route::post('getbackup', 'BackupController@backUp')->name('admin.backup.getbackup');
            Route::post('getbackupTwo', 'BackupController@backUpTwo')->name('admin.backup.getbackupTwo');
        });
});


Route::group(['namespace'=>'Admin','middleware' => 'guest:admin'], function(){
     Route::get('login' ,'LoginController@getLogin')->name('get.admin.login');
     Route::post('login' ,'LoginController@login')->name('admin.login');
});