<?php 

require_once 'DB.php';
$db = new DB();

if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $db->get_user_by_email($email);
    if($user){
        echo 'Email already exists';
    }else{
        $user = $db->get_user_by_username($username);
        if($user){
            echo 'Username already exists';
        }else{
            $result = $db->register($email , $username , $password);
            if($result){
                header('Location: ../activate.php');
            }else{
                echo 'Register failed';
            }
        }
    }
}else{
    echo 'Invalid request';
}

?>