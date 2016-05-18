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
$upload_ok=0;
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
if(isset($_POST['submit'])) {
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
	
}
if (isset($_POST['submit'])&&$upload_ok=1) {
   $required_fields = array("surname", "forename");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("surname" => 30,"forename"=>30);
  validate_max_lengths($fields_with_max_lengths);
  if (empty($errors)) {
    // Perform Create
	
	//$path = $upload_dir."/".$target_file;
	$path =$target_file;
    $surname = mysql_prep($_POST["surname"]);
    $forename = mysql_prep($_POST["forename"]);
    
    $query  = "INSERT INTO patient (";
    $query .= "  forename, surname, photoFile";
    $query .= ") VALUES (";
    $query .= "  '{$forename}', '{$surname}','{$path}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "patient created.";
      redirect_to("manage_patient.php");
    } else {
      // Failure
      $_SESSION["message"] = "patient creation failed.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php include("../includes/layouts/header.php"); ?>
<body class>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
<div id="warp"> 
  <div class="right"> 
  <h2>Create patient</h2>
    <?php echo message(); ?>
	
    <?php echo form_errors($errors); ?>
    
   
    <form action="new_patient.php" enctype="multipart/form-data" method="post" class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-lg-offset-3 col-lg-2" for="username">Surname:</label>
			<div class="col-lg-2">
			<input type="text" name="surname" value="" class ="form-control"/>
			</div>
		 </div>
		 
		   <div class="form-group">
				<label class="control-label col-lg-offset-3 col-lg-2 for="username">Forename:</label>
				<div class="col-lg-2">
				<input type="text" name="forename" value="" class ="form-control"/>
				</div>
			</div>
				
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				
			<div class="form-group">
				<label class="control-label col-lg-offset-3 col-lg-2" for="username">File:</label>
					<div class="col-lg-2">
						<input type="file" name="file_upload" class="form-control" value="upload"/>
					</div>
			</div>
			
			<div class="form-group">
						<div class="col-lg-2 col-lg-offset-5">
						<input type="submit" name="submit" value="Create" class=" btn btn-primary form-control" />
						</div>
				  </div>
				 </div>
    </form>
	<div class="col-lg-offset-5 col-lg-2">
    <a href="manage_patient.php" class="btn btn-primary form-control">Cancel</a>
	</div>
  </div>
  </div>