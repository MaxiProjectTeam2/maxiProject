<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Track Result</title>
	</head>
	<body>
		<h1>Track Result</h1>
		<?php
			require_once("database.php");

			$sql = "SELECT * FROM rtooldb.viewHistory";
			$result = $db->query($sql);
			echo "<table>";
			echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Content Name</th>";
			echo "<th>Number of View</th>";
			echo "</tr>";
			while($row = $result -> fetch_assoc()){
				echo "<tr>";
				$patientId = $row["patient_patientID"];
				$nameSql = "SELECT forename as name FROM rtooldb.patient where patientId = " . $patientId;
				$patientname = $con->query($nameSql);
				while($names = $patientname -> fetch_assoc()){
					$name = $names["name"];
					echo "<th>" . $name . "</th>";
				}
				$contentId = $row["contentTypeID"];
				$contentSql = "SELECT Type FROM rtooldb.contentType where contentTypeID =" . $contentId;
				$contentName = $db->query($contentSql);
				while($contents = $contentName->fetch_assoc()){
					$cn = $contents["Type"];
					echo "<th>" . $cn . "</th>";
				}
				$viewId = $row["ViewId"];
				echo "<th>" . $viewId . "</th>";
				echo "</tr>";
			}

			$db->close_connection();
		?>
	</body>
</html>
