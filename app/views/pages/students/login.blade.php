@extends('layouts.main')
@section('title')
Login : @parent
@stop
@section('sidebar')
@stop
@section('content')
<?php if($errors->any()){
    ?>
    <div class="widget-body list">
        <?php echo  implode('', $errors->all('<span style="color:red">:message</span>')); ?>
    </div>
    <?php      
}?>
<div id="login-signup-form">

    <form action="login" method="post">
        <fieldset class="clearfix">

            <p><span class=""></span><input type="email" name="email" placeholder="Email" required></p>
            <p><span class=""></span><input type="password" name="password" placeholder="Password" required></p>
            <p><input type="submit" value="Sign In"></p>

        </fieldset>

    </form>

    <p>Not a member? <a href="signup">Sign up now</a></p>
    <p>Go back to<a href="/"> Home</a></p>
</div>
@stop