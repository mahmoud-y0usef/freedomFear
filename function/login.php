<?php

session_start();
require_once 'DB.php';
$db = new DB();

if (isset($_POST['login'])) {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    if (empty($username_or_email) || empty($password)) {
        header('Location: ../index.php?error=Please fill out the data');
        exit;
    } else {
        // Use FILTER_SANITIZE_FULL_SPECIAL_CHARS instead of FILTER_SANITIZE_STRING
        $username_or_email = filter_var($username_or_email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = $db->login($username_or_email, $password, 'account');
        $admin = $db->login($username_or_email, $password, 'admins');

        if ($user) {
            if ($user['activate'] == 1) {
                $_SESSION['user'] = $user;
                header('Location: ../user/');
                exit;
            } else {
                header('Location: ../index.php?error=Account not activated');
                exit;
            }
        } else if ($admin) {
            session_start();
            $_SESSION['admin'] = $admin;
            header('Location: ../admin/index.php');
            exit;
        } else {
            // Ensure headers are sent correctly
            if (!headers_sent()) {
                header("Location: ../index.php?error=Invalid username or password");
                exit;
            } else {
                die('should have redirected by now');
            }
        }
    }
}
?>