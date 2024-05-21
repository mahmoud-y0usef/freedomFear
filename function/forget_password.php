<?php
if (isset($_POST['send_email'])) {
    require_once 'DB.php';
    $db = new DB();
    $email = $_POST['email'];
    if (empty($email)) {
        echo "<script> window.location.href = '../forget-password.php?error=Please fill out the data' </script>";
        exit;
    } else {
        $domain = explode('@', $email);
        $validDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
        if (!in_array($domain[1], $validDomains)) {
            echo "<script> window.location.href = '../forget-password.php?error=Invalid email domain' </script>";
            exit;
        } else {
            $result = $db->rest_password($email);
            if ($result) {
                echo "<script> window.location.href = '../reset_password.php?success=Email sent successfully' </script>";
                exit;
            } else {
                echo "<script> window.location.href = '../forget-password.php?error=Email sending failed' </script>";
                exit;
            }
        }
    }
}
?>