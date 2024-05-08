<?php 
    require_once('DB.php');
    $db = new DB();
     // user login or admin login

    if(isset($_POST['login'])){
        $username_or_email = $_POST['username_or_email'];
        $password = $_POST['password'];
        $user = $db->loginUser($username_or_email , $password);
        $admin = $db->loginAdmin($username_or_email , $password);

        // validate email or username and password
        if(empty($username_or_email) || empty($password)){
            echo "<script> window.location.href = '../index.php?error=Please fill out the data' </script>";
            exit;
        }
        if($admin[""] == 1){
            echo "<script> window.location.href = '../index.php?error=You are not an admin' </script>";
            exit;
        }

        if($user){
            if($user['activate'] == 0){
                echo "<script> window.location.href = '../activate.php?error=Please check your email and activate your account' </script>";
                exit;
            }
            session_start();
            $_SESSION['user'] = $user;
            header('Location: ../user/');
            
        }elseif($admin){
            $_SESSION['admin'] = $admin;
            // header('Location: admin/index.php');
            echo 'Admin login';
            echo '<pre>';
            print_r($admin);
        }else{
            echo "<script> window.location.href = '../index.php?error=Invalid email or password' </script>";
            exit;
        }
    }
    
?>