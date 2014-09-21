@extends('layouts.main')
@section('title')
Login : @parent
@stop
@section('sidebar')
@stop
@section('content')
<div id="login-signup-form">
        
        <form action="signup" method="post">
            
            <fieldset class="clearfix">
                
                <p><span class=""></span><input type="text" name="name" placeholder="Name" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                <p><span class=""></span><input type="email" name="email" placeholder="Email" required></p>
                <p><span class=""></span><input type="password" name="password"  placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                <p><input type="submit" value="Sign Up"></p>

            </fieldset>

        </form>
        
        <p>Already a member? <a href="/login">Sign in now</a></p>
        <p>Go back to<a href="/"> Home</a></p>

    </div> <!-- end login -->
@stop