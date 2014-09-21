@extends('layouts.main')
@section('title')
Employers : @parent
@stop
@section('header')
<?php $details=Employers::getEmployersDetails(Session::get('eid')); ?>
@parent | <?php echo $details['name'];?> | <a href="students/logout">logout</a>
@stop
@section('sidebar')
@stop
@section('content')
<div id="login-signup-form">

    <form action="internships" method="post">
        <fieldset class="clearfix">

            <p><span class=""></span><input type="text" name="title" placeholder="Title" required></p>
            <p><span class=""></span><input type="text" name="forThePost" placeholder="Post name" required></p>
            <p><span class=""></span><input type="text" name="moreInfo" placeholder="more Information" required></p>
            <p><input type="submit" value="Add Post"></p>

        </fieldset>

    </form>
    <p>Go back to<a href="/"> Home</a></p>
</div>
@stop