<?php
    require("config.php");

    $user_name = mysqli_real_escape_string($conn,$_POST['name']);
    $user_password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = mysqli_query($conn,"SELECT * FROM account WHERE (user = '$user_name' AND password = MD5('".$user_password."')) AND active IS NULL");
    $rows = mysqli_num_rows($sql);

    if($rows > 0){
        // Fetching password from the database
        $row = mysqli_fetch_assoc($sql);
        $password_from_db = $row['password'];

        // Returning password along with the response
        echo json_encode(array("success" => true, "password" => $password_from_db));
    } else {
        echo json_encode(array("success" => false));
    }
    mysqli_close($conn);
?>