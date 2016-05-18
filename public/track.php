<?php
$con = new mysqli("localhost","root","123456","cms");
$viewId = $_POST["viewId"];
$patientID = $_POST["patientID"];
$contentID = $_POST["contentID"];
$sql = "UPDATE `viewhistory` SET `endTime`=current_time() WHERE `patientID`={$patientID} and`contentID`={$contentID} and`ViewId`={$viewId}";
$con->query($sql);
?>