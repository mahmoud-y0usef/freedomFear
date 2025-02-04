<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    require_once '../function/DB.php';
    $db = new DB();
    $db->update_admin_admin($id, $name, $email);

}
?>