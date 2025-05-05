<?php
session_start();    
include('config/config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $school = $_POST['school'];
    $gradelvl = $_POST['gradelvl'];
    $strand = $_POST['strand'];
    $brgy = $_POST['brgy'];
    $phone = $_POST['phone'];

    $sql = "select * from hsrecords where name ='$name'";
    $result = mysqli_query($conn, $sql);
    $name_count = mysqli_num_rows($result);

    if ($name_count == 0) {
        $sql = "INSERT INTO hsrecords (name, school, gradelvl, strand, brgy, phone) VALUES ('$name', '$school', '$gradelvl', '$strand', '$brgy', '$phone')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: manageHSscholar.php");
        } else {
            $_SESSION['sss'] = "Failed to Add Beneficiary";
            header("Location: manageHSscholar.php");
        }

    } else {
        if($name_count > 0){
            $_SESSION['sss'] = "Beneficiary Already Exists";
            header("Location: manageHSscholar.php");
            
        }
    }
}

?>