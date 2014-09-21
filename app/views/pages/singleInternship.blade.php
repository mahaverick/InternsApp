@extends('layouts.main')
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/timeline.css">
@section('header')
<?php if(Session::has('eid')) {
	$details=Employers::getEmployersDetails(Session::get('eid'));
	$countOfStudents = Internships::getCountOfStudentsAppliedToInternship($id);
	if($countOfStudents) {
		$appliedStudents = Internships::getStudentsAppliedToInternship($id);
	}
	$buttonValue = "";
	$tempText = '| <a href="/employers">'.$details['name'].'</a> | <a href="employers/logout">Logout</a>';
} elseif(Session::has('sid')) {
	$details=Students::getStudentsDetails(Session::get('sid'));
	$appliedPost = Internships::getSingleAppliedInternship($id);
	if($appliedPost) {
		$buttonValue = '<input disabled value="Applied">';
	}
	else {
		$buttonValue = '<input type="submit" value="Apply">';
	}
	$tempText = '| <a href="/students">'.$details['name'].'</a> | <a href="students/logout">Logout</a>';
} else {
	$buttonValue = "";
	$tempText = '| <a href="/students/login">Student Login</a> | <a href="employers/login">Employer Login</a>';
} ?>
@parent <?php echo $tempText;?>
@stop
@section('sidebar')
@parent

<p>This is appended to the master sidebar.</p>
@stop

@section('content')
<?php $post = Internships::getSingleInternship($id); ?>

<div>
	<ul class="timeline">
		<?php if($post){ ?>
		<li>
			<div class="bubble-container">
				<div class="bubble">
					<h3><?php echo $post['title']; ?></h3> at <h3>@<?php echo $post['company']; ?></h3>
					<form action="/students/internships/apply/<?php echo $post['id']; ?>" method="post" ><?php echo $buttonValue; ?></form>
					<h4>For the Post of <?php echo $post['forThePost']; ?> </h4> Company : <em> <?php echo $post['company']; ?> </em>
					| more info about it: <?php echo $post['moreInfo']; ?>
				</div>
			</div>
		</li>
		<?php } ?>
	</ul>
	<?php if(Session::has('eid') && $countOfStudents) { ?>
		<ul class="studentList timeline">
			<h3>List of Applied Students</h3>
			<?php foreach ($appliedStudents as $student) { if($student) {?>
			<li>
				Name : <?php echo $student['name']; ?> Email : <?php echo $student['email']; ?>
			</li>
			<?php }  } }?>
		</ul>
	</div>
	@stop