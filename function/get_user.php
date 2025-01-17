<?php 
    require_once "DB.php";
    $db = new DB();
    $id = $_POST['id'];
    $user = $db->get_user_by_id($id);
    echo json_encode($user); 

?>