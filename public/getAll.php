<?php

class getAll{

  function getAll(){

    require_once("database.php");

    $findPatients = "SELECT forename,surname FROM patient ";
    $findPatients .= "ORDER BY surname ASC";


    // "resourse" objet - a collection of db rows
    $result = $db->query($findPatients);
    if(!$result){
      die("Database query failed.");
    }

    while($patient = mysqli_fetch_assoc($result)){
      $patients[] = array($patient["forename"],$patient["surname"],$patient["patientID"],$patient["photoFile"]);
    }

    mysqli_free_result($result);

    $db->close_connection();

    return $patients;
  }

}
  $set = new getAll();

  $patients = $set->getAll();

  echo json_encode($patients);

?>
