<?php
  $q = $_REQUEST["q"];

  require_once("database.php");

  $findPatients = "SELECT forename,surname FROM patient ";
  $findPatients .= "WHERE surname LIKE '%";
  $findPatients .= $q;
  $findPatients .= "%' ";
  $findPatients .= "ORDER BY surname ASC";


  // "resourse" objet - a collection of db rows
  $result = $db->query($findPatients);
  if(!$result){
    die("Database query failed.");
  }

  while($patient = mysqli_fetch_assoc($result)){
    $patients[] = array($patient["forename"],$patient["surname"]);
  }

  mysqli_free_result($result);

  echo json_encode($patients);

  $db->close_connection();

?>
