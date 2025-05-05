<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];

    // Fetch application details
    $query = "SELECT * FROM college_pending WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $application = $result->fetch_assoc();

    if (!$application) {
        $_SESSION['reminder'] = "Application not found.";
        header("Location: pending.php");
        exit();
    }

    if (isset($_POST['accept'])) {
        // Check if applicant already exists in records
        $check_query = "SELECT id FROM records WHERE name = ? AND status = 'active' OR status = 'renewed'";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $application['name']);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Send notification for duplicate
            $notification_message = "Your application was automatically rejected as you are already a beneficiary.";
            $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
            $notification_stmt = $conn->prepare($notification_query);
            $notification_stmt->bind_param("is", $application['user_id'], $notification_message);
            $notification_stmt->execute();

            // Delete pending application
            $delete_query = "DELETE FROM college_pending WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $application_id);
            $delete_stmt->execute();

            $_SESSION['reminder'] = "Application automatically rejected - applicant is already a beneficiary";
        } else {
            // Insert new beneficiary into records
            $insert_query = "INSERT INTO records (name, school, semester, courseYear, brgy, phone, status) 
                             VALUES (?, ?, ?, ?, ?, ?, 'active')";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param(
                "ssssss",
                $application['name'],
                $application['school'],
                $application['semester'],
                $application['courseYear'],
                $application['address'],
                $application['number']
            );
            $insert_stmt->execute();

            // Send approval notification
            $notification_message = "Your application has been approved.";
            $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
            $notification_stmt = $conn->prepare($notification_query);
            $notification_stmt->bind_param("is", $application['user_id'], $notification_message);
            $notification_stmt->execute();

            // Delete from pending
            $delete_query = "DELETE FROM college_pending WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $application_id);
            $delete_stmt->execute();

            $_SESSION['reminder'] = "Beneficiary application has been approved";
        }
    } elseif (isset($_POST['reject'])) {
        $rejection_message = $_POST['rejection_message'];

        // Send rejection notification
        $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
        $notification_stmt = $conn->prepare($notification_query);
        $notification_stmt->bind_param("is", $application['user_id'], $rejection_message);
        $notification_stmt->execute();

        // Delete pending application
        $delete_query = "DELETE FROM college_pending WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $application_id);
        $delete_stmt->execute();

        $_SESSION['reminder'] = "Rejection message sent successfully!";
    }

    header("Location: pending.php");
    exit();
}
?>
