<?php 
session_start();   
include './config/config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $CourseYear = mysqli_real_escape_string($conn, $_POST['CourseYear']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']); // Fetch user_id from form
    $submitted_at = date('Y-m-d H:i:s'); // Use current timestamp

    // File uploads
    $income = $_FILES['income']['name'];
    $birthcert = $_FILES['birthcert']['name'];
    $comelec = $_FILES['comelec']['name'];
    $card = $_FILES['card']['name'];
    $moral = $_FILES['moral']['name'];

    $income_tmp = $_FILES['income']['tmp_name'];
    $birthcert_tmp = $_FILES['birthcert']['tmp_name'];
    $comelec_tmp = $_FILES['comelec']['tmp_name'];
    $card_tmp = $_FILES['card']['tmp_name'];
    $moral_tmp = $_FILES['moral']['tmp_name'];

    // File destination folders
    $income_folder = 'College_documents/' . $income;
    $birthcert_folder = 'College_documents/' . $birthcert;
    $comelec_folder = 'College_documents/' . $comelec;
    $card_folder = 'College_documents/' . $card;
    $moral_folder = 'College_documents/' . $moral;

    // Move uploaded files to their respective folders
    if (move_uploaded_file($income_tmp, $income_folder) &&
        move_uploaded_file($birthcert_tmp, $birthcert_folder) &&
        move_uploaded_file($comelec_tmp, $comelec_folder) &&
        move_uploaded_file($card_tmp, $card_folder) &&
        move_uploaded_file($moral_tmp, $moral_folder)) {

        // Insert data into the database
        $query = "INSERT INTO college_pending (user_id, name, school, semester, address, CourseYear, number, income, birthcert, comelec, card, moral, submitted_at) 
                  VALUES ('$user_id', '$name', '$school', '$semester', '$address', '$CourseYear', '$number', '$income', '$birthcert', '$comelec', '$card', '$moral', CURRENT_TIMESTAMP())";

        if (mysqli_query($conn, $query)) {
            // Insert notification into the notifications table
            $notification_message = "Your application is being processed.";
            $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES ('$user_id', '$notification_message', CURRENT_TIMESTAMP())";
            mysqli_query($conn, $notification_query);

            $_SESSION['display'] = "Application submitted successfully!";
            header("Location: mainpage.php");
            exit();
        } else {
            $_SESSION['display'] = "Failed to submit application: " . mysqli_error($conn);
            header("Location: mainpage.php");
            exit();
        }
    } else {
        $_SESSION['display'] = "Failed to upload files.";
        header("Location: mainpage.php");
        exit();
    }
}
?>