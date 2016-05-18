<?php require_once("../includes/session.php")?>
<?php require_once("../includes/functions.php") ?>
<?php confirm_logged_in();
	   if(!check_priority_by_username($_SESSION["username"])){
		  redirect_to("patientLogin.php");
	  }?>
<?php 
?>

	<?php include("../includes/layouts/header.php"); ?>
		<body>
	<div class="well well-sm">
	<h1>CMS<h1>
	</div>
	 <form class="form-horizontal">
	 
	 <div class="form-group">
		 <div class="col-lg-1 ">
				<a href="admin.php" class="form-control btn btn-primary" >Main menu</a>
			</div>
			<h2>Track Result</h2>
	</div>	
	<div class="form-group">
	 <div style="position:relative; height:500px; overflow:auto">
	 <div class="col-lg-10 col-lg-offset-1">
		<?php
			require_once("database.php");

			$sql = "SELECT * FROM viewhistory";
			$result = $db->query($sql);
			echo "<table class=\"table table-responsive\">";
			echo "<tr>";
			echo "<th style=\"text-align: center;\">Name</th>";
			echo "<th style=\"text-align: center;\">Content Name</th>";
			echo "<th style=\"text-align: center;\">Number of View</th>";
			echo "</tr>";
			while($row = $result -> fetch_assoc()){
				echo "<tr>";
				$patientId = $row["patientID"];
				$nameSql = "SELECT forename as name FROM patient where patientId = {$patientId}";
				$patientname = $db->query($nameSql);
				while($names = $patientname -> fetch_assoc()){
					$name = $names["name"];
					echo "<td style=\"text-align: center;\">" . $name . "</td>";
				}
				$contentId = $row["contentID"];
				$contentSql = "SELECT caption FROM content  where contentID = {$contentId}";
				$contentName = $db->query($contentSql);
				while($contents = $contentName->fetch_assoc()){
					$cn = $contents["caption"];
					echo "<td style=\"text-align: center;\" >" . $cn . "</td>";
				}
				$viewId = $row["viewID"];
				echo "<td style=\"text-align: center;\">" . $viewId . "</td>";
				echo "</tr>";
			}

			$db->close_connection();
		?>
		</div>
		</div>
	</div>	
	</body>
</html>
