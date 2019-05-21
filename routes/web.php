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
Route::get('register', function () {
    return redirect('/login');
});
Auth::routes(['register' => false]);

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/remontas', 'RepairsController@public');
Route::get('/remontas/publicSearch', 'RepairsController@publicSearch');

Auth::routes();

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::resource('users', 'UsersController')->middleware('auth');

Route::resource('repairs', 'RepairsController')->middleware('auth');
Route::get('thisMonthRepairs', 'RepairsController@thisMonthRepairs')->middleware('auth');
Route::get('newRepairs', 'RepairsController@newRepairs')->middleware('auth');
Route::get('notFinishedRepairs', 'RepairsController@notFinishedRepairs')->middleware('auth');
Route::get('isShowingRepair', 'RepairsController@isShowing')->middleware('auth');
Route::get('/repairs/{id}/print', 'RepairsController@printPDF')->middleware('auth');
Route::post('/repairs/search', 'RepairsController@search')->middleware('auth');


Route::resource('clients', 'ClientController')->middleware('auth');

Route::resource('services', 'ServiceController')->middleware('auth');
Route::get('thisMonthServices', 'ServiceController@thisMonthServices')->middleware('auth');
Route::get('newServices', 'ServiceController@newServices')->middleware('auth');
Route::get('notFinishedServices', 'ServiceController@notFinishedServices')->middleware('auth');
Route::get('isShowingService', 'ServiceController@isShowing')->middleware('auth');
Route::get('/services/{id}/print', 'ServiceController@printPDF')->middleware('auth');
Route::post('/services/search', 'ServiceController@search')->middleware('auth');

Route::get('/trackNote','NoteController@trackNote');

Route::resource('tasks', 'TasksController')->middleware('auth');
Route::post('updateDate', 'TasksController@updateDate')->middleware('auth');
Route::post('updateTask', 'TasksController@updateTask')->middleware('auth');
Route::post('deleteTask', 'TasksController@deleteTask')->middleware('auth');