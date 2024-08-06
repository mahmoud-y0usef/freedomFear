<?php
session_start();
require '../../function/DB.php';
$db = new DB();
$db->status($_SESSION['user']['id'], 'account', 0);
session_destroy();

header('Location: ../../');
exit();
?>