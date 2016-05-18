<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$username = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt login
	$username = $_POST["username"];
	$password = $_POST["password"];
	$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
	  $_SESSION["admin_id"] = $found_admin["id"];
	  $_SESSION["username"] = $found_admin["username"];
	 
	  if(check_priority_by_username($_SESSION["username"])){
		  redirect_to("admin.php");
	  }else{
		  redirect_to("patientLogin.php");
	  }
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>


<?php include("../includes/layouts/header.php"); ?>
<body class="background">
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
<div id="warp">   
<h2>Login</h2>
<div class="right">
	<form action="login.php" method="post" class="form-horizontal" role="form">
		<div class="form-group">
			<label  class="control-label col-lg-offset-3 col-lg-2"for="username" class>Username:</label>
					<div class="col-lg-2">
					<input type="text" name="username" class ="form-control" id="username" placeholder="Enter username"
						value="<?php echo htmlentities($username);?>" />
					</div>
				</div>
	<div class="form-group">
		<label  class="control-label col-lg-offset-3 col-lg-2"for="pwd">Password:</label>
				<div class="col-lg-2">
				<input type="password" name="password" class ="form-control" id="pwd"  placeholder="Enter Password" 
					value="" />
				</div>
			
	</div>
	<div class="form-group">
		<div class="col-lg-offset-5 col-lg-2">
		<input type="submit" name="submit" value="Log In" class="form-control"/>
		</div>
		</div>
	</form>
	</div>
	<div class="col-lg-offset-5 col-lg-2">
	<?php if(isset($_SESSION["message"])){
			$output="";
		    $output .= "<div class=\"alert alert-danger fade in\">";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			echo $output;
			echo message(); 
			echo "</div>";
			}
	?>
	<?php echo form_errors($errors); ?>
	</div>
</div>
</body>
