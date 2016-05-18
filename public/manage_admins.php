<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>
<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
  $admin_set = find_all_admins();
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>

    <h2>Manage carers</h2>
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
		<div class="form-group">	
			<div class="col-lg-offset-4 col-lg-2">
				<a href="new_admin.php" class="btn btn-primary">Add carers</a>
			</div>
			<div class="col-lg-offset-1 col-lg-2">
				<a href="admin.php"class="btn btn-primary">Main menu</a>
			</div>
		</div>
		
		<div  class="form-group">
			<div style="position:relative; height:500px; overflow:auto">
				<div class="col-lg-offset-3 col-lg-6">
					<div class="table">
						<table class="table table-responsive">
						  <tr>
							<th style="text-align: center;">Username</th>
							<th  style="text-align: center;">Actions</th>
							
						  </tr>
						<?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
						  <tr>
							<td style="text-align: center;"><?php echo htmlentities($admin["username"]); ?>
							<br>
							<?php //echo htmlentities($admin["hashed_password"]);?>
							</td>
							<td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>" class="btn btn-default col-lg-2 col-lg-offset-4">Edit</a>
							<a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>"class="btn btn-default col-lg-2" onclick="return confirm('Are you sure?');">Delete</a></td>
						  </tr>
						<?php } ?>
						</table>
				  </div>
				</div>
			</div>	
		</div>



