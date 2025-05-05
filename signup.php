<?php
session_start();

include('config/config.php');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Handle profile picture upload
    $profile = $_FILES['profile']['name'];
    $profile_tmp = $_FILES['profile']['tmp_name'];
    $profile_folder = 'Profile/' . $profile;

    // Check if email already exists
    $sql = "SELECT * FROM accounts WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if ($count_email == 0) {
        if ($password == $cpassword) {
            // Hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Move the uploaded profile picture to the target folder
            if (move_uploaded_file($profile_tmp, $profile_folder)) {
                // Insert the new account into the database
                $sql = "INSERT INTO accounts (name, email, password, profile, user_type, created_at) 
                        VALUES ('$name', '$email', '$hash', '$profile', '$category', NOW())";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $_SESSION['sts'] = "Registration Successful! You can now login with your credentials.";
                    $_SESSION['show_login'] = true;
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['status'] = "Registration Failed! Please try again.";
                    header("Location: index.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Failed to upload profile picture.";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Passwords do not match!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Email already exists!";
        header("Location: index.php");
        exit();
    }
}
?>