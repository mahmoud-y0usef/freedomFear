
<?php 
    
    $HOST = 'localhost';
    $USER = 'freedom_1_database';
    $PASSWORD = 'DXSqiW!qO0Mr?d78';
    $DBNAME = 'freedom_1_database';

    $conn =  mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    if(!$conn){
        die('Connection failed: '.mysqli_connect_error());
    }

    mysqli_set_charset($conn, 'utf8');

?>