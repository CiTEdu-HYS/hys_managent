<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('/user')->group(function () {
        Route::match(['get', 'post'],'/list', 'UserController@list')->name('user.list');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::get('/profile/{id?}', 'UserController@profile')->name('user.profile')->where('id', '[0-9]+');
        Route::post('/saveInfo', 'UserController@saveInfo');
    });

    Route::prefix('/group')->group(function () {
        Route::get('/test', 'GroupController@test')->name('group.test');
        Route::get('/manage', 'GroupController@manage')->name('group.manage');
        Route::get('/list', 'GroupController@list')->name('group.list');
        Route::get('/detail/{id}', 'GroupController@detail')->where('id', '[0-9]+')->name('group.detail');
        Route::post('/saveInfo', 'GroupController@saveInfo');
        Route::get('/getInfoGroupAjax/{id}', 'GroupController@getInfoGroupAjax')->where('id', '[0-9]+');
        Route::get('/getListGroupChild', 'GroupController@getListGroupChild');
        Route::get('/getListGroupOption', 'GroupController@getListGroupOption');
    });

    Route::prefix('/event')->group(function () {
        Route::get('/list', function () {
            return view('events.list');})->name('event.list');
    });

    Route::prefix('/role')->group(function () {
        Route::get('/list', 'RoleController@list')->name('role.list');
        Route::get('/manage', 'RoleController@manage')->name('role.manage');
        Route::get('/test', 'RoleController@manageTest')->name('role.test');
        Route::get('/test2/{userid}', 'RoleController@manageTest2')->name('role.test2');
        Route::get('/getInfo/{id}', 'RoleController@getInfo');
        Route::get('/getListRole', 'RoleController@getListRole');
        Route::post('/saveInfo', 'RoleController@saveInfo');
    });

    Route::prefix('/ugr')->group(function () {
        Route::get('/getInfoAjax', 'UserGroupRoleController@getInfoAjax');
        Route::post('/saveInfoUgr', 'UserGroupRoleController@saveInfoUgr');
        Route::post('/updateStatusUg', 'UserGroupRoleController@updateStatusUg');
        Route::get('/deleteAjax/{id}', 'UserGroupRoleController@deleteAjax');
    });

    Route::prefix('/calendar')->group(function () {
        Route::get('/weekHys', 'CalendarController@weekHys')->name('calendar.weekHys');
    });

    Route::prefix('/course')->group(function () {
        Route::get('/list', 'CourseController@list')->name('course.list');
        Route::get('/getInfo/{id}', 'CourseController@getInfoAjax');
        Route::post('/saveInfo', 'CourseController@saveInfoAjax');

        Route::get('/teacher', 'TeacherController@list')->name('course.teacher');
        Route::get('/getInfo/{id}', 'TeacherController@getInfoAjax');
        Route::post('/saveInfo', 'TeacherController@saveInfoAjax');
    });

    Route::prefix('/lesson')->group(function () {
        Route::get('/list', 'LessonController@list')->name('lesson.list');
        Route::get('/getInfo/{id}', 'LessonController@getInfoAjax');
        Route::post('/saveInfo', 'LessonController@saveInfoAjax');
    });
});

