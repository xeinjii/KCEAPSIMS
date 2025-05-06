<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];
    
    // Handle file upload
    $logo_name = null;
    if (isset($_FILES['school_logo']) && $_FILES['school_logo']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['school_logo']['name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($file_ext, $allowed)) {
            $logo_name = uniqid('school_') . '.' . $file_ext;
            $upload_path = 'school_logos/' . $logo_name;
            
            if (!file_exists('school_logos')) {
                mkdir('school_logos', 0777, true);
            }
            
            if (move_uploaded_file($_FILES['school_logo']['tmp_name'], $upload_path)) {
                // File uploaded successfully
            } else {
                $_SESSION['error'] = "Failed to upload logo";
                header("Location: admin.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Allowed: jpg, jpeg, png, gif";
            header("Location: admin.php");
            exit();
        }
    }

    // Insert school into database
    $query = "INSERT INTO schools (name, logo) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $school_name, $logo_name);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "School added successfully";
        header("Location: admin.php");
    } else {
        $_SESSION['error'] = "Failed to add school";
        header("Location: admin.php");
    }
    exit();
}
?>