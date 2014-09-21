@extends('layouts.main')
@section('header')
<?php if(Session::has('eid')) {
	$details=Employers::getEmployersDetails(Session::get('eid'));
	$tempText = '| <a href="employers">'.$details['name'].'</a> | <a href="employers/logout">Logout</a>';
} elseif(Session::has('sid')) {
	$details=Students::getStudentsDetails(Session::get('sid'));
	$tempText = '| <a href="students">'.$details['name'].'</a> | <a href="students/logout">Logout</a>';
} else {
	$tempText = '| <a href="students/login">Student Login</a> | <a href="employers/login">Employer Login</a>';
}?>
@parent <?php echo $tempText;?>
@stop
@section('sidebar')
@parent

<p>This is appended to the master sidebar.</p>
@stop

@section('content')
<p>This is my body content.</p>
@stop