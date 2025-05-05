<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];

    if (isset($_POST['accept'])) {
        // Fetch application details
        $query = "SELECT * FROM hspending WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $application = $result->fetch_assoc();

        if ($application) {
            // Check if applicant already exists in records
            $check_query = "SELECT id FROM hsrecords WHERE name = ? AND status = 'active' OR status ='renewed'";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("s", $application['name']);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                // Send notification to the applicant about duplicate application
                $notification_message = "Your application was automatically rejected as you are already a beneficiary.";
                $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
                $notification_stmt = $conn->prepare($notification_query);
                $notification_stmt->bind_param("is", $application['user_id'], $notification_message);
                $notification_stmt->execute();

                // Remove the duplicate application from the pending table
                $delete_query = "DELETE FROM hspending WHERE id = ?";
                $delete_stmt = $conn->prepare($delete_query);
                $delete_stmt->bind_param("i", $application_id);
                $delete_stmt->execute();

                $_SESSION['reminder'] = "Application automatically rejected - applicant is already a beneficiary";
                header("Location: pending.php");
                exit();
            }

            // ... existing code ...
            $insert_query = "INSERT INTO hsrecords (user_id, name, school, semester, gradelvl, strand, brgy, phone, status) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active')";
            // ... existing code ...
            $insert_stmt->bind_param(
                "isssssss",
                $application['user_id'],
                $application['name'],
                $application['school'],
                $application['semester'],
                $application['gradelvl'],
                $application['strand'],
                $application['address'],
                $application['number']
            );
            // ... existing code ...
            $insert_stmt->execute();

            // Send notification to the applicant
            $notification_message = "Your high school scholarship application has been approved.";
            $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
            $notification_stmt = $conn->prepare($notification_query);
            $notification_stmt->bind_param("is", $application['user_id'], $notification_message);
            $notification_stmt->execute();

            // Remove the application from the pending table
            $delete_query = "DELETE FROM hspending WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $application_id);
            $delete_stmt->execute();

            $_SESSION['reminder'] = "High school application approved successfully!";
        } else {
            $_SESSION['reminder'] = "Application not found.";
        }
    } elseif (isset($_POST['reject'])) {
        // Handle rejection
        $rejection_message = $_POST['rejection_message'];

        // Fetch application details
        $query = "SELECT user_id FROM hspending WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $application = $result->fetch_assoc();

        if ($application) {
            // Send rejection notification to the applicant
            $notification_query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, CURRENT_TIMESTAMP())";
            $notification_stmt = $conn->prepare($notification_query);
            $notification_stmt->bind_param("is", $application['user_id'], $rejection_message);
            $notification_stmt->execute();

            // Remove the application from the pending table
            $delete_query = "DELETE FROM hspending WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $application_id);
            $delete_stmt->execute();

            $_SESSION['reminder'] = "Rejection message sent successfully!";
        } else {
            $_SESSION['reminder'] = "Application not found.";
        }
    }

    header("Location: pending.php");
    exit();
}
?>