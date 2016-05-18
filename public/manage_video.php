<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in();?>

<?php
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }
	if($_GET["type"]=="video"){
		//$_SESSION["type"] = "video";
		$content_set = find_all_video($_GET["type"]);

	}else if($_GET["type"]=="music"){
		//$_SESSION["type"] = "music";
		$content_set = find_all_video($_GET["type"]);
		
	}else if($_GET["type"]=="picture"){
		//$_SESSION["type"] = "picture";
		$content_set = find_all_video($_GET["type"]);
		
	}
?>


<?php include("../includes/layouts/header.php"); ?>

<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
    <h2>Manage <?php echo $_GET["type"]?></h2>
	
	

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
			<a href="upload.php?type=<?php echo urlencode($_GET["type"]);?>" class="form-control btn btn-primary">Add new <?php echo $_GET["type"]?> </a>
		</div>
		<div class="col-lg-2">
			<a href="admin.php" class="form-control btn btn-primary" >Main menu</a><br />
		</div>
	</div>
	<div class="form-group">
		<div style="position:relative; height:500px; overflow:auto">
			<div class="col-lg-12">
					<div class="table">
							<table class="table table-responsive">
							  <tr>
								<th style="text-align: center;">Caption</th>
								<th style="text-align: center;">topic</th>
								<th style="text-align: center;">subtopic</th>
								<th style="text-align: center;">language</th>
								<?php
								if($_GET["type"]=="picture"){
									$output="<th";
									$output .=" style=\"text-align: center;\">image</th>";
									echo $output;
								}
								?>
								<th style="text-align: center;">Action</th>
							  </tr>
							<?php while($content = mysqli_fetch_assoc($content_set)) { ?>
							  <tr>
								<td style="text-align: center;"><?php echo htmlentities($content["caption"]); ?>
								<td style="text-align: center;"><?php echo htmlentities($content["topic"]); ?>
								<td style="text-align: center;"><?php echo htmlentities($content["subtopic"]); ?>
								<td style="text-align: center;"><?php echo htmlentities($content["language"]); ?> 
								
								<?php 
								if($_GET["type"]=="picture"){
									$output ="<td>";
									$output.= "<img src=\"";
									$output.= htmlentities($content["path"]);
									$output.= " \" style=\" width:128px;height:128px;\">";
									echo $output;
								}
								?>
								<?php //echo htmlentities($admin["hashed_password"]);?>
								</td>
								<td><a href="edit_video.php?type=<?php echo urlencode($_GET["type"]);?>&id=<?php echo urlencode($content["contentID"]); ?>" class="btn btn-default col-lg-2 col-lg-offset-4">Edit</a>
								<a href="delete_video.php?type=<?php echo urlencode($_GET["type"]);?>&id=<?php echo urlencode($content["contentID"]); ?>" onclick="return confirm('Are you sure?');"class="btn btn-default col-lg-2">Delete</a></td>
							  </tr>
							<?php } ?>
							</table>
						</div>
					</div>
			</div>
			</div>
</form>	


</body>