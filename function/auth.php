<?php 
    if(isset($_POST['email']) && isset($_POST['key'])){
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
                if($user['code'] == $key){
                    $result = $db->activate($email , $key);
                    if($result){
                        $db->update_active($email);
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
