<?php 
    if(isset($_POST['send_email']))
    {
        require_once 'DB.php';
        $db = new DB();
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(empty($email))
        {
            echo "<script> window.location.href = '../forget-password.php?error=Please fill out the data' </script>";
            exit;
        }
        else
        {
            $domain = explode('@', $email);
            if ($domain[1] != 'gmail.com' && $domain[1] != 'yahoo.com' && $domain[1] != 'hotmail.com' && $domain[1] != 'outlook.com') {
                echo "<script> window.location.href = '../forget-password.php?error=Invalid email domain' </script>";
                exit;
            }
            else
            {
                $user = $db->get_user_by_email($email);
                if($user)
                {
                    $result = $db->rest_password($email);
                    if($result)
                    {
                        echo "<script> window.location.href = '../reset_password.php?success=Email sent successfully' </script>";
                        exit;
                    }
                    else
                    {
                        echo "<script> window.location.href = '../forget-password.php?error=Email sending failed' </script>";
                        exit;
                    }
                }
                else
                {
                    echo "<script> window.location.href = '../forget-password.php?error=This email does not exist' </script>";
                    exit;
                }
            }
        }
    }
?>