<?php
session_start();
require '../../function/DB.php';
$db = new DB();
session_destroy();

header('Location: ../../');
exit();
?>