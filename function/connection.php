<<<<<<< HEAD
<?php 
    
    $HOST = 'localhost';
    $USER = 'freedom_1_phpma';
    $PASSWORD = 'DXSqiW!qO0Mr?d78';
    $DBNAME = 'freedom_1_database';

    $conn =  mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    if(!$conn){
        die('Connection failed: '.mysqli_connect_error());
    }

    mysqli_set_charset($conn, 'utf8');

=======
<?php 
    
    $HOST = 'localhost';
    $USER = 'freedom_1_phpma';
    $PASSWORD = 'DXSqiW!qO0Mr?d78';
    $DBNAME = 'freedom_1_database';

    $conn =  mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    if(!$conn){
        die('Connection failed: '.mysqli_connect_error());
    }

    mysqli_set_charset($conn, 'utf8');

>>>>>>> cb2837cd138e21668014c4179f847682d5b0afe5
?>