<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once "../function/DB.php";
        $db = new DB();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $db->delete_user($id);
        
        header('Location: users.php');
    }

?>