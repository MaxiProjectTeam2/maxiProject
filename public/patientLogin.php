<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in()?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>Login</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/jquery-1.12.3.min.js"></script>
	<script src="js/getPatients.js"></script>
	<style>
	 h2{
	  text-align:center;
	  margin-top:8%;
         }
	 .avator{
	   display: none;
	 }
	</style>
</head>

<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
	<h2>Find your profile</h2>
	
	<form class="form-inline col-lg-offset-2">
		<div class="form-group">
			<div class="col-lg-3">
				<div id="a1" class="avator">
					<a id="l1" href="topicPage.php"><img id="j1" class="img" src="profile_picture/avator2.png" alt="user" height=150>
					<h3 id="p1">Name</h3></a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-3">
			<div id="a2" class="avator">
				<a id="l2" href="topicPage.php"><img id="j2" class="img" src="profile_picture/avator2.png" alt="user" height=150>
				<h3 id="p2">Name</h3></a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-3">
			<div id="a3" class="avator">
				<a id="l3" href="topicPage.php"><img id="j3" class="img" src="profile_picture/avator2.png" alt="user" height=150>
				<h3 id="p3">Name</h3></a>
			</div>
		</div>
	</div>
	
	<div class="form-group">
	<div class="col-lg-3">
	<div id="a4" class="avator">
		<a id="l4" href="topicPage.php"><img id="j4" class="img" src="profile_picture/avator2.png" alt="user" height=150>
		<h3 id="p4">Name</h3></a>
	</div>
	</div>
	</div>
	</form>
	<div>
	
		<form class="form-horizontal">
		<div class="form-group">
			<div class="col-lg-4 col-lg-offset-4">	
				<input type="text" name="name" placeholder="surname" value ="" class="form-control" style="display: inline-block;" onkeyup="showPatients(this.value)">
			</div>
		</div>	
			<div class="form-group">
				<div class="col-lg-4 col-lg-offset-4">
					<a href=logout.php class="btn btn-primary">Logout</a>
				</div>
			</div>
		</form>
	</div>
	</div>

</body>
</html>
