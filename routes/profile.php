<?php
Route::get('/redaktor/{username}', 'UserController@showRedactor')->name('redaktor');

Route::group(['namespace' => 'Profile', 'middleware' => 'auth'], function () {
    Route::get('profil', 'ProfileController@show')->name('user.profile');
    Route::get('edycja-profilu', 'ProfileController@edit')->name('user.profile-edit');
    Route::post('edycja-profilu', 'ProfileController@update')->name('user.profile-update');
    Route::get('zmiana-hasla', 'ProfileController@changePassword')->name('user.password-change');
    Route::post('zmiana-hasla', 'ProfileController@updatePassword')->name('user.password-update');
});