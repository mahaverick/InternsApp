<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
	return View::make('pages.index');
});

/*
|--------------------------------------------------------------------------
| students Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'students', 'before' => 'authCheckStudents'), function() {

	Route::get('login', function() {
		return View::make('pages.students.login');
	});

	Route::post('login', 'StudentsController@login');

	Route::get('signup', function() {
		return View::make('pages.students.signup');
	});

	Route::post('signup', 'StudentsController@signup');
});

/*
|--------------------------------------------------------------------------
| employers Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'employers', 'before' => 'authCheckEmployers'), function() {

	Route::get('login', function() {
		return View::make('pages.employers.login');
	});

	Route::post('login', 'EmployersController@login');

	Route::get('signup', function() {
		return View::make('pages.employers.signup');
	});

	Route::post('signup', 'EmployersController@signup');
});