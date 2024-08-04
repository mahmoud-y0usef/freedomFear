<?php 
session_start();
require_once 'DB.php';
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub = $_POST['sub'];
    $details = $_POST['details'];
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    $email = $_SESSION['user']['email'];
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'txt');
    
    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size <= 2097152) { // 2MB
                $file_name_new = uniqid('', true) . '.' . $file_ext;
                $file_destination = '../uploads/' . $file_name_new;
                
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $db->send_report($email, $sub, $details, $file_name_new);
                    header('Location: ../user/?success=Report sent successfully');
                } else {
                    echo 'Failed to upload file';
                }
            } else {
                echo 'File size exceeds limit';
            }
        } else {
            echo 'File error: ' . $file_error;
        }
    } else {
        echo 'Invalid file type';
    }
} else {
    echo 'Invalid request method';
}
?>
