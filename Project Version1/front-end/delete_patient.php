
<?php
//Call connection to database here

//Query to view list of patients 
$sql = "SELECT * FROM patient";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="delete_patient.css">
        <title>List of Patients</title>
    </head>
    <body>
        <form name="form1" method="post" action="">
            <table  width="400" border="0" cellspacing="1" cellpadding="0">
               
                <h1>Patient Record</h1>
                    
                <tr>
                    <th>Patient Count</th>
                    <th>Patient ID</th>
                    <th>Forename</th>
                    <th>Surname</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 1;//counter
                
                //Fetches all rows in the patient table
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $patient_id = $row['PatientID'];
                    $fname = $row['forename'];
                    $sname = $row['surname'];
                    //$acct_type = $row['accttype'];
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $patient_id; ?></td>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $sname; ?></td>
                        <td>
                            <a href="delete_patient.php?delete=<?php echo $patient_id; ?>" onclick = "return confirm('Do you want to delete the patient?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                //Initiates the delete action using the primary key "Patient_ID"
                if (isset($_GET['delete'])) {
                    $delete_id = $_GET['delete'];
                    mysqli_query($con, "DELETE FROM patient WHERE patientID = '$delete_id'");
                }
                mysqli_close($con);//Close connection to database
                ?>
            </table>
        </form>
    </body>
</html>
