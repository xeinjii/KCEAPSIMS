<?php
session_start();
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $semester = $_POST['semester'];
    $comelec = $_FILES['comelec'];
    $grades = $_FILES['grades'];
    $enrollment = $_FILES['enrollment'];

    // Define the upload directory
    $upload_dir = 'HS_documents/';

    // Validate and process file uploads
    if ($comelec['error'] === UPLOAD_ERR_OK) {
        $comelec_name = $comelec['name'];
        move_uploaded_file($comelec['tmp_name'], $upload_dir . $comelec_name);
    } else {
        $comelec_name = null;
    }

    if ($grades['error'] === UPLOAD_ERR_OK) {
        $grades_name = $grades['name'];
        move_uploaded_file($grades['tmp_name'], $upload_dir . $grades_name);
    } else {
        $grades_name = null;
    }

    if ($enrollment['error'] === UPLOAD_ERR_OK) {
        $enrollment_name = $enrollment['name'];
        move_uploaded_file($enrollment['tmp_name'], $upload_dir . $enrollment_name);
    } else {
        $enrollment_name = null;
    }

    // Check if any required file is missing
    if (!$comelec_name || !$grades_name || !$enrollment_name) {
        $_SESSION['good'] = 'All required documents must be uploaded.';
        header('Location: hsmainpage.php');
        exit();
    }

    // Insert renewal data into the database
    $query = "INSERT INTO renew_hs_pending (name, semester, comelec, grades, enrollment, submitted_at) 
              VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssss",
        $name,
        $semester,
        $comelec_name,
        $grades_name,
        $enrollment_name
    );
    $stmt->execute();

    // Add a notification for the user
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session
    $notification_message = "Your high school renewal is being processed.";
    $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
    $notification_stmt = $conn->prepare($notification_query);
    $notification_stmt->bind_param("is", $user_id, $notification_message);
    $notification_stmt->execute();

    // Set a success message in the session
    $_SESSION['good'] = 'Your renewal application has been submitted.';

    // Redirect back to the main page
    header('Location: hsmainpage.php');
    exit();
}
?>