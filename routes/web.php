<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/','FrontendController@index')->name('frontend.home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}','FrontendController@profile')->name('post#profile');
Route::get('admin/home', 'AdminController@index')->name('admin.home')->middleware('AdminAccess');
Route::get('/admin/postlist','AdminController@postList')->name('admin#postlist');
Route::get('/admin/userlist','AdminController@userList')->name('admin#userlist');
Route::get('/admin/rolelist','AdminController@roleList')->name('admin#rolelist');
Route::get('/search','FrontendController@search')->name('frontend.search');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('post', 'PostController');
    Route::patch('/publish/{id}','AdminController@publish')->name('publish');
    Route::get('/editprofile/{id}','AdminController@editProfile')->name('edit#profile');
    Route::put('/updateprofile/{id}','AdminController@updateProfile')->name('update#profile');
    Route::delete('users/{id}','AdminController@deleUser')->name('deleteUser');
    Route::delete('remove/{id}','AdminController@deleAccount')->name('deleAccount');
    Route::get('post-export-excel','FrontendController@exportIntoExcel')->name('post#excel');
    Route::get('post-export-csv','FrontendController@exportIntoCSV')->name('post#csv');
    Route::get('user-export-excel','FrontendController@userExcel')->name('user#excel');
    Route::get('user-export-csv','FrontendController@userCSV')->name('user#csv');
    Route::post('post-import','FrontendController@import')->name('post#import');
});
