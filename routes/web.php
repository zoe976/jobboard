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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'AddJobsController@index');
Route::post('/add_job', 'AddJobsController@addJob');
Route::get('/moderator', 'AddJobsController@moderateJob');



Route::get('/jobs', 'JobsController@index');
