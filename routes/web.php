<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/projects', 'App\Http\Controllers\ProjectController@index')->name('projects.index');
    Route::get('/projects/id/{project}', 'App\Http\Controllers\ProjectController@show')->name('projects.show');
    Route::get('/projects/create/', 'App\Http\Controllers\ProjectController@create')->name('projects.create');
    Route::get('/project/edit/{project}', 'App\Http\Controllers\ProjectController@editproject')->name('projects.edit');
    Route::get('/projects/remove', 'App\Http\Controllers\ProjectController@destroy')->name('projects.destroy');
    Route::get('/projects/addfile/{project}', 'App\Http\Controllers\ProjectController@addfile')->name('projects.add');
    Route::post('/projects/store', 'App\Http\Controllers\ProjectController@store')->name('projects.store');
    Route::post('/projects/update', 'App\Http\Controllers\ProjectController@update')->name('projects.update');
    Route::post('/projects/uploadfile', 'App\Http\Controllers\ProjectController@uploadfile')->name('projects.upload');
});