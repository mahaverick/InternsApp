@extends('layouts.main')
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/timeline.css">
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
<?php $appliedPosts = Internships::getAppliedInternships(); $allPosts = Internships::getAllInternships();
?>

<div>
	<ul class="timeline">
		<?php foreach ($allPosts as $post) { if($post){ ?>
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h3><?php echo $post['title']; ?></h3> at <h3>@<?php echo $post['company']; ?></h3> <a href="internships/<?php echo $post['id'];?>"><button>Details</button></a>
					<h4>For the Post of <?php echo $post['forThePost']; ?> </h4> Company : <em> <?php echo $post['company']; ?> </em>
					| more info about it: <?php echo $post['moreInfo']; ?>
				</div>
			</div>
		</li>
		<?php } } ?>
		<?php foreach ($appliedPosts as $post) { if($post){ ?>
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h3><?php echo $post['title']; ?></h3> at <h3>@<?php echo $post['company']; ?></h3> <a href="internships/<?php echo $post['id'];?>"><button>Details</button></a>
					<form action="students/internships/apply/<?php echo $post['id']; ?>" method="post" ><input value="Applied" disabled></form>
					<h4>For the Post of <?php echo $post['forThePost']; ?> </h4> Company : <em> <?php echo $post['company']; ?> </em>
					| more info about it: <?php echo $post['moreInfo']; ?>
				</div>
			</div>
		</li>
		<?php } } ?>
	</ul>
</div>
@stop