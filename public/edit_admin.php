<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
  $admin = find_admin_by_id($_GET["id"]);
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
  }
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
    
    // Perform Update

    $id = $admin["id"];
    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
  
    $query  = "UPDATE admins SET ";
    $query .= "username = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "carer updated.";
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["message"] = "carer update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>

<?php include("../includes/layouts/header.php"); ?>

			<div class="col-lg-offset-5 col-lg-2">
				<?php echo form_errors($errors); ?>
			</div>
    <?php echo message(); ?>
    
    <h2>Edit carer: <?php echo htmlentities($admin["username"]); ?></h2>
	
    <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post" class="form-horizontal"  role="form">
	
	<div class="form-group">
		<label class="control-label col-lg-offset-3 col-lg-2" for="username">Username:</label>
		<div class="col-lg-2">
			<input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" class ="form-control" />
		</div>
	</div>
	<div class="form-group">
      <label class="control-label col-lg-offset-3 col-lg-2" for="username">Password:</label>
		  <div class="col-lg-2">
				<input type="password" name="password" value=""  class ="form-control"/>
		  </div>
	  </div>
	  <div class="form-group">
		  <div class="col-lg-offset-5 col-lg-2">
				<input type="submit" name="submit" value="Edit Admin" class="form-control" class ="form-control"/>

		  </div>
	  </div>
    </form>
	<div class="form-group">
		<div class="col-lg-offset-5 col-lg-2">
			<a href="manage_admins.php" class="btn btn-primary form-control">Cancel</a>
		</div>
	</div>
  </div>
</div>

</body>
