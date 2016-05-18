<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
  $patient_set = find_all_patients();
?>


<?php include("../includes/layouts/header.php"); ?>
<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
<div id="warp">
    <h2>Manage patients</h2>
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
	<form class="form-horizontal">
		<div class="form-group"">
				<div class="col-lg-offset-4 col-lg-2">
				<a href="admin.php" class="btn btn-primary">Main menu</a>
			</div>
			
			<div class="col-lg-offset-1 col-lg-2">
				<a href="new_patient.php" class="btn btn-primary">Add patient</a>
			</div>
		</div>
	<div class= "form-group">
		<div style="position:relative; height:500px; overflow:auto">
			<div class="col-lg-offset-2 col-lg-8">
				<div class="table">
					<table class="table table-responsive">
					  <tr>
						<th style="text-align: center; ">Surname</th>
						<th style="text-align: center; ">Forename</th>
						<th style="text-align: center;">Actions</th>
					  </tr>
					<?php while($patient = mysqli_fetch_assoc($patient_set)) { ?>
					  <tr>
						<td style="text-align: center;"><?php echo htmlentities($patient["surname"]); ?>
						<td style="text-align: center;"><?php echo htmlentities($patient["forename"]); ?>
						<br>
						<td><a href="edit_patient.php?id=<?php echo urlencode($patient["patientID"]); ?>" class="btn btn-default col-lg-2 col-lg-offset-2">Edit</a>
						<a href="delete_patient.php?id=<?php echo urlencode($patient["patientID"]); ?>" onclick="return confirm('Are you sure?');"class="btn btn-default col-lg-2">Delete</a></td>
					  </tr>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
	