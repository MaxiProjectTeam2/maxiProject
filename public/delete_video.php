<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in()?>
<?php
     if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
	  
  $content = find_content_by_id($_GET["id"]);
  if (!$content) {
    // video ID was missing or invalid or 
    // video couldn't be found in database
    redirect_to("manage_video.php");
  }
if($_GET["type"]=="video"){
	$value = "video";
	}else if($_GET["type"]=="music"){
		$value = "music";
	}else if($_GET["type"]=="picture"){
		$value = "picture";
	}

  $id = $content["contentID"];
  $query = "SELECT path FROM content WHERE contentID = {$id} LIMIT 1";
  $result1 = mysqli_query($connection, $query);
  $result2= mysqli_fetch_assoc($result1);
  $path = $result2["path"];
  if(unlink($path)){
	$query = "DELETE FROM content WHERE contentID = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);
  }else{
	$_SESSION["message"] = "{$value} deletion failed.";
    redirect_to("manage_video.php?type={$value}");
  }

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
	
    $_SESSION["message"] = "{$value} deleted.";
    redirect_to("manage_video.php?type={$value}");
  } else {
    // Failure
    $_SESSION["message"] = "{$value} deletion failed.";
    redirect_to("manage_video.php?type={$value}");
  }
  
?>
