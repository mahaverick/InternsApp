@extends('layouts.main')
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/timeline.css">
@section('header')
<?php if(Session::has('eid')) {
	$details=Employers::getEmployersDetails(Session::get('eid'));
	$tempText = '| <a href="/employers">'.$details['name'].'</a> | <a href="employers/logout">Logout</a>';
} elseif(Session::has('sid')) {
	$details=Students::getStudentsDetails(Session::get('sid'));
	$tempText = '| <a href="/students">'.$details['name'].'</a> | <a href="students/logout">Logout</a>';
} else {
	$tempText = '| <a href="/students/login">Student Login</a> | <a href="employers/login">Employer Login</a>';
}?>
@parent <?php echo $tempText;?>
@stop
@section('sidebar')
@parent

<p>This is appended to the master sidebar.</p>
@stop

@section('content')
<?php $countOfPosts = Internships::getCountOfAllInternships();
if($countOfPosts) {
	$posts = Internships::getAllInternships(); 
} ?>

<div>
	<?php if($countOfPosts) { ?>
	<ul class="timeline">
		<?php foreach ($posts as $post) { if($post){ ?>
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h3><?php echo $post['title']; ?></h3> at <h3>@<?php echo $post['company']; ?></h3> <a href="internships/<?php echo $post['id'];?>"><button class="right">Details</button></a>
					<h4>For the Post of <?php echo $post['forThePost']; ?> </h4> Company : <em> <?php echo $post['company']; ?> </em>
					| more info about it: <?php echo $post['moreInfo']; ?>
				</div>
			</div>
		</li>
		<?php } } ?>
	</ul>
	<?php } else {?>
	<ul class="timeline">
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h4 class="center">Sorry!</h4>
					<h4 class="center">There is No Post.</h4>
				</div>
			</div>
		</li>
	</ul>
	<?php } ?>
</div>
@stop