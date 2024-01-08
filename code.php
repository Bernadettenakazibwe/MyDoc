<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_patient']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['delete_patient']);

    $query = "DELETE FROM patients WHERE id='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Patient Deleted Successfully";
        header("Location: welcome1.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Patient Not Deleted";
        header("Location: welcome1.php");
        exit(0);
    }
}
if(isset($_POST['update_patient']))
{
    $patient_id = mysqli_real_escape_string($con, $_POST['patient_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $Diagnosis = mysqli_real_escape_string($con, $_POST['Diagnosis']);

    $query = "UPDATE patients SET name='$name', email='$email', phone='$phone', Diagnosis='$Diagnosis' WHERE id='$patient_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Patient Updated Successfully";
        header("Location: welcome1.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Patient Not Updated";
        header("Location: welcome1.php");
        exit(0);
    }
}


if(isset($_POST['save_patient']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $Diagnosis = mysqli_real_escape_string($con, $_POST['Diagnosis']);

    $query = "INSERT INTO patients (name,email,phone,Diagnosis) VALUES ('$name','$email','$phone','$Diagnosis')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Patient Created Successfully";
        header("Location: patient-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Patient Not Created";
        header("Location: patient-create.php");
        exit(0);
    }
}

?>