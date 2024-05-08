<?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $key = $_POST['key'];
        if(empty($email) || empty($key)){
            echo "<script> window.location.href = '../activate.php?error=Please fill out the data' </script>";
            exit;
        }else{
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $key = filter_var($key, FILTER_SANITIZE_STRING);
            require_once('DB.php');
            $db = new DB();
            $user = $db->get_user_by_email($email);
            if($user){
                if($user['active'] == $key){
                    $result = $db->activate($email , $key);
                    if($result){
                        echo "<script> window.location.href = '../index.php?success=Account activated successfully' </script>";
                        exit;
                    }else{
                        echo "<script> window.location.href = '../activate.php?error=Account activation failed' </script>";
                        exit;
                    }
                }else{
                    echo "<script> window.location.href = '../activate.php?error=Invalid activation key' </script>";
                    exit;
                }
            }else{
                echo "<script> window.location.href = '../activate.php?error=Invalid email' </script>";
                exit;
            }
        }
    }
?>
