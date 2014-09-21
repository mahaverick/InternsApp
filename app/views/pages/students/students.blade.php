@extends('layouts.main')
@section('title')
Students : @parent
@stop
@section('header')
<?php $details=Students::getStudentsDetails(Session::get('sid')); ?>
@parent | <?php echo $details['name'];?> | <a href="students/logout">logout</a>
@stop
@section('sidebar')
@stop
@section('content')
@stop