<?php
   
    require_once('DB.php');
    $db = new DB();

    if(isset($_POST['login'])){
        $username_or_email = $_POST['username_or_email'];
        $password = md5($_POST['password']);
        $user = $db->loginUser($username_or_email , $password);
        $admin = $db->loginAdmin($username_or_email , $password);

        if(empty($username_or_email) || empty($password)){
            header("Location: ../index.php?error=Please fill out the data");
            exit;
        }
        
        if($admin[""] == 1){
            header("Location: ../index.php?error=You are not an admin");
            exit;
        }

        if($user){
            if($user['activate'] == 0){
                header("Location: ../activate.php?error=Please check your email and activate your account");
                exit;
            }
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['privilege'] = 0;
            $status = $db->status($user['id'] , 'account');
            header("Location: ../user/");
            exit;
        }
        elseif($admin){
            $_SESSION['admin'] = $admin;
            $_SESSION['privilege'] = 1;
            $status = $db->status($user['id'] , 'admins');
            header("Location: ../admin/index.php");
            exit;
        }
        else{
            header("Location: ../index.php?error=Invalid email or password");
            exit;
        }
    }
    else{
        header("Location: ../index.php");
        exit;
    }
?>
