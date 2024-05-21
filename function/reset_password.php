<?php 
    if(isset($_POST['reset_password']))
    {
        require_once 'DB.php';
        $db = new DB();
        $email = $_POST['email'];
        $key = $_POST['key'];
        $password = $_POST['password'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $key = filter_var($key, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        if(empty($email) || empty($key) || empty($password))
        {
            echo "<script> window.location.href = '../reset_password.php?error=Please fill out the data' </script>";
            exit;
        }
        else
        {
            $rest_password = $db->get_email_by_key($email, $key);
            if($rest_password)
            {
                if($rest_password['code'] == $key)
                {
                    $result = $db->update_password($email, $password);
                    if($result)
                    {
                        $db->delete_key($email);
                        echo "<script> window.location.href = '../index.php?success=Password reset successfully' </script>";
                        exit;
                    }
                    else
                    {
                        echo "<script> window.location.href = '../reset_password.php?error=Password reset failed' </script>";
                        exit;
                    }
                }
                else
                {
                    echo "<script> window.location.href = '../reset_password.php?error=Invalid key' </script>";
                    exit;
                }
            }
            else
            {
                echo "<script> window.location.href = '../reset_password.php?error=This email does not exist' </script>";
                exit;
            }
        }
    }
?>