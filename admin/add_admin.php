<?php 

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
        'cost' => 10
    ));
    require_once '../function/DB.php';
    $db = new DB();
    $db->add_admin($name, $email, $hashed_password);
   }

?>