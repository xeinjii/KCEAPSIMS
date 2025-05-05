<?php
session_start();
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $semester = $_POST['semester'];
    $comelec_certificate = $_FILES['comelec_certificate'];
    $grades = $_FILES['complete_grades'];
    $enrollment_certificate = $_FILES['enrollment_certificate'];

    // Define the upload directory
    $upload_dir = 'College_documents/';

    // Validate and process file uploads
    if ($comelec_certificate['error'] === UPLOAD_ERR_OK) {
        $comelec_certificate_name = $comelec_certificate['name'];
        move_uploaded_file($comelec_certificate['tmp_name'], $upload_dir . $comelec_certificate_name);
    } else {
        $comelec_certificate_name = null;
    }

    if ($grades['error'] === UPLOAD_ERR_OK) {
        $grades_name = $grades['name'];
        move_uploaded_file($grades['tmp_name'], $upload_dir . $grades_name);
    } else {
        $grades_name = null;
    }

    if ($enrollment_certificate['error'] === UPLOAD_ERR_OK) {
        $enrollment_certificate_name = $enrollment_certificate['name'];
        move_uploaded_file($enrollment_certificate['tmp_name'], $upload_dir . $enrollment_certificate_name);
    } else {
        $enrollment_certificate_name = null;
    }

    // Check if any required file is missing
    if (!$comelec_certificate_name || !$grades_name || !$enrollment_certificate_name) {
        $_SESSION['display'] = 'All required documents must be uploaded.';
        header('Location: mainpage.php');
        exit();
    }

    // Insert renewal data into the database
    $query = "INSERT INTO renew_college_pending (name, semester, comelec_certificate, grades, enrollment_certificate, submitted_at) 
              VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssss",
        $name,
        $semester,
        $comelec_certificate_name,
        $grades_name,
        $enrollment_certificate_name
    );
    $stmt->execute();

    // Add a notification for the user
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session
    $notification_message = "Your renewal is being process.";
    $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
    $notification_stmt = $conn->prepare($notification_query);
    $notification_stmt->bind_param("is", $user_id, $notification_message);
    $notification_stmt->execute();

    // Set a success message in the session
    $_SESSION['display'] = 'Your renewal is submitted.';

    // Redirect back to the main page
    header('Location: mainpage.php');
    exit();
}
?>