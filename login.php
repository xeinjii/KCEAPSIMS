<?php
session_start();
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM accounts WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION["user_type"] = $row['user_type']; // Assuming user_type column exists


            if ($row['user_type'] == 'COLLEGE') {
                header("location: mainpage.php");
            }
            elseif ($row['user_type'] == 'HIGHSCHOOL') {
                header("location: hsmainpage.php");
            }
            elseif ($row['user_type'] == 'staff') {
                header("location: admin.php");
            } 
            elseif ($row['user_type'] == 'admin') {
                header("location: ./system_admin/dashboard.php");
            }
            exit();
        } else {
            $_SESSION['sts'] = "Incorrect password!!";
            header("location: index.php");
            exit();
        }
    } else {
        $_SESSION['sts'] = "Incorrect email!!";
        header("location: index.php");
        exit();
    }
}
?>