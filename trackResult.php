<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Track Result</title>
	</head>
	<body>
		<h1>Track Result</h1>
		<?php
			$con = new mysqli("LocalHost","root","root","mydb");
			if (!$con)
  			{
  				die('Could not connect: ' . mysql_error());
  			}
			$sql = "SELECT * FROM mydb.viewHistory";
			$result = $con->query($sql);
			echo "<table>";
			echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Content Name</th>";
			echo "<th>Number of View</th>";
			echo "</tr>";
			while($row = $result -> fetch_assoc()){
				echo "<tr>";
				$patientId = $row["patient_patientID"];
				$nameSql = "SELECT forename as name FROM mydb.patient where patientId = " . $patientId;
				$patientname = $con->query($nameSql);
				while($names = $patientname -> fetch_assoc()){
					$name = $names["name"];
					echo "<th>" . $name . "</th>";
				}
				$contentId = $row["content_contentID"];
				$contentSql = "SELECT typeName FROM mydb.contentType where contentId =" . $contentId;
				$contentName = $con->query($contentSql);
				while($contents = $contentName->fetch_assoc()){
					$cn = $contents["typeName"];
					echo "<th>" . $cn . "</th>";
				}
				$viewId = $row["ViewId"];
				echo "<th>" . $viewId . "</th>";
				echo "</tr>";
			}
		?>
	</body>
</html>