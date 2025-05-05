<?php
session_start();
include('config/config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginForm.php");
    exit();
}

$user_id = $_SESSION['user_id'];


include('./include/header.php');
?>




<body>
    
<?php include './include/navbar.php'; ?>













   
    <!-- log out -->
    <?php include './include/logout.php'; ?>


    <!-- Footer -->
    <?php include './include/footer.php';?>

    <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
</body>
