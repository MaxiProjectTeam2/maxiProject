<?php require_once("../includes/session.php")?>
<?php require_once("../includes/functions.php") ?>
<?php confirm_logged_in();
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php") ?>
<body>
	<div class="well well-sm">
		<h1>CMS<h1>
	</div>
		<h2>Admin Menu</h2>
	</div>
	<div class="right">
		<div class="col-lg-offset-4 col-lg-4">
			<div  class="alert alert-success">
			<p>Welcome to the admin area, <?php   
			echo htmlentities($_SESSION["username"]); ?>.</p>
			</div>
		</div>
		
		<div class="col-lg-offset-4 col-lg-4">
			<ul class="nav nav-pills nav-stacked">
				<li><a href=manage_content.php >Manage Content </a></li>
				<li><a href=manage_patient.php > Manage Patients</a></li>
				<li><a href=manage_admins.php >Manage Carers</a></li>
				<li><a href=trackResult.php >Track result</a></li>
			</ul>
		</div>
		
	<div class="col-lg-offset-4 col-lg-4">
		<ul class="nav nav-pills nav-justified">
		<li><a href=logout.php class="btn btn-primary">Logout</a></li>
	</div>
	</div>


