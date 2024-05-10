<?php

require_once ('DB.php');
$db = new DB();

if(isset($_POST['login'])){
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];
    if(empty($username_or_email) || empty($password)){
        header('Location: ../index.php?error=Please fill out the data');
        exit;
    }else{
        $username_or_email = filter_var($username_or_email, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $user = $db->login($username_or_email, $password, 'account');
        $admin = $db->login($username_or_email, $password, 'admins');
        if($user){
            if($user['activate'] == 1){
                session_start();
                $_SESSION['user'] = $user;
                header('Location: ../index.php');
                exit;
            }else{
                header('Location: ../index.php?error=Account not activated');
                exit;
            }
        }else if($admin){
            session_start();
            $_SESSION['user'] = $admin;
            header('Location: ../admin/index.php');
            exit;
        }else{
            echo "invalid pasword";
            // header('Location: ../index.php?error=Invalid username or password');
            // exit;
        }
    }
}