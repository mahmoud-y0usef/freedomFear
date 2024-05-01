<?php 
    
    $HOST = 'localhost';
    $USER = 'root';
    $PASSWORD = '';
    $DBNAME = 'fr_fear_web';

    $conn =  mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    if(!$conn){
        die('Connection failed: '.mysqli_connect_error());
    }

    mysqli_set_charset($conn, 'utf8');

?>