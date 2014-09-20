@extends('layouts.main')
@section('title')
Login : @parent
@stop
@section('sidebar')
@stop
@section('content')
<div id="login-signup-form">
        
        <form action="login" method="post">
            
            <fieldset class="clearfix">
                
                <p><span class=""></span><input type="email" name="email" placeholder="Email" required></p>
                <p><span class=""></span><input type="password" name="password" placeholder="Password" required></p>
                <p><input type="submit" value="Sign In"></p>

            </fieldset>

        </form>
        
        <p>Not an Employer? <a href="signup">Sign up now</a></p>

        <p>Go back to<a href="/"> Home</a></p>

    </div> <!-- end login -->
@stop