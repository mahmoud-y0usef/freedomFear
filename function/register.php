<?php

require_once 'DB.php';
$db = new DB();

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        if (empty($email) || empty($username) || empty($password)) {
            echo "<script> window.location.href = '../register.php?error=Please fill out the data' </script>";
            exit;
        } else {
            $domain = explode('@', $email);
            if ($domain[1] != 'gmail.com' && $domain[1] != 'yahoo.com' && $domain[1] != 'hotmail.com' && $domain[1] != 'outlook.com') {
                echo "<script> window.location.href = '../register.php?error=Invalid email domain' </script>";
                exit;
            } else {
                if (strlen($username) < 6) {
                    echo "<script> window.location.href = '../register.php?error=Username must be at least 6 characters' </script>";
                    exit;
                } else {
                    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password) || strlen($password) < 6) {
                        echo "<script> window.location.href = '../register.php?error=Password must be at least 6 characters and mix of letters and numbers' </script>";
                        exit;
                    }
                }
            }

            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $username = filter_var($username, FILTER_SANITIZE_STRING);
            $password = filter_var($password, FILTER_SANITIZE_STRING);
        }


        $user = $db->get_user_by_email($email);
        if ($user) {
            echo "<script> window.location.href = '../register.php?error=This email already exists' </script>";
            exit;
        } else {
            $user = $db->get_user_by_username($username);
            if ($user) {
                echo "<script> window.location.href = '../register.php?error= Username already exists' </script>";
                exit;
            } else {
                $result = $db->register($email, $username, $password);
                if ($result) {
                    echo "<script> window.location.href = '../activate.php' </script>";
                    exit;
                } else {
                    echo "<script> window.location.href = '../register.php?error=Account creation failed' </script>";
                    exit;
                }
            }
        }
    } catch (Exception $e) {
        echo "<script> window.location.href = '../register.php?error= Request failed' </script>";
        exit;
    }
} else {
    echo "<script> window.location.href = '../register.php?error= Request failed' </script>";
    exit;
}

?>