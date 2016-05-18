<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in();
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    // Perform Create

    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
    $priority = $_POST["privilege"];
    $query  = "INSERT INTO admins (";
    $query .= "  username, hashed_password, priority";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}', '{$priority}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Admin created.";
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["message"] = "Admin creation failed.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>


<?php include("../includes/layouts/header.php"); ?>
<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
    <?php echo message(); ?>

    
    <h2>Create Carers</h2>
	<div id="warp">   
	<div class="right">	
    <form action="new_admin.php" method="post" class="form-horizontal" role="form">
		  <div class="form-group">
				<label class="control-label col-lg-offset-3 col-lg-2" for="username">Username:</label>
				<div class="col-lg-2">
					<input type="text" name="username" value="" class ="form-control" />
				</div>
		  </div>
		  
			  <div class="form-group">
					<label class="control-label col-lg-offset-3 col-lg-2" for="password">Password:</label>
				<div class="col-lg-2">	
					<input type="password" name="password" value="" class ="form-control" />
				</div>
			</div>
			
		<input type="hidden" name="privilege" value="3" />
	
	  <div class="form-group">
				
					<div class="col-lg-2 col-lg-offset-5">
						<input type="submit" name="submit" value="Create" class ="form-control" />
					</div>
				
	  </div>
    </form>
	
		<div class="col-lg-offset-5 col-lg-2">
			<a href="manage_admins.php" class="btn btn-primary form-control">Cancel</a>
		</div>
	</div>
	
	<div class="col-lg-offset-5 col-lg-2">
				<?php echo form_errors($errors); ?>
	</div>
</body>