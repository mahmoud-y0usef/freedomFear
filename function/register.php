<?php 

require_once 'DB.php';
$db = new DB();

if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
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
                    echo "<script> window.location.href = '../activate.php' </script>";
                }else{
                    echo 'Register failed';
                }
            }
        }
        // echo "hello";
    } catch (Exception $e) {
        // Log the error
        error_log('Error: ' . $e->getMessage());
        // Return a generic error message to the client
        http_response_code(500);
        echo 'Internal Server Error';
    }
}else{
    echo 'Invalid request';
}

?>
