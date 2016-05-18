<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
  $content = find_content_by_id($_GET["id"]);
  $type = $_GET["type"];
  if (!$content) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_video.php");
  }

	if($_GET["type"]=="video"){
		$value = "video";
	}else if($_GET["type"]=="music"){
		$value = "music";
	}else if($_GET["type"]=="picture"){
		$value = "picture";
	}
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("caption", "topic","sub_topic");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("caption" => 30,"topic" => 30,"sub_topic" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $id = $_GET["id"];
    $caption = mysql_prep($_POST["caption"]);
	$topic = mysql_prep($_POST["topic"]);
	$sub_topic = mysql_prep($_POST["sub_topic"]);
  
    $query  = "UPDATE content SET ";
    $query .= "caption = '{$caption}', ";
	$query .= "topic = '{$topic}', ";
    $query .= "subtopic = '{$sub_topic}' ";
    $query .= "WHERE contentid = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "{$value} updated.";
      redirect_to("manage_video.php?type={$value}");
    } else {
      // Failure
      $_SESSION["message"] = "{$value} update failed.";
	  redirect_to("manage_video.php?type={$value}");
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


    
    <h2>Edit <?php echo $type;?>: <?php echo htmlentities($content["caption"]); ?> </h2>
	


    <form action="edit_video.php?type=<?php echo urlencode($_GET["type"]); ?>&id=<?php echo urlencode($_GET["id"]); ?>" method="post" class="form-horizontal"  role="form">
		  <div class="form-group">
			  <label class="control-label col-lg-offset-3 col-lg-2" for="captioin">Caption:</label>
						<div class="col-lg-2">
						<input type="text" name="caption" value="" placeholder="<?php echo $content["caption"];?>" class="form-control" />
					  </div>
			</div>
		
			 <div class="form-group">
				   <label class="control-label col-lg-offset-3 col-lg-2" for="topic"> Topic:</label>
					   <div class="col-lg-2">
							<input type="text" name="topic" value="" placeholder="<?php echo $content["topic"];?>" class="form-control"/>
					   </div>
			</div>
			  
			   <div class="form-group">
					   <label class="control-label col-lg-offset-3 col-lg-2" for="sub_topic">SubTopic:</label>
						<div class="col-lg-2">
							<input type="text" name="sub_topic" value="" placeholder="<?php echo $content["subtopic"];?>" class="form-control"/>
			  		   </div>
				</div>
				
			  <input type="hidden" name="type" value="<?php echo $value;?>">
			  
			  
			    <div class="form-group">
				
					   <label class="control-label col-lg-offset-3 col-lg-2" for="sub_topic">Language:</label>
					   
				<div class="col-lg-2">
					<select name="language" class="form-control">
						<option value="English">English</option>
						<option value="Chinese">Chinese</option>
						<option value="French">French</option>
						<option value="other">Other</option>
					</select>
				</div>
				</div>
			<div class="form-group">
			<div class="col-lg-2 col-lg-offset-5">
			  <input type="submit" name="submit" value="Edit" class="form-control"/>
			  </div>
			  </div>
			 </form>
			 <div class="form-group">
				<div class="col-lg-offset-5 col-lg-2">
			<a href="manage_video.php?type=<?php echo $type;?>" class="btn btn-primary">Cancel</a>
			</div>
			</div>
	   	<div class="col-lg-offset-5 col-lg-2">
				<?php echo form_errors($errors); ?>
			</div>
</div>


