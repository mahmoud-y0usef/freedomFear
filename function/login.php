<?php 
    require_once 'DB.php';
    $db = new DB();
     // user login or admin login

    if(isset($_POST['login'])){
        $username_or_email = $_POST['username_or_email'];
        $password = $_POST['password'];
        $user = $db->loginUser($username_or_email , $password);
        $admin = $db->loginAdmin($username_or_email , $password);
        if($user){
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
            echo 'Invalid username or password';
        }
    }
    
?>