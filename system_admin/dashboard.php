<?php 
session_start();
include '../config/config.php';
include '../include/header3.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT COUNT(*) AS total_student FROM accounts WHERE user_type = 'student'";
$result = $conn->query($sql);
$total_students = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_students = $row['total_student'];
}

$sql = "SELECT COUNT(*) AS total_staff FROM accounts WHERE user_type = 'staff'";
$result = $conn->query($sql);
$total_staff = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_staff = $row['total_staff'];
}

$sql = "SELECT COUNT(*) AS total_admin FROM accounts WHERE user_type = 'admin'";
$result = $conn->query($sql);
$total_admin = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_admin = $row['total_admin'];
}
?>
<body>
    <?php
     include '../include/aside2.php';
     include '../include/top-bar.php';
    ?>
   
   <div class="dashboard-card">
    <div class="card">
        <span>USER ACCOUNTS</span>
        <p>TOTAL: <?php echo $total_students; ?></p>
        <span class="material-symbols-outlined">person</span>
    </div>
    <div class="card">
        <span>STAFF ACCOUNTS</span>
        <p>TOTAL: <?php echo $total_staff; ?></p>
        <span class="material-symbols-outlined">person</span>
    </div>
    <div class="card">
        <span>ADMIN ACCOUNTS</span>
        <p>TOTAL: <?php echo $total_admin; ?></p>
        <span class="material-symbols-outlined">person</span>
    </div> 
   </div>


   
 <!-- log out modal-->
    <?php include '../include/adminlogout.php'; ?>
    <script type="text/javascript" src="../script/bootstrap.bundle.min.js"></script>
</body>
</html>