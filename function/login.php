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
        // Sanitize user input
        $username_or_email = filter_var($username_or_email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Try to login as user or admin
        $user = $db->login($username_or_email, $password, 'bl_game_users');
        $admin = $db->login($username_or_email, $password, 'admins');

        if ($user) {
            if ($user['active'] == 1) {
                $_SESSION['user'] = $user;
                $db->status($user['id'], 'bl_game_users', 1);
                header('Location: ../user/');
                exit;
            } else {
                header('Location: ../index.php?error=Account not activated');
                exit;
            }
        } elseif ($admin) {
            $_SESSION['admin'] = $admin;
            header('Location: ../admin/');
            exit;
        } else {
            header("Location: ../index.php?error=Invalid username or password");
            exit;
        }
    }
}
