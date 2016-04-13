<?php

//Call connection to database here


//Beginning of post operation 
//variable declaration
$fname = $_POST['forename'];
$sname = $_POST['surname'];
$imageName = addslashes($_FILES['image']['name']);
$imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$allowedExtensions = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES['image']['name']);


if (isset($_POST['submit'])) {
    
    // Check image size is larger than 500kb
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        echo "<br>";
    }

// Allow certain image formats only
    $extensions = end($temp);
    if (in_array($extensions, $allowedExtensions)) {
        echo "";
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

//process query to insert into database
    $sql = "INSERT INTO patient (patientID,forename,surname,image,name) VALUES ('','$fname','$sname','$imageData','$imageName')";

    if (mysqli_query($con, $sql)) {
        echo "Patient created successfully";
    } else {
        echo "Oops! Patient not created";
    }
}
mysqli_close($con);
?>

