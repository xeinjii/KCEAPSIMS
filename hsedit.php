<?php
session_start();
include ('config/config.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $school = $_POST['school'];
    $semester = $_POST['semester'];
    $gradelvl = $_POST['gradelvl'];
    $brgy = $_POST['brgy'];
    $phone = $_POST['phone'];

    $sql = "UPDATE hsrecords SET name = '$name', school = '$school', semester = '$semester', gradelvl = '$gradelvl', brgy = '$brgy', phone = '$phone' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['add'] = "Beneficiary updated successfully";
        header("Location: manageCollegeScholar.php?table=highschool");
    } else {
        $_SESSION['add'] = "Failed to Update Beneficiary";
        header("Location: manageCollegeScholar.php?table=highschool");
    }
    exit();
}
?>