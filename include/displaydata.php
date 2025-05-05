<?php

include './config/config.php';

$cpsu = "SELECT COUNT(*) as total_students FROM records WHERE school = 'CPSU-MAIN'";
$result = mysqli_query($conn, $cpsu);
$row = mysqli_fetch_assoc($result);
$total_students_cpsu = $row['total_students'];

// Fetch detailed data for CPSU-MAIN
$cpsu_details = "SELECT * FROM records WHERE school = 'CPSU-MAIN' ORDER BY name ASC";
$cpsu = mysqli_query($conn, $cpsu_details);

?>