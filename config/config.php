<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simsdb";

$conn = new mysqli($servername, $username, $password, $dbname, 3306);
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}
?>
 