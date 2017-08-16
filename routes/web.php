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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'Admin\AdminController@index')->name('home');

//Route::resource('admin/posts', 'Admin\PostsController');
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'Admin\AdminController@index');
Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
//Route::resource('admin/users', 'Admin\UsersController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);


Route::resource('manager/users', 'Manager\UsersController');
Route::resource('manager/workers', 'Manager\WorkersController');

Route::resource('cors/manager/users', 'Manager\UsersController');
Route::resource('cors/manager/workers', 'Manager\WorkersController');


Route::resource('workadmin/workers', 'WorkAdmin\WorkersController');
Route::resource('workadmin/worktimes', 'WorkAdmin\WorkTimesController');
Route::resource('cors/workadmin/workers', 'WorkAdmin\WorkersController');
Route::resource('cors/workadmin/worktimes', 'WorkAdmin\WorkTimesController');


Route::resource('worker/workers', 'Worker\WorkerController');
Route::resource('worker/worktimes', 'Worker\WorkTimesrController');
Route::resource('cors/worker/workers', 'Worker\WorkerController');
Route::resource('cors/worker/worktimes', 'Worker\WorkTimesrController');


Route::get('info', 'InfoController@index');
Route::get('info/user', 'InfoController@getUserdata');
//Route::get('rud/users', 'Crud\UsersController@index');
//Route::get('cors/users', 'Cors\UsersController@index');
//Route::resource('Crud/work-time', 'Crud\\WorkTimeController');
Route::resource('workers', 'WorkersController');
//-------------------------

