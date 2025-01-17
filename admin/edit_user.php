<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $active = $_POST['active'];
    require_once '../function/DB.php';
    $db = new DB();
    $db->edit_user_admin($id, $name, $email, $nick, $active);

}
?>