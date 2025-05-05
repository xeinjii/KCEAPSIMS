<?php
session_start();    
include('config/config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $school = $_POST['school'];
    $courseYear = $_POST['courseYear'];
    $brgy = $_POST['brgy'];
    $phone = $_POST['phone'];

    $sql = "select * from records where name ='$name'";
    $result = mysqli_query($conn, $sql);
    $name_count = mysqli_num_rows($result);

    if ($name_count == 0) {
        $sql = "INSERT INTO records (name, school, courseYear, brgy, phone) VALUES ('$name', '$school', '$courseYear', '$brgy', '$phone')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: manageCollegeScholar.php");
        } else {
            $_SESSION['add'] = "Failed to Add Beneficiary";
            header("Location: manageCollegeScholar.php");
        }

    } else {
        if($name_count > 0){
            $_SESSION['add'] = "Beneficiary Already Exists";
            header("Location: manageCollegeScholar.php");
            
        }
    }
}

?>