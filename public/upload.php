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

if(isset($_POST['submit'])) {
	// process the form data
	$tmp_file = $_FILES['file_upload']['tmp_name'];
	$target_file = basename($_FILES['file_upload']['name']);
	if($_POST["type"]=="music"){
		$upload_dir = "music";}else if($_POST["type"]=="picture"){
			$upload_dir = "images";
		}else{
			$upload_dir = "video";
		}
  
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
		if (isset($_POST['submit'])&&$upload_ok==1) {
		$path = $upload_dir."/".$target_file;
		$caption = mysql_prep($_POST["caption"]);
		$topic = mysql_prep($_POST["topic"]);
		$sub_topic = mysql_prep($_POST["sub_topic"]);
		$content_type =  $_POST["type"];
		$content_type_ID =  $_POST["contentTypeID"];
		$language =  $_POST["language"];
  
	  // validations
		  $required_fields = array("caption", "topic", "sub_topic");
		  validate_presences($required_fields);
		  
		  $fields_with_max_lengths = array("caption" => 30,"topic"=>30,"sub_topic"=>30);
		  validate_max_lengths($fields_with_max_lengths);
	  
	  if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("upload.php");
	  }
	  
		  $query  = "INSERT INTO content (";
		  $query .= "  path, caption, topic, subtopic, contentType, contentTypeID,language";
		  $query .= ") VALUES (";
		  $query .= "  '{$path}','{$caption}', '{$topic}', '{$sub_topic}', '{$content_type}', {$content_type_ID}, '{$language}'";
		  $query .= ")";
		  $result = mysqli_query($connection, $query);

		   	if($_GET["type"]=="video"){
			$value = "video";
			}else if($_GET["type"]=="music"){
			$value = "music";
			}else if($_GET["type"]=="picture"){
			$value = "picture";
	}
	  if ($result) {
		// Success
		$_SESSION["message"] = "content upload.";
		redirect_to("manage_video.php?type={$_GET["type"]}");
	  } else {
		// Failure
		$_SESSION["message"] = "content upload failed.";
		redirect_to("upload.php");
	  }
		}
?>

	  
<?php
  if (isset($connection)) { mysqli_close($connection); }
?>

<?php include("../includes/layouts/header.php"); ?>
	<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
<?php
// The maximum file size (in bytes) must be declared before the file input field
// and can't be larger than the setting for upload_max_filesize in php.ini.
//
// This form value can be manipulated. You should still use it, but you rely 
// on upload_max_filesize as the absolute limit.
//
// Think of it as a polite declaration: "Hey PHP, here comes a file less than X..."
// PHP will stop and complain once X is exceeded.
// 
// 1 megabyte is actually 1,048,576 bytes.
// You can round it unless the precision matters.
?>

<?php //if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
	<?php //echo message(); ?>
    <?php //$errors = errors(); ?>
    <?php //echo form_errors($errors); ?>
	<div class="col-lg-offset-3 col-lg-6">
		<?php if(!empty($message)){
			$output="";
		    $output .= "<div class=\"alert alert-danger fade in\">";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			echo $output;
			echo $message; 
			echo "</div>";
			}
			?>
	</div>
	
		<div class="col-lg-offset-3 col-lg-6">
		<?php if(isset($_SESSION["message"])){
			$output="";
		    $output .= "<div class=\"alert alert-danger fade in\">";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			echo $output;
			echo message(); 
			echo "</div>";
			}
			?>
	</div>
		<form action="upload.php?type=<?php echo urlencode($_GET["type"]);?>" enctype="multipart/form-data" method="POST" form class="form-horizontal">
		
				 <div class="form-group">
					<label  class="control-label col-lg-offset-3 col-lg-2"for="contentTypeID" class>Content type: </label>
						<div class="col-lg-2">
						<label><?php echo $_GET["type"];?></label>
						</div>
					 <input type="hidden" name="type" value="<?php echo $_GET["type"];?>">
							
							<input type="hidden" name="contentTypeID" value="<?php 
								if($_GET["type"]=="video"){
								$id = 2;
								}else if($_GET["type"]=="music"){
								$id = 3;
								}else if($_GET["type"]=="picture"){
								$id = 1;} echo $id;?>">
						
				  </div>
				  
				<div class="form-group">
					<label  class="control-label col-lg-offset-3 col-lg-2"for="caption" class>Caption:</label>
					<div class="col-lg-2">
						<input type="text" name="caption" value="" class ="form-control" />
					</div>
				</div>
			
				<div class="form-group">
				  <label  class="control-label col-lg-offset-3 col-lg-2"for="topic" class="form-control">Topic: </label>
					<div class="col-lg-2">
						<input type="text" name="topic" value="" class="form-control"/>
					</div>
				</div>
				
				 <div class="form-group">
					<label  class="control-label col-lg-offset-3 col-lg-2"for="sub_topic" class="form-control"> SubTopic: </label>
						  <div class="col-lg-2">
							<input type="text" name="sub_topic" value="" class="form-control"/>
						  </div>
				  </div>
				  
				  
				  <div class="form-group">
				  <label  class="control-label col-lg-offset-3 col-lg-2"for="language" class="form-control">Language:</label>
				  <div class="col-lg-2">
					<select name="language" class="form-control">
						<option value="English">English</option>
						<option value="Chinese">Chinese</option>
						<option value="French">French</option>
						<option value="other">Other</option>
					</select>
				  </div>
				  </div>
			  <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
			  
			  <div class="form-group">
			  <label class="control-label col-lg-offset-3 col-lg-2" for="username">File:</label>
				<div class="col-lg-2">
					<input type="file" name="file_upload" class="form-control"/>
				</div>
			  </div>
			  
			<div class="form-group">
				<div class="col-lg-offset-5 col-lg-2">
				  <input type="submit" name="submit" value="Upload" class="form-control"/>
				</div>
			</div>
			
			<div class="form-group">
					<div class="col-lg-offset-5 col-lg-2">
						<a href="manage_video.php?type=<?php echo urlencode($_GET["type"]);?>" class="btn btn-primary form-control">Cancel</a>
					</div>
				</div>
		</form>
	</body>
</html>
