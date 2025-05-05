<?php
session_start();
include ('config/config.php');

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $school = $_POST['school'];
        $semester = $_POST['semester'];
        $courseYear = $_POST['courseYear'];
        $brgy = $_POST['brgy'];
        $phone = $_POST['phone'];

        $sql = "UPDATE records SET name = '$name', school = '$school', semester = '$semester', courseYear = '$courseYear', brgy = '$brgy', phone = '$phone' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['add'] = "Beneficiary updated successfully";
            header("Location: manageCollegeScholar.php");
        }else{
            $_SESSION['add'] = "Failed to Update Beneficiary";
            header("Location: manageCollegeScholar.php");
        }
    }

?>