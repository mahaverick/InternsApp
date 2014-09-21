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

Route::filter('authCheckStudents', function() {
	if (Session::has('sid')) {}
	elseif (Session::has('eid')) {
		return Redirect::to('employers');
	}
	else {
		return Redirect::to('/');
	}
});

Route::filter('alreadyLoggedIn', function(){
	if(Session::has('sid')) {
		return Redirect::to('students');
	} elseif(Session::has('eid')) {
		return Redirect::to('employers');
	} else {}
});

Route::group(array('prefix' => '/students', 'before' => 'alreadyLoggedIn'), function() {
	Route::get('login', function() {
		return View::make('pages.students.login');
	});

	Route::post('login', 'StudentsController@login');

	Route::get('signup', function() {
		return View::make('pages.students.signup');
	});

	Route::post('signup', 'StudentsController@signup');

});

Route::group(array('prefix' => '/students', 'before' => 'authCheckStudents'), function() {

	Route::get('logout', 'StudentsController@logout');

	Route::get('', function() {
		return View::make('pages.students.students');
	});
});

/*
|--------------------------------------------------------------------------
| employers Routes
|--------------------------------------------------------------------------
*/

Route::filter('authCheckEmployers', function() {
	if (Session::has('eid')) {}
	elseif (Session::has('sid')) {
		return Redirect::to('students');
	}
	else {
		return Redirect::to('/');
	}
});

Route::group(array('prefix' => '/employers', 'before' => 'alreadyLoggedIn'), function() {
	Route::get('login', function() {
		return View::make('pages.employers.login');
	});

	Route::post('login', 'EmployersController@login');

	Route::get('signup', function() {
		return View::make('pages.employers.signup');
	});

	Route::post('signup', 'EmployersController@signup');
});

Route::group(array('prefix' => '/employers', 'before' => 'authCheckEmployers'), function() {

	Route::filter('employerAlreadyLoggedIn', function(){
		if(Session::has('eid')) {
			return Redirect::to('employers');
		}
	});

	Route::get('logout', 'EmployersController@logout');

	Route::get('', function() {
		return View::make('pages.employers.employers');
	});

	Route::get('internships', function () {
		return View::make('pages.employers.internships');
	});
	
	Route::post('internships', 'EmployersController@addInternship');
});