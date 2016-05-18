<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in()?>
<?php include("../includes/layouts/header.php"); ?>
<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
?>
<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>

    <h2>Manage Content</h2>
	</div>
  <div id="right">
	  <div class="col-lg-offset-4 col-lg-4">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="manage_video.php?type=video"  >Edit Video</a></li>
				<li><a href="manage_video.php?type=picture"  >Edit Image</a></li>
				<li><a href="manage_video.php?type=music" >Edit Music</a></li>
			</ul>
	  </div>


	<div class="col-lg-offset-4 col-lg-4">
		<ul class="nav nav-pills nav-justified">
		<li><a href="admin.php" class="btn btn-primary">Main menu</a></li>
	</div>
</div>

