@extends('layouts.main')
@section('title')
Employers : @parent
@stop
@section('header')
<?php $details=Employers::getEmployersDetails(Session::get('eid')); ?>
@parent | <?php echo $details['name'];?> | <a href="employers/logout">logout</a>
@stop
@section('sidebar')
@stop
@section('content')
<div>
	<a href="employers/internships"><button>add new internship</button></a>
</div>
@stop