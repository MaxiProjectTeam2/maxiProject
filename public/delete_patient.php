<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in()?>
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
  
  $id = $patient["patientID"];
  $query = "DELETE FROM patient WHERE patientID = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Patient deleted.";
    redirect_to("manage_patient.php");
  } else {
    // Failure
    $_SESSION["message"] = "Patient deletion failed.";
    redirect_to("manage_patient.php");
  }
  
?>
