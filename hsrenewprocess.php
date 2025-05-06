<?php
session_start();
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle acceptance
    if (isset($_POST['accept'])) {
        $application_id = $_POST['application_id'];

        // Fetch the name (record ID) and check status from the records table
        $fetchQuery = "SELECT rhp.*, r.status 
                      FROM renew_hs_pending rhp 
                      JOIN hsrecords r ON r.id = rhp.name 
                      WHERE rhp.id = ?";
        $stmt = $conn->prepare($fetchQuery);
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $renewData = $result->fetch_assoc();

        if ($renewData) {
            // Check if the status is already renewed
            if ($renewData['status'] === 'renewed') {
                // Send notification about already renewed status
                $notification_message = "Your renewal application cannot be processed as your status is already renewed.";
                $notificationQuery = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
                $notificationStmt = $conn->prepare($notificationQuery);
                $notificationStmt->bind_param("is", $_SESSION['user_id'], $notification_message);
                $notificationStmt->execute();

                // Delete the renewal application
                $deleteQuery = "DELETE FROM renew_hs_pending WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param("i", $application_id);
                $deleteStmt->execute();

                $_SESSION['reminder'] = 'Cannot process renewal - Status is already renewed.';
                header('Location: pending.php');
                exit();
            }

            $record_id = $renewData['name'];

            // Update the status in the records table to "renewed"
            $updateQuery = "UPDATE hsrecords SET status = 'renewed' WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("i", $record_id);
            $updateStmt->execute();

            // Add a notification for the user
            $notification_message = "Your high school renewal is approved.";
            $notificationQuery = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
            $notificationStmt = $conn->prepare($notificationQuery);
            $notificationStmt->bind_param("is", $_SESSION['user_id'], $notification_message);
            $notificationStmt->execute();

            // Delete the renewal application from the renew_hs_pending table
            $deleteQuery = "DELETE FROM renew_hs_pending WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $application_id);
            $deleteStmt->execute();

            $_SESSION['reminder'] = 'High school renewal application approved successfully.';
        } else {
            $_SESSION['reminder'] = 'Renewal application not found.';
        }

        header('Location: pending.php');
        exit();
    }

    // Handle rejection
    if (isset($_POST['reject'])) {
        $application_id = $_POST['application_id'];
        $rejection_message = $_POST['rejection_message'];

        // Fetch the name (record ID) from the renew_hs_pending table
        $fetchQuery = "SELECT name FROM renew_hs_pending WHERE id = ?";
        $stmt = $conn->prepare($fetchQuery);
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $renewData = $result->fetch_assoc();

        if ($renewData) {
            $record_id = $renewData['name'];

            // Update the status in the records table to "incomplete"
            $updateQuery = "UPDATE hsrecords SET status = 'incomplete' WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("i", $record_id);
            $updateStmt->execute();

            // Add a notification for the user
            $user_id = $_SESSION['user_id'];
            $notification_message = "Your high school renewal is rejected. Reason: " . $rejection_message;
            $notificationQuery = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
            $notificationStmt = $conn->prepare($notificationQuery);
            $notificationStmt->bind_param("is", $user_id, $notification_message);
            $notificationStmt->execute();

            // Delete the renewal application from the renew_hs_pending table
            $deleteQuery = "DELETE FROM renew_hs_pending WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $application_id);
            $deleteStmt->execute();

            $_SESSION['reminder'] = 'High school renewal application rejected successfully.';
        } else {
            $_SESSION['reminder'] = 'Renewal application not found.';
        }

        header('Location: pending.php');
        exit();
    }
}
?>