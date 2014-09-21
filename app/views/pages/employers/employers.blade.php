@extends('layouts.main')
@section('title')
Employers : @parent
@stop
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/timeline.css">
@section('header')
<?php $details=Employers::getEmployersDetails(Session::get('eid')); ?>
@parent | <?php echo $details['name'];?> | <a href="/employers/logout">logout</a>
@stop
@section('sidebar')
@stop
@section('content')
<div class="center">
	<br>
	<a href="employers/internships"><button>add new internship</button></a>
</div>

<?php if($errors->any()){?>
<div class="center">
	<?php echo  implode('', $errors->all('<span style="color:red">:message</span>')); ?>
</div>
<?php }?>

<?php $countOfUploadedPosts = Internships::getCountOfUploadedInternships();
if($countOfUploadedPosts) {
	$posts = Internships::getUploadedInternships(); 
} ?>

<div>
<?php if($countOfUploadedPosts){ ?>
	<ul class="timeline">
		<?php foreach ($posts as $post) { if($post){ ?>
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h3><?php echo $post['title']; ?></h3> Added by <h3>@you</h3> <a href="internships/<?php echo $post['id'];?>"><button class="right">Details</button></a>
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
					<h4 class="center">You have not uploaded any Post.</h4>
				</div>
			</div>
		</li>
	</ul>
<?php } ?>
</div>

@stop