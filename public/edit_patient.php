<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
		   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
  $patient = find_patient_by_id($_GET["id"]);
  
  if (!$patient) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_patient.php");
  }
?>

<?php
$upload_ok=0;
// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 		=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

if (isset($_POST['submit'])) {
  // Process the form
  // process the form data
	$tmp_file = $_FILES['file_upload']['tmp_name'];
	$target_file = basename($_FILES['file_upload']['name']);
	$upload_dir = "profile_picture";
  
	// You will probably want to first use file_exists() to make sure
	// there isn't already a file by the same name.
	
	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
	// or if it cannot be moved for any other reason
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
		$message = "File uploaded successfully.";
		$upload_ok=1;
	} else {
		$error = $_FILES['file_upload']['error'];
		$message = $upload_errors[$error];
	}
	
	if (isset($_POST['submit'])&&$upload_ok==1) {
		
		//$path = $upload_dir."/".$target_file;
		$path=$target_file;
  // validations
  $required_fields = array("forename", "surname");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("forename" => 30,"surname"=>30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $patientid = $_GET["id"];
    $forename = mysql_prep($_POST["forename"]);
	$surname = mysql_prep($_POST["surname"]);
  
    $query  = "UPDATE patient SET ";
    $query .= "forename = '{$forename}', ";
    $query .= "surname = '{$surname}', ";
	$query .= "photofile = '{$path}' ";
    $query .= "WHERE patientid = {$patientid} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "patient updated.";
      redirect_to("manage_patient.php");
    } else {
      // Failure
      $_SESSION["message"] = "patient update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))
}
?>

<?php include("../includes/layouts/header.php"); ?>
<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
    <h2>Edit patient: <?php echo htmlentities($patient["forename"]); ?></h2>
	
			<div class="col-lg-offset-5 col-lg-2">
			<?php echo form_errors($errors); ?>
			</div>
			<?php echo message(); ?>
<div class="right">			
	<div class="row">
		<div class="col-lg-7">
			<form action="edit_patient.php?id=<?php echo urlencode($_GET["id"]); ?>" enctype="multipart/form-data" method="POST" class="form-horizontal"  role="form">
				<div class="form-group">
					<label class="control-label col-lg-offset-4 col-lg-2" for="username">Forename:</label>
						<div class="col-lg-4">	
							<input type="text" name="forename" value="<?php echo htmlentities($patient["forename"]); ?>" class ="form-control" />
						</div>
				</div>
			  
				<div class="form-group">
					<label class="control-label col-lg-offset-4 col-lg-2" for="username">Surname:</label>
						<div class="col-lg-4">	
							<input type="text" name="surname" value="<?php echo htmlentities($patient["surname"]);?>"class ="form-control"/>
						</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-offset-4 col-lg-2" for="username">File:</label>
							<input type="hidden" name="MAX_FILE_SIZE" value="209715200" />
						<div class="col-lg-4">
							<input type="file" name="file_upload" class ="form-control" />
						</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-6 col-lg-4">
						<input type="submit" name="submit" value="Edit Patient" class="form-control" />
					</div>
				</div>
			</form>
			<div class="form-group">
					<div class="col-lg-offset-6 col-lg-4">
						<a href="manage_patient.php" class="btn btn-primary form-control">Cancel</a>
					</div>
			</div>
		</div>
		
			<div class="col-lg-5">
					<img src="<?php echo "profile_picture/".find_picture_by_patientid($_GET["id"]);?>"  class="img-responsive" width="304" height="236">
			</div>
	</div>
</div>
</body>
